<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoryRequest;
use App\Http\Requests\StoryUpdateRequest;
use Illuminate\Http\Request; 
use App\Models\Story;
use App\Http\Requests\StoryStoreRequest;
class StoryApiController extends Controller
{
    public function getStories() {
        return response()->json(Story::all());
    }
    
    public function getStory($id) {
        return response()->json(Story::findOrFail($id));
    }
    
    public function createStory(StoryStoreRequest $request) {
        $story = Story::create($request->validated());
        return response()->json($story, 201);
    }
    
    public function updateStory(StoryUpdateRequest $request, $id) {
        $story = Story::findOrFail($id);
        $story->update($request->validated());
        return response()->json($story);
    }
    
    public function deleteStory($id) {
        Story::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
    
}

