<?php

namespace App\Http\Controllers\API;

use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class UserController extends BaseController
{
    public function getUser() {
        $authUser = Auth::user();
        $user = User::findOrFail($authUser->id);
        $user->avatar = $this->getS3Url($user->avatar);
        return $this->sendResponse($user, 'User');
    }

    public function uploadAvatar(Request $request)
    {
        // Validate that an image file is provided and is of an allowed MIME type
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('image')) {
            try {
                // Get authenticated user and file extension
                $authUser = Auth::user();
                $user = User::findOrFail($authUser->id);
                // Use $request->file('image') instead of request()->file('image')
                $extension  = $request->file('image')->getClientOriginalExtension();
                $image_name = time() . '_' . $authUser->id . '.' . $extension;
                
                // Store the file on S3 under the "images" folder
                $path = $request->file('image')->storeAs('images', $image_name, 's3');
                
                // Set the file visibility to public
                Storage::disk('s3')->setVisibility($path, "public");

                if (!$path) {
                    return $this->sendError('Upload Failed', ['error' => 'User profile avatar failed to upload!']);
                }
                
                // Update the user's avatar and save the record
                $user->avatar = $path;
                $user->save();

                // Prepare success response with the full URL using getS3Url()
                $success['avatar'] = $this->getS3Url($path);
                return $this->sendResponse($success, 'User profile avatar uploaded successfully!');
            } catch (\Exception $e) {
                // Log the exception and return error response to help with debugging
                \Log::error('Avatar upload error: ' . $e->getMessage(), ['exception' => $e]);
                return $this->sendError('Avatar upload error.', ['error' => $e->getMessage()]);
            }
        } else {
            return $this->sendError('No image file provided.', ['error' => 'Image file missing']);
        }
    }

    public function removeAvatar()
    {
        try {
            $authUser = Auth::user();
            $user = User::findOrFail($authUser->id);

            if (!$user->avatar) {
                return $this->sendError('No avatar found to remove.', ['error' => 'Avatar not set']);
            }

            if (!Storage::disk('s3')->delete($user->avatar)) {
                return $this->sendError('Failed to delete avatar from storage.', ['error' => 'Deletion failed']);
            }

            $user->avatar = null;
            $user->save();

            return $this->sendResponse([], 'User profile avatar removed successfully!');
        } catch (\Exception $e) {
            Log::error('Avatar removal error: ' . $e->getMessage(), ['exception' => $e]);
            return $this->sendError('Avatar removal error.', ['error' => $e->getMessage()]);
        }
    }
}