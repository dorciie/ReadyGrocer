<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use File;
use DateTime;

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
        $info = customer::all()->where('id',session('LoggedCustomer'))->first();


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
        if($request->dtdelivery!=NULL){
            
        $input = new DateTime($request->dtdelivery);
        $input=$input->format('H:i');
        $input=strtotime($input);

        $end =strtotime('20:00');
        $start =strtotime('08:00');

        if($input>=$end || $input<=$start) {
            return back()->with('error', 'Please choose different time');
        }
        
        }

        $update = customer::where('id',session('LoggedCustomer'))
        ->update([
            'name' => $request->name,
            'dtdelivery'=>$request->dtdelivery,
            'address'=>$request->address,
            'address_latitude'=>$request->address_latitude,
            'address_longitude'=>$request->address_longitude,
            ]);

            if($request->dtdelivery!=NULL){
                $update = customer::where('id',session('LoggedCustomer'))
                ->update(['autoDelivery'=>$request->autoDelivery]);
            }

            $info = customer::all()->where('id',session('LoggedCustomer'))->first();

         return redirect()->route('custProfile.index')->with('success','Profile Successfully Updated!');

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


    public function updatePassword(Request $request){
        $request->validate([
            'changePassword'  => 'required|min:5|max:12',
            'newPassword'  => 'required|min:5|max:12',
            'confirmPassword'  => 'required|min:5|max:12'
        ]);

        $customer = DB::table('customers')
                    ->where('id',session('LoggedCustomer'))
                    ->first();

        if(Hash::check($request->changePassword, $customer->password)){
                if($request->newPassword == $request->confirmPassword){
                    $todayDate = date('Y-m-d H:i:s');
                    $query = DB::table('customers')
                        ->where('id', $customer->id)
                        ->update([
                            'password'=> Hash::make($request->newPassword),
                            'updated_at'=> $todayDate
                        ]);
                    if($query){
                        return redirect()->route('custProfile.index')->with('success','Successfully change password');

                    }else{
                        return back()->with('error','Something went wrong. Please try again later.')->withInput();
                    }
                }else{
                    return back()->with('error','WARNING! New password and Confirm password are not the same')->withInput();
                }
        }else{
            return back()->with('error','Wrong old password inserted! Please try again.')->withInput();
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $customer = customer::find(session('LoggedCustomer'))->first();

        $data = [
            'LoggedCustomerInfo'=> $customer
        ];
        
        return view('customer.profile.password',$data);
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
