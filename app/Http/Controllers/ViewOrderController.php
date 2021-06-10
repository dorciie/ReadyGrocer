<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\shopOwner;
use App\Models\customer;
use Mail;

class ViewOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->has('LoggedShop')){
            $shopOwner = DB::table('shop_owners')
            ->where('id', session('LoggedShop'))
            ->first();

            $data = [
                'LoggedShopInfo'=> $shopOwner
            ];
        }
        return view('shop.order.index',$data);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customer()
    {
        if(session()->has('LoggedShop')){
            $shopOwner = DB::table('shop_owners')
            ->where('id', session('LoggedShop'))
            ->first();

            $data = [
                'LoggedShopInfo'=> $shopOwner
            ];
        }
        return view('shop.order.customer',$data);
    }
    // public function create()
    // {
    //     //
    // }

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

    public function deliverOrder(Request $request)
    {
        //dd($request->all());
        $customer = DB::table('customers')
            ->where('email', $request->custEmail)
            ->first();

        // if($customer == null){
        //     return redirect()->back()->with(['error' => 'Unsuccesfull, please try again']);
        // }

        $this->deliveryEmail($customer);
        // return redirect()->back()->with(['success' => 'Succesfully notify customer about delivery info']);
    }

    public function deliveryEmail($customer){
        Mail::send(
            'shop.order.deliverEmail',
            ['customer'=> $customer],
            function($message) use ($customer){
                $message->to($customer->email);
                $message->subject("$customer->name, uwu your order are on the way");
            }
        );
    }
}
