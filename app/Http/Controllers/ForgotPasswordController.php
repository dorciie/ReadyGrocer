<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\shopOwner;
use App\Models\customer;
use Mail;

date_default_timezone_set("Asia/Kuala_Lumpur");
class ForgotPasswordController extends Controller
{
    public function forgot(){
        return view('customer.auth.forgot');
    }

    public function password(Request $request){
        $request->validate([
            'email'     => 'required|email'
        ]);
        //dd($request->all());
        $customer = customer::whereEmail($request->email)->first();

        if($customer == null){
            return redirect()->back()->with(['fail' => 'Email does not exist']);
        }

        $this->sendEmail($customer);
        return redirect()->back()->with(['success' => 'Reset code sent to your email']);
    }

    public function sendEmail($customer){
        Mail::send(
            'customer.auth.email_template',
            ['customer'=> $customer],
            function($message) use ($customer){
                $message->to($customer->email);
                $message->subject("$customer->name, reset your password");
            }
        );
    }

    function reset($email){
        $customer = customer::whereEmail($email)->first();
        if($customer == null){
            return 'Email does not exist';
        }
        return view('customer.auth.reset_password')->with(['customer'=>$customer]);
    }

    function resetPassword(Request $request){
        $request->validate([
            'password'  => 'required|min:5|max:12',
            'password_confirm' => 'required|min:5|max:12'
        ]);

        $customer = customer::whereEmail($request->email)->first();
        if($request->password != $request->password_confirm){
            return redirect()->back()->with(['fail' => 'Please try again']);
        }
        
        $todayDate = date('Y-m-d H:i:s');
        $query = DB::table('customers')
                ->where('email', $request->email)
                ->update([
                    'password'=> Hash::make($request->password),
                    'updated_at' => $todayDate
                ]);
        return redirect('customer/custLogin')->with(['success' => 'Succesfully reset your password']);
    }

    //shop..................................................................
    public function shopforgot(){
        return view('shop.auth.shopforgot');
    }

    public function shoppassword(Request $request){

        $request->validate([
            'email'     => 'required|email'
        ]);
        //dd($request->all());
        $shopOwner = DB::table('shop_owners')
            ->where('email', $request->email)
            ->first();

        if($shopOwner == null){
            return redirect()->back()->with(['fail' => 'Email does not exist']);
        }

        $this->shopsendEmail($shopOwner);
        return redirect()->back()->with(['success' => 'Reset code sent to your email']);
    }

    public function shopsendEmail($shopOwner){
        Mail::send(
            'shop.auth.shopemail_template',
            ['shopOwner'=> $shopOwner],
            function($message) use ($shopOwner){
                $message->to($shopOwner->email);
                $message->subject("$shopOwner->name, reset your password");
            }
        );
    }

    function shopreset($email){
        $shopOwner = DB::table('shop_owners')
            ->where('email', $email)
            ->first();
        if($shopOwner == null){
            return 'Email does not exist shop';
        }
        return view('shop.auth.shopreset_password')->with(['shopOwner'=>$shopOwner]);
    }

    function shopresetPassword(Request $request){
        $request->validate([
            'password'  => 'required|min:5|max:12',
            'password_confirm' => 'required|min:5|max:12'
        ]);

        $shopOwner = DB::table('shop_owners')
            ->where('email', $request->email)
            ->first();
        if($request->password != $request->password_confirm){
            return redirect()->back()->with(['fail' => 'Please Password and Confirm password same']);
        }
        $todayDate = date('Y-m-d H:i:s');
        $query = DB::table('shop_owners')
                ->where('email', $request->email)
                ->update([
                    'password'=> Hash::make($request->password),
                    'updated_at' => $todayDate
                ]);
        return redirect('shop/shoplogin')->with(['success' => 'Succesfully reset your password']);
    }
}


//https://mailtrap.io/inboxes/1300394/messages/2171933818
