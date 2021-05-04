<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\shopOwner;
use App\Models\customer;

class LogoutController extends Controller
{
    function Shoplogout(){
        if(session()->has('LoggedShop')){
            session()->pull('LoggedShop');
            return view('welcome');
        }
    }

    //Customer...............................................................................................
    function Custlogout(){
        if(session()->has('LoggedCustomer')){
            session()->pull('LoggedCustomer');
            return view('welcome');
        }
    }
}