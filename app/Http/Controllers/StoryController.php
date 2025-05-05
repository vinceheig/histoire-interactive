<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoryRequest;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function getForm()
	{
		return view('view_form_story');
	}

	public function validateForm(StoryRequest $request)
	{

		return view('view_confirmation');
	}
    public function create(StoryRequest $request)
	{
		Story::create([
                                    'title' => $request->title,
                                    'summary' => $request->summary,
                                    'author' => $request->author
                                ]);
		return redirect()
			->route('stories.index')
			->with('success', 'Inscription réussie !');
	}
	public function index()
	{
		$stories = Story::all();
		return view('story.index', compact('stories'));
	}

}
