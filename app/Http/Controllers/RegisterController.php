<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\shopOwner;
use App\Models\customer;
use Illuminate\Support\Facades\Hash;
use Mail;


class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
            
            $this->sendEmailShop($newShop);
            $info =shopOwner::where('email',$request->email)->get();

            return view('shop/auth/verification')->with('success','Please Verify Email before Proceeding')->with('shop',$info);
      

        }


    public function sendEmail($customer){

        Mail::send(
            'customer.auth.verifyEmail',
            ['customer'=> $customer],
            function($message) use ($customer){
                $message->to($customer->email);
                $message->subject("$customer->name, Verify Your Email");
            }
        );
    }
    public function resendEmail($custID){
        $customer = customer::where('id',$custID)
        ->first();
        Mail::send(
            'customer.auth.verifyEmail',
            ['customer'=> $customer],
            function($message) use ($customer){
                $message->to($customer->email);
                $message->subject("$customer->name, Verify Your Email");
            }
        );
        $data = [
            'LoggedCustomerInfo'=> $customer
        ];
        return view('customer/auth/verification')->with('success','Please Verify Email before Proceeding')->with('cust',$data);

    }

    public function sendEmailShop($shop){
        Mail::send(
            'shop.auth.verifyEmail',
            ['shop'=> $shop],
            function($message) use ($shop){
                $message->to($shop->email);
                $message->subject("$shop->name, Verify Your Email Shop Owner");
            }
        );
    }

    public function resendEmailShop($shopID){
        $shopOwner = shopOwner::where('id',$custID)
        ->first();
        Mail::send(
            'customer.auth.verifyEmail',
            ['customer'=> $customer],
            function($message) use ($customer){
                $message->to($customer->email);
                $message->subject("$customer->name, Verify Your Email");
            }
        );
        $data = [
            'LoggedShopInfo'=> $shopOwner
        ];
        return view('customer/auth/verification')->with('success','Please Verify Email before Proceeding')->with('shop',$data);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('customer.auth.registerCust');
    }

    public function store(Request $request)
    {
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

        
        $this->sendEmail($newCust);
        $info =customer::where('email',$request->email)->get();
        return view('customer/auth/verification')->with('success','Please Verify Email before Proceeding')->with('cust',$info);
    }

    
    public function show($id)
    {
        $update = shopOwner::where('id',$id)
        ->update([
            'is_verified' => 'true'
            ]);
     return redirect('shop/shoplogin')->with('success','You have been successfully registered');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $update = customer::where('id',$id)
        ->update([
            'is_verified' => 'true'
            ]);
        return redirect('customer/custLogin')->with('success','You have been successfully registered');

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
