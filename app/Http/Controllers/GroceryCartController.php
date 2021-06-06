<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use App\Models\ShopItem;
use App\Models\Customer;
use App\Models\GroceryCart;
use App\Models\GroceryList;

class GroceryCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function cart(Request $request,$itemID)
    {
        $this->validate($request,[
            'item_quantity'=>'required',
        ]);

        if(session()->has('LoggedCustomer')){
            $customer = customer::where('id', session('LoggedCustomer'))
            ->first();}

        $item = ShopItem::where('id', $itemID)
        ->first();
        

        if (GroceryCart::where('item_id', $item->id)->where('customer_id', $customer->id)->exists()) {
            
              return back()->with('error','already exits in your Grocery Cart');
    }
       $newCart = new GroceryCart;
            $newCart->customer_id=$customer->id;
            $newCart->shop_id=$customer->fav_shop;
            $newCart->item_id=$itemID;
            $newCart->item_price=($item->offer_price)*($request->item_quantity);
            $newCart->item_quantity=$request->input('item_quantity');

            $newCart->save();
         return back()->with('success','successful');

        

    }

    public function cart2($itemID)
    {
        

        if(session()->has('LoggedCustomer')){
            $customer = customer::where('id', session('LoggedCustomer'))
            ->first();}

        $item = ShopItem::where('id', $itemID)
        ->first();
        $list = GroceryList::where('item_id', $itemID)
        ->first();
        

        if (GroceryCart::where('item_id', $item->id)->where('customer_id', $customer->id)->exists()) {
            
              return back()->with('error','already exits in your Grocery Cart');
    }
       $newCart = new GroceryCart;
            $newCart->customer_id=$customer->id;
            $newCart->shop_id=$customer->fav_shop;
            $newCart->item_id=$itemID;
            $newCart->total_price=($item->offer_price)*($list->item_quantity);
            $newCart->item_quantity=$list->item_quantity;

            $newCart->save();
         return back()->with('success','successful');

        

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
