<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = ['title', 'summary', 'author'];

    // DEFINITON DE LA RELATION x:N
	public function chapters()
	{
		return $this->hasMany(Chapter::class); // Relation (1:)N
	}
}
