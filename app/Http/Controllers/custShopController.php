<?php

namespace App\Http\Controllers;
use App\Models\customer;
use App\Models\shopOwner;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class custShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->has('LoggedCustomer')){
        $customer = customer::where('id', session('LoggedCustomer'))
        ->first();}
        
        $shops = shopOwner::all()->toArray();

        return view('customer.shop.tables',compact('shops'))->with('custID',$customer);
    }

    public function shopdetails($shopID)
    {
        if(session()->has('LoggedCustomer')){
            $customer = DB::table('customers')
            ->where('id', session('LoggedCustomer'))
            ->first();}
            
        $shopdetail = DB::table('shop_owners')->get()->where('id', $shopID)->toArray();

        return view('customer.shop.shopDetails',compact('shopdetail'))->with('custID',$customer);
    }

    public function favShop($shopID)
    {
        if(session()->has('LoggedCustomer')){
            $customer = customer::where('id', session('LoggedCustomer'))
            ->first();}
            
         customer::where('id', $customer->id) //letak cust id
              ->update(['fav_shop' => $shopID]);
    
        return back()->with('success','Favourite shop is updated!');
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