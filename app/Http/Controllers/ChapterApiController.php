<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChapterStoreRequest;
use App\Http\Requests\ChapterUpdateRequest;
use App\Models\Chapter;
use App\Models\Choice;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class ChapterApiController extends Controller
{
    public function getChapters()
    {
        try {
            $chapters = Chapter::all();
            return response()->json([
                'status' => 'success',
                'data' => $chapters
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve chapters'
            ], 500);
        }
    }
    
    public function getChapter($id)
    {
        try {
            $chapter = Chapter::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'data' => $chapter
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Chapter not found'
            ], 404);
        }
    }
    
    public function createChapter(ChapterStoreRequest $request)
    {
        try {
            $chapter = Chapter::create($request->validated());
            return response()->json([
                'status' => 'success',
                'data' => $chapter,
                'message' => 'Chapter created successfully'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create chapter'
            ], 500);
        }
    }
    
    public function updateChapter(ChapterUpdateRequest $request, $id)
    {
        try {
            $chapter = Chapter::findOrFail($id);
            $chapter->update($request->validated());
            return response()->json([
                'status' => 'success',
                'data' => $chapter,
                'message' => 'Chapter updated successfully'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Chapter not found'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update chapter'
            ], 500);
        }
    }
    
    public function deleteChapter($id)
    {
        try {
            $chapter = Chapter::findOrFail($id);
            $chapter->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Chapter deleted successfully'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Chapter not found'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete chapter'
            ], 500);
        }
    }

    public function getChapterChoices($id)
    {
        try {
            $chapter = Chapter::findOrFail($id);
            $choices = Choice::where('chapterId', $id)->get();

            if ($choices->isEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'No choices found for this chapter',
                    'data' => [
                        'chapter' => $chapter,
                        'choices' => []
                    ]
                ], 200);
            }

            return response()->json([
                'status' => 'success',
                'data' => [
                    'chapter' => $chapter,
                    'choices' => $choices
                ]
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Chapter not found'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve chapter choices'
            ], 500);
        }
    }
}
