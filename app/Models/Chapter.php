<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = ['content', 'number', 'storyId'];
    public function choices()
	{
		return $this->hasMany(Choice::class); // Relation (1:)N
	}
    public function story()
	{
		return $this->belongsTo(Story::class); // Relation 1(:N)
	} 
}
