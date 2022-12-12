<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

	// user who commented
	public function author()
	{
		return $this->belongsTo('App\User','from_user');
	}

	public function post()
	{
		return $this->belongsTo('App\Posts','on_post');
	}

}
