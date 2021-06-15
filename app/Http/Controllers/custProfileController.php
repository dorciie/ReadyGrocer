<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;

class custProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = customer::all()->where('id',session('LoggedCustomer'));
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
