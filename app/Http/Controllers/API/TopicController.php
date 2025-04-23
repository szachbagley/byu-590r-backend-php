<?php

namespace App\Http\Controllers\API;
use App\Models\Topic;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

class TopicController extends BaseController
{
    public function index()
    {
        return $this->sendResponse(Topic::all(),'Topics retrieved');
    }

    public function show($id)
    {
        $topic = Topic::with('articles')->findOrFail($id);
        return $this->sendResponse($topic,'Topic retrieved');
    }
}
