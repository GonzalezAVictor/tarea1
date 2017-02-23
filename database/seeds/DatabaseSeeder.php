<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $this->call(TagsTableSeeder::class);

        // $this->call(SellersTableSeeder::class);  // se crean con las direcciones

        // $this->call(UsersTableSeeder::class);

    	$this->call(AddressesTableSeeder::class);

    	// $this->call(ProductsTableSeeder::class);

    	// $this->call(ReviewsTableSeeder::class);

        // $products = Product::all();

        // $tags = Tag::all();

        // $count = 1;

        // foreach ($products as $product) {
        //     $product->tags()->attach($tags[$count]);
        //     $count++;
        // }
        
        // $products = Product::all();

        // foreach ($products as $product) {
        //     $product->tags()->attach($tags[$count]);
        //     $count++;
        // }

    }
}
