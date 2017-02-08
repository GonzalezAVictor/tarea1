<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
    	'name',
    	'cost',
    	'description'
    ];

    public function reviews(){ //utilizado
    	return  $this->hasMany('App\Review');
    }

    public function tags(){ //utilizado
    	return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function seller(){ //utilizado
    	$this->belongsTo('App\Seller');	
    }
}
