<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable = ['text', 'nextChapterId', 'chapterId'];
    public function chapter()
	{
		return $this->belongsTo(Chapter::class, 'chapterId'); // Relation 1(:N)
	} 
}
