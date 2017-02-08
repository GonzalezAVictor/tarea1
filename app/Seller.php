<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $table = "sellers";

	protected $fillable = [
		'name',
		'last_name',
	];

	public function products(){ //utilizado
		return $this->hasMany('App\Product');
	}

	public function seller_address(){ //utilizado
		return $this->hasOne('App\Address');
	}
}
