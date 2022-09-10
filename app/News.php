<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class News extends Model
{
    protected $fillable = ['user_id', 'category_id', 'title', 'content'];

    public function category()
	{
		return $this->belongsto('App\Category');
	}

	public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

}
