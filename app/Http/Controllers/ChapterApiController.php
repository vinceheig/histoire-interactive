<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChapterStoreRequest;
use App\Http\Requests\ChapterUpdateRequest;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterApiController extends Controller
{
    public function getChapters() {
        return response()->json(Chapter::all());
    }
    
    public function getChapter($id) {
        return response()->json(Chapter::findOrFail($id));
    }
    
    public function createChapter(ChapterStoreRequest $request) {
        $chapter = Chapter::create($request->validated());
        return response()->json($chapter, 201);
    }
    
    public function updateChapter(ChapterUpdateRequest $request, $id) {
        $chapter = Chapter::findOrFail($id);
        $chapter->update($request->validated());
        return response()->json($chapter);
    }
    
    public function deleteChapter($id) {
        Chapter::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
