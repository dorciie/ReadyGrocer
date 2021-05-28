<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//untuk password nanti
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\shopOwner;
use App\Models\customer;

class LoginController extends Controller
{
    function Shoplogin(){
        return view('shop.auth.shoplogin');
    }

    function Shopcheck(Request $request){
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|min:5|max:12'
        ]);

        $shopOwner = DB::table('shop_owners')
            ->where('email', $request->email)
            ->first();
        if($shopOwner){ 
            if(Hash::check($request->password, $shopOwner->password)){ 
                $request->session()->put('LoggedShop', $shopOwner->id); 
                return redirect('shop/dashboard');
            }else{
                return back()->with('fail','Invalid email and/or password')->withInput();;
            }
        }else{
            return back()->with('fail','Invalid email and/or password')->withInput();;
        }
    }
    

    //Customer...............................................................................................
    function login(){
        return view('customer.auth.custLogin');
    }

    function check(Request $request){
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|min:5|max:12'
        ]);

        $customer = DB::table('customers')
            ->where('email', $request->email)
            ->first();
        if($customer){ 
            if(Hash::check($request->password, $customer->password)){
                $request->session()->put('LoggedCustomer', $customer->id); 
                return redirect('dashboard');
            }else{
                return back()->with('fail','Invalid password')->withInput();;
            }
        }else{
            return back()->with('fail','No account found for this email')->withInput();;
        }
    }
    function custDashboard(){
        if(session()->has('LoggedCustomer')){
            $customer = DB::table('customers')
            ->where('id', session('LoggedCustomer'))
            ->first();
            
            $shop = DB::table('shop_owners')->get()->where('id', $customer->fav_shop)->toArray();
            
            $data = [
                'LoggedCustomerInfo'=> $customer
            ];
        }
        return view('customer.dashboard',compact('shop'))->with('name',$data);
    }
}