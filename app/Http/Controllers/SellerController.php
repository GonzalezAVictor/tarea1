<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use DB;

use App\Seller;


class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response::json(Seller::all());
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
        $attributes = $request->all();
        $seller = Seller::create($attributes);
        return Response::json($seller);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seller = Seller::find($id);
        return $seller;
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
    public function update($id, Request $request)
    {
        if ($request->isMethod('put')) { //completo

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'last_name' => 'required|string',
            ]);
            if (!$validator->fails()) {
                $seller = Seller::find($id);
                $seller->fill($attributes)->save();
                return Response::json($seller);                
            }else{
                return 'faltan datos :)';
            }

        }else{
            $attributes = $request->all();
            $seller = Seller::find($id);
            $seller->fill($attributes)->save();
            return Response::json($seller);
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
        $seller = Seller::find($id);
        $seller_name = $seller['name'];
        // $address = $seller->seller_address();
        // $products = $seller->products();

        $products = DB::table('products')->where('seller_id', '=', $seller->id)->get();

        $seller->delete();

        $data['seller_name'] = $seller_name;
        $data['products'] = $products;
        // $data['address'] = $address;
        return Response::json($data);
    }

    public function partial_update($id, Request $request)
    {
        $attributes = $request->all();

        $seller = Seller::find($id);
        $seller->fill($attributes)->save();

        return Response::json($seller);
    }

    public function attach_address_seller($id, Request $request)
    {   
        
    }
}
