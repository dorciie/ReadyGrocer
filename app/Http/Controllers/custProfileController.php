<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Facades\Storage;

class custProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = customer::all()->where('id',session('LoggedCustomer'))->first();
        return view('customer.profile.custProfile')->with('info',$info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info = customer::all()->where('id',session('LoggedCustomer'));

        return view('customer.profile.editProfile')->with('info',$info);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $update = customer::where('id',session('LoggedCustomer'))
        ->update([
            'email' => $request->email,
            'address' => $request->address,
            'address_latitude' => $request->address_latitude,
            'address_longitude' => $request->address_longitude,
            'dtdelivery' => $request->dtdelivery,
            'autoDelivery' =>$request->autoDelivery
            ]);
            $info = customer::all()->where('id',session('LoggedCustomer'));
         return view('customer.profile.custProfile')->with('success','Profile Successfully Updated!')->with('info',$info);

    }

    public function updateImage(Request $request)
    {
        $customer = DB::table('customers')
                    ->where('id',session('LoggedCustomer'))
                    ->first();
        // $user = User::where('id', '=', Auth::user()->id)->get();

        request()->validate([
            'image' => 'required',

        ]);

        if ($request->file('image') == null){
            if(($customer->CustImage) != NULL){
                Storage::delete('/public/'.$customer->CustImage);
            }
            $name = "";
            $path = "";
            $naming = NULL;

        } elseif ($request->image == "none"){
            if(($customer->CustImage) != NULL){
                Storage::delete('/public/'.$customer->CustImage);
            }
            $name = "";
            $path = "";
            $naming = NULL;

        } else { //request current image and delete 
            if(($customer->CustImage) != NULL){
                Storage::delete('/public/'.$customer->CustImage);
            }
            $name = $request->file('image');
            $path = $request->file('image')->store('custProfile', 'public');
            $naming = $request->file('image')->store('custProfile', 'public');
        }
 
        $save = new File;
 
        $save->name = $name;
        $save->path = $path;

        // $user->update([
        //     'image' => $naming,
        // ]);
        
        $user = DB::table('customers')
              ->where('id',session('LoggedCustomer'))
              ->update(['CustImage' => $naming]);
        $info = customer::all()->where('id',session('LoggedCustomer'))->first();
              return back()->with('success','Successfully update the profile image')->with('info',$info);
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
