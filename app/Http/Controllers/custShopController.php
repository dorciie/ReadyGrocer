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
        
        $customer = customer::where('id', session('LoggedCustomer'))->first();
        $data = [
            'LoggedCustomerInfo'=> $customer
        ];
        $shops = shopOwner::all();

        return view('customer.shop.tables')->with('shops',$shops)->with('cust',$data);
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
    public function show($shopID)
    {
        if(session()->has('LoggedCustomer')){
            $customer = DB::table('customers')
            ->where('id', session('LoggedCustomer'))
            ->first();}
            
        $shopdetail = DB::table('shop_owners')->get()->where('id', $shopID)->toArray();

        return view('customer.shop.shopDetails',compact('shopdetail'))->with('custID',$customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($shopID)
    {
        if(session()->has('LoggedCustomer')){
            $customer = customer::where('id', session('LoggedCustomer'))
            ->first();}
            
         customer::where('id', $customer->id) //letak cust id
              ->update(['fav_shop' => $shopID]);
    
        return back()->with('success','Favourite shop is updated!');
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
