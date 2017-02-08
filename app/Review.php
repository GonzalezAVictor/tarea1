<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "reviews";

	protected $fillable = [
		'reviewer_name',
		'title',
		'content',
		'date'
	];

	public function product(){ //utilizado
		return $this->belongsTo('App\Product');
	}
}
