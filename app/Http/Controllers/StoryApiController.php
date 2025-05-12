<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoryUpdateRequest;
use App\Http\Requests\StoryStoreRequest;
use App\Models\Chapter;
use App\Models\Story;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class StoryApiController extends Controller
{
    public function getStories()
    {
        try {
            $stories = Story::all();
            return response()->json([
                'status' => 'success',
                'data' => $stories
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve stories'
            ], 500);
        }
    }
    
    public function getStory($id)
    {
        try {
            $story = Story::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'data' => $story
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Story not found'
            ], 404);
        }
    }
    
    public function createStory(StoryStoreRequest $request)
    {
        try {
            $story = Story::create($request->validated());
            return response()->json([
                'status' => 'success',
                'data' => $story,
                'message' => 'Story created successfully'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create story'
            ], 500);
        }
    }
    
    public function updateStory(StoryUpdateRequest $request, $id)
    {
        try {
            $story = Story::findOrFail($id);
            $story->update($request->validated());
            return response()->json([
                'status' => 'success',
                'data' => $story,
                'message' => 'Story updated successfully'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Story not found'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update story'
            ], 500);
        }
    }
    
    public function deleteStory($id)
    {
        try {
            $story = Story::findOrFail($id);
            $story->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Story deleted successfully'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Story not found'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete story'
            ], 500);
        }
    }

    public function getStoryChapters($id)
    {
        try {
            $story = Story::findOrFail($id);
            $chapters = Chapter::where('storyId', $id)->get();

            if ($chapters->isEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'No chapters found for this story',
                    'data' => [
                        'story' => $story,
                        'chapters' => []
                    ]
                ], 200);
            }

            return response()->json([
                'status' => 'success',
                'data' => [
                    'story' => $story,
                    'chapters' => $chapters
                ]
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Story not found'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve story chapters'
            ], 500);
        }
    }
}

