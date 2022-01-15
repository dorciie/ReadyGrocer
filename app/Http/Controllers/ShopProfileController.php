<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\shopOwner;
use App\Models\Order;
use File;
use Illuminate\Support\Facades\Storage;

date_default_timezone_set("Asia/Kuala_Lumpur");
class ShopProfileController extends Controller
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
        $shopOwner = DB::table('shop_owners')
            ->where('id', session('LoggedShop'))
            ->first();
        return view('shop.profile.index',$data,compact('shopOwner'));
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
        if(session()->has('LoggedShop')){
            $shopOwner = DB::table('shop_owners')
            ->where('id', session('LoggedShop'))
            ->first();

            $data = [
                'LoggedShopInfo'=> $shopOwner
            ];
        }
        return view('shop.profile.password',$data);
    }

    public function updatePassword(Request $request){
        $request->validate([
            'changePassword'  => 'required|min:5|max:12',
            'newPassword'  => 'required|min:5|max:12',
            'confirmPassword'  => 'required|min:5|max:12'
        ]);
        if(session()->has('LoggedShop')){
            $shopOwner = DB::table('shop_owners')
            ->where('id', session('LoggedShop'))
            ->first();

            $data = [
                'LoggedShopInfo'=> $shopOwner
            ];
        }
        $shopOwner = DB::table('shop_owners')
            ->where('id', session('LoggedShop'))
            ->first();

        if(Hash::check($request->changePassword, $shopOwner->password)){
                if($request->newPassword == $request->confirmPassword){
                    $todayDate = date('Y-m-d H:i:s');
                    $query = DB::table('shop_owners')
                        ->where('id', $shopOwner->id)
                        ->update([
                            'password'=> Hash::make($request->newPassword),
                            'updated_at'=> $todayDate
                        ]);
                    if($query){
                        return redirect()->route('profile.index')->with('success','Successfully change password');
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

    public function updateImage(Request $request)
    {
        $shopOwner = DB::table('shop_owners')
                    ->where('id',session('LoggedShop'))
                    ->first();
        // $user = User::where('id', '=', Auth::user()->id)->get();

        request()->validate([
            'image' => 'required',

        ]);

        if ($request->file('image') == null){
            if(($shopOwner->shop_image) != NULL){
                Storage::delete('/public/'.$shopOwner->shop_image);
            }
            $name = "";
            $path = "";
            $naming = NULL;

        } elseif ($request->image == "none"){
            if(($shopOwner->shop_image) != NULL){
                Storage::delete('/public/'.$shopOwner->shop_image);
            }
            $name = "";
            $path = "";
            $naming = NULL;

        } else { //request current image and delete 
            if(($shopOwner->shop_image) != NULL){
                Storage::delete('/public/'.$shopOwner->shop_image);
            }
            $name = $request->file('image');
            $path = $request->file('image')->store('shopProfile', 'public');
            $naming = $request->file('image')->store('shopProfile', 'public');
        }
 
        $save = new File;
 
        $save->name = $name;
        $save->path = $path;

        // $user->update([
        //     'image' => $naming,
        // ]);
        
        $user = DB::table('shop_owners')
              ->where('id',session('LoggedShop'))
              ->update(['shop_image' => $naming]);

              return redirect()->route('profile.index')->with('success','Successfully update the profile image');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(session()->has('LoggedShop')){
            $shopOwner = DB::table('shop_owners')
            ->where('id', session('LoggedShop'))
            ->first();

            $data = [
                'LoggedShopInfo'=> $shopOwner
            ];
        }

        $shopOwner=shopOwner::find($id);
        if($shopOwner){
            return view('shop.profile.edit',$data,compact('shopOwner'));
        }else{
            return back()->with('error','Data not found');
        }
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
        $shopOwner=shopOwner::find($id);

        if($shopOwner){
            $this->validate($request,[
                'name'=>'required|string',
                // 'email'=>'required|email',
                'shopName'=>'required|string',
                'address'=>'required|string',
                // 'password'  => 'required|min:5|max:12',
                'shop_description'=>'nullable',
                'phone_number'=>'required|numeric',
                'delivery_charge' => 'required|numeric',
                'address_latitude' => 'required',
                'address_longitude' => 'required'
            ]);

            // if ($request->hasFile('shop_image')) {
            //     Storage::delete('/public/'.$shopOwner->shop_image);       
            //     $path = $request->shop_image->store('shopProfile', 'public');
            //     // $item->item_image= $path;
           

            //     $todayDate = date('Y-m-d H:i:s');
            //     $query = DB::table('shop_owners')
            //             ->where('id', $id)
            //             ->update([
            //                 'name'=> $request->name,
            //                 'shopName'=> $request->shopName,
            //                 'address'=> $request->address, 
            //                 'phone_number'=> $request->phone_number, 
            //                 'delivery_charge'=> $request->delivery_charge, 
            //                 'shop_description'=> $request->shop_description, 
            //                 'shop_image'=> $path,
            //                 'address_latitude'=>$request->address_latitude,
            //                 'address_longitude'=>$request->address_longitude,
            //                 'updated_at'=> $todayDate
            //             ]);
        
            //     if($query){
            //         return redirect()->route('profile.index')->with('success','Successfully updated profile');
            //     }else{
            //         return back()->with('error','Something went wrong');
            //     }

            // }else{
                $todayDate = date('Y-m-d H:i:s');
                $query = DB::table('shop_owners')
                        ->where('id', $id)
                        ->update([
                            'name'=> $request->name,
                            'shopName'=> $request->shopName,
                            'address'=> $request->address, 
                            'phone_number'=> $request->phone_number, 
                            'delivery_charge'=> $request->delivery_charge, 
                            'shop_description'=> $request->shop_description, 
                            'address_latitude'=>$request->address_latitude,
                            'address_longitude'=>$request->address_longitude,
                            'updated_at'=> $todayDate
                        ]);
                        if($query){
                            return redirect()->route('profile.index')->with('success','Successfully update profile');
                        }else{
                            return back()->with('error','Something went wrong');
                        }

            // }
        
        }else{
                return back()->with('error','Data not found');
            }
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
