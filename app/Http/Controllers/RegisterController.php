<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\shopOwner;
use App\Models\customer;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if(Str::contains($request->status,'shop')){
            $request->validate([
                'name'=>'required',
                'email'=>'required|email|unique:shop_owners',
                'shopName'=>'required',
                'address'=>'required',
                'password'=>'required|min:5|max:12'
                
            ]);

            $newShop = new shopOwner;
            $newShop->name=$request->name;
            $newShop->email=$request->email;
            $newShop->shopName=$request->shopName;
            $newShop->address=$request->address;
            $newShop->password=Hash::make($request->password);
            $newShop->address_latitude=$request->address_latitude;
            $newShop->address_longitude=$request->address_longitude;

            $query = $newShop->save();
    
            // return redirect('profile');
            // return("shop");
            return redirect('shop/shoplogin')->with('success','You have been successfully registered');
        
        }
        else{
            $request->validate([
                'name'=>'required',
                'email'=>'required|email|unique:shop_owners',
                'address'=>'required',
                'password'=>'required|min:5|max:12'
                
            ]);
            $newCust = new customer;
            $newCust->name=$request->name;
            $newCust->email=$request->email;
            $newCust->address=$request->address;
            $newCust->password=Hash::make($request->password);
            $newCust->address_latitude=$request->address_latitude;
            $newCust->address_longitude=$request->address_longitude;
            $query = $newCust->save();
    
            // return redirect('profilecustomer');
            // return("customer");
            return redirect('customer/custLogin')->with('success','You have been successfully registered');

        }

        return ;
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
