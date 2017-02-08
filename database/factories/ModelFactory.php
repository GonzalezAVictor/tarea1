<?php

use App\Tag;
use App\Address;
use App\Product;
use App\Seller;
use App\Review;
use Faker\Generator;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

//--------   Address   --------
$factory->define(Address::class, function(Generator $faker){
	return[
		'address'=> $faker->address,
		'city' => $faker->city,
		'region' => $faker->state,
		'country' => $faker->country,
		'postal_code' => $faker->postcode,
		'seller_id' => function () {
            return factory(Seller::class)->create()->id;
        }
	];
});

// --------   Product   --------
$factory->define(Product::class, function(Generator $faker){
	return[
		'name' => $faker->name,
		'cost' => $faker->randomFloat,
		'description' => $faker->text($maxNbChars = 100),
		'seller_id' => function () {
            return factory(Seller::class)->create()->id;
        }
	];
});

//--------   Seller   -------
$factory->define(Seller::class, function (Generator $faker){
	return[
		'name' => $faker->name,
		'last_name' =>$faker->lastName
	];
});

//--------   Tag   -------
$factory->define(Tag::class, function (Generator $faker){
	return[
		'name' => $faker->countryCode
	];
});

//--------   Review   -------
$factory->define(Review::class, function(Generator $faker){
	return [
		'reviewer_name' => $faker->name,
		'title' => $faker->title,
		'content' => $faker->text($maxNbChars = 200),
		'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
		'product_id' => function () {
            return factory(Product::class)->create()->id;
        }
	];
});

