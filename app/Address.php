<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = "addresses";

	protected $fillable = [
		'address',
		'city',
		'region',
		'country',
		'postal_code',
		'seller_id'
	];

	public function seller(){ //utilizado
		return $this->belongsTo('App\Seller');
	}

}
