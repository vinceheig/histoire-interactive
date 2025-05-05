<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChoiceStoreRequest;
use App\Http\Requests\ChoiceUpdateRequest;
use App\Models\Choice;

class ChoiceApiController extends Controller
{
    public function getChoices() {
        return response()->json(Choice::all());
    }
    
    public function getChoice($id) {
        return response()->json(Choice::findOrFail($id));
    }
    
    public function createChoice(ChoiceStoreRequest $request) {
        $choice = Choice::create($request->validated());
        return response()->json($choice, 201);
    }
    
    public function updateChoice(ChoiceUpdateRequest $request, $id) {
        $choice = Choice::findOrFail($id);
        $choice->update($request->validated());
        return response()->json($choice);
    }
    
    public function deleteChoice($id) {
        Choice::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
