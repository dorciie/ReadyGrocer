<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\GroceryCart;
use App\Models\ShopOwner;

use Illuminate\Http\Request;

class CustOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = order::where('customer_id', session('LoggedCustomer'))->get();
        return view('customer.order.orders')->with('order',$order);
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
        $cart = GroceryCart::where('order_id',$id)->get();
        $order = Order::find($id);
        return view('customer.order.orderDetails',compact('cart','order'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $update = Order::where('id',$id)
        ->update([
            'status' => 'Delivered'
                 ]);
        
                 return back();
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
        $shop = ShopOwner::where('id',Order::where('id',$id)->value('shop_id'))->first();
        $count = Order::where('shop_id',$shop->id)->whereNotNull('rate')->count();

        $update = Order::where('id',$id)
        ->update([
            'rate' => $request->rating,
            'comment' => $request->comment
            ]);

        
        
        $updateshop = ShopOwner::where('id',$shop->id)
        ->update([
            'rating'=> (($shop->rating)*($count)+($request->rating))/($count+1)
        ]);
            
            if($update){
                        return back()->with('success','Thank you for your feedback!');

            }
            return back()->with('error','Rating error');
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
