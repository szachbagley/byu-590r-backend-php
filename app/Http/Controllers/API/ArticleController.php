<?php

namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ArticleController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with(['publication','topics'])
        ->orderBy('title')->get();
        foreach($articles as $article) {
            $article->image_url = $this->getS3Url($article->image_url);
        }

        return $this->sendResponse($articles, 'Articles retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request POST /articles {payload}
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,avif|max:2048',
            'link' => 'required|url',
            'publication_id' => 'required|integer',
            'topics'    => 'nullable|array',
            'topics.*'  => 'integer|exists:topics,id',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $article = new Article();

        if ($request->hasFile('file')) {
            try {
               
                // Use $request->file('image') instead of request()->file('image')
                $extension  = $request->file('file')->getClientOriginalExtension();
                $image_name = time() . '_article_image.' . $extension;
                
                // Store the file on S3 under the "images" folder
                $path = $request->file('file')->storeAs('images', $image_name, 's3');
                
                // Set the file visibility to public
                Storage::disk('s3')->setVisibility($path, "public");

            } catch (\Exception $e) {
                // Log the exception and return error response to help with debugging
                return $this->sendError('Image upload error.', ['error' => $e->getMessage()]);
            }

            $article->image_url = $path;
        }

        

        $article->title = $request['title'];
        $article->author = $request['author'];
        $article->link = $request['link'];
        $article->publication_id = $request['publication_id'];

        $article->save();

        if ($request->has('topics')) {
            $article->topics()->sync($request->topics);
        }

        if (isset($article->image_url)) {
            $article->image_url = $this->getS3Url($article->image_url);
        }

        $success['article'] = $article;
        return $this->sendResponse($success, 'Article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \Illuminate\Http\Request  $request -> PUT /articles/{id} {payload}
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'link' => 'required|url',
            'publication_id' => 'required|integer',
            'topics'    => 'nullable|array',
            'topics.*'  => 'integer|exists:topics,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $article = Article::findOrFail($id);
        $article->title = $request['title'];
        $article->author = $request['author'];
        $article->link = $request['link'];
        $article->publication_id = $request['publication_id'];

        $article->save();
        if ($request->has('topics')) {
            $article->topics()->sync($request->topics);
        }

        if (isset($article->image_url)) {
            $article->image_url = $this->getS3Url($article->image_url);
        }
        $success['article'] = $article;
        return $this->sendResponse($success, 'Article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        Storage::disk('s3')->delete($article->image_url);
        $article->delete();

        $success['article'] = $article;
        return $this->sendResponse($success, 'Article deleted successfully.');
    }

    public function updateArticlePicture(Request $request, string $id)
{
    // Validate that an image file is provided
    $validator = Validator::make($request->all(), [
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,avif|max:2048',
    ]);
    if ($validator->fails()) {
        return $this->sendError('Validation Error.', $validator->errors());
    }

    // Find the article or return 404
    $article = Article::findOrFail($id);

    if ($request->hasFile('image')) {
        try {
            // Delete the existing image file from S3 (if any)
            if ($article->image_url) {
                Storage::disk('s3')->delete($article->image_url);
            }

            $extension = $request->file('image')->getClientOriginalExtension();
            $image_name = time() . '_article_' . $id . '.' . $extension;

            // Store the new file on S3 under the "images" folder
            $path = $request->file('image')->storeAs('images', $image_name, 's3');

            // Set the file visibility to public
            Storage::disk('s3')->setVisibility($path, "public");
        } catch (\Exception $e) {
            return $this->sendError('Image upload error.', ['error' => $e->getMessage()]);
        }

        // Update article record with the new image URL
        $article->image_url = $path;
        $article->save();

        // Optionally, get the public URL for the image (using your existing helper)
        $article->image_url = $this->getS3Url($article->image_url);

        return $this->sendResponse(['article' => $article], 'Article picture updated successfully.');
    } else {
        return $this->sendError('No image file provided.', ['error' => 'Image file missing']);
    }
}
}
