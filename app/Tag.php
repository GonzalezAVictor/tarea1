<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = "tags";

	protected $fillable = [
		'name',
	];


	public function products(){ //utilizado
		return $this->belongsToMany('App\Product')->withTimestamps();
	}

}
