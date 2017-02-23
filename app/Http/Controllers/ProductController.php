<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use App\Product;
use App\Tag;
use App\Seller;
use App\Review;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response::json(Seller::with('products.tags')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            
            $attributes = $request->all();

            $tagsExists = true;

            $tags = [];

            foreach ($attributes['tags'] as $tag) {
                if (Tag::where('name', '=', $tag) === null) {
                    $newTag = new Tag();
                    $newTag->name = $tag;
                    $newTag->save();
                    $tags[] = $newTag;
                }else{
                    $newTag = Tag::where('name', '=', $tag)->get();
                    $tags[] = $newTag[0]->id;
                }
            }


            $product = new Product();

            if (Seller::find($attributes['seller_id']) !== null) {
                $product = new Product();
                $product->name = $attributes['name'];
                $product->description = $attributes['description'];
                $product->seller_id = $attributes['seller_id'];
                $product->cost = $attributes['cost'];
                $product->save();
                // return Response::json($product);
            }else{
                return 'invalid seller_id';
            }

            foreach ($tags as $tag) {
                $product->tags()->attach($tag);
            }

            return Response::json($product);
            
        } catch (Exception $e) {
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id)->with('tags')->where('id', '=', $id)->get();
        $seller_id = $product[0]->seller_id;
        $seller = Seller::where('id', '=', $seller_id)->get();
        $seller =  Seller::with('products.tags')->where('id', '=', $seller_id)->get();
        return Response::json($seller);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->isMethod('put')) { //completo

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'cost' => 'required',
                'description' => 'required'
            ]);
            if (!$validator->fails()) {
                $product = Product::find($id);
                $product->fill($attributes)->save();
                return Response::json($product);                
            }else{
                return 'faltan datos :)';
            }

        }else{
            $attributes = $request->all();
            $product = Product::find($id);
            $product->fill($attributes)->save();
            return Response::json($product);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return Response::json($product);
    }

    public function addReview($id, Request $request)
    {
        $attributes = $request->all();
        $review = new Review();
        $review->reviewer_name = $attributes['reviewer_name'];
        $review->title = $attributes['title'];
        $review->content = $attributes['content'];
        $review->date = $attributes['date'];
        $review->product_id = $attributes['product_id'];
        $review->save();
        return $review;
    }
}
