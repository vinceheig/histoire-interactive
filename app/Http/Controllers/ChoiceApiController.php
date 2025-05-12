<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChoiceStoreRequest;
use App\Http\Requests\ChoiceUpdateRequest;
use App\Models\Choice;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class ChoiceApiController extends Controller
{
    public function getChoices()
    {
        try {
            $choices = Choice::all();
            return response()->json([
                'status' => 'success',
                'data' => $choices
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve choices'
            ], 500);
        }
    }
    
    public function getChoice($id)
    {
        try {
            $choice = Choice::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'data' => $choice
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Choice not found'
            ], 404);
        }
    }
    
    public function createChoice(ChoiceStoreRequest $request)
    {
        try {
            $choice = Choice::create($request->validated());
            return response()->json([
                'status' => 'success',
                'data' => $choice,
                'message' => 'Choice created successfully'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create choice'
            ], 500);
        }
    }
    
    public function updateChoice(ChoiceUpdateRequest $request, $id)
    {
        try {
            $choice = Choice::findOrFail($id);
            $choice->update($request->validated());
            return response()->json([
                'status' => 'success',
                'data' => $choice,
                'message' => 'Choice updated successfully'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Choice not found'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update choice'
            ], 500);
        }
    }
    
    public function deleteChoice($id)
    {
        try {
            $choice = Choice::findOrFail($id);
            $choice->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Choice deleted successfully'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Choice not found'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete choice'
            ], 500);
        }
    }
}
