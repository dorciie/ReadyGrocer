<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\shopOwner;
use App\Models\Category; 
use App\Models\ShopItem; 
use File;
use Illuminate\Support\Facades\Storage;

date_default_timezone_set("Asia/Kuala_Lumpur");
class ShopItemController extends Controller
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
        $shopItem=ShopItem::orderBy('id','DESC')
        ->where('shop_id',$shopOwner->id)
        ->get();
        return view('shop.item.index',$data, compact('shopItem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(session()->has('LoggedShop')){
            $shopOwner = DB::table('shop_owners')
            ->where('id', session('LoggedShop'))
            ->first();

            $data = [
                'LoggedShopInfo'=> $shopOwner
            ];
        }
        return view('shop.item.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $this->validate($request,[
            'item_name'=>'required|string',
            'item_brand'=>'required|string',
            'item_price'=>'required|numeric',
            'category_id'=>'required|exists:categories,id',
            'item_stock'=>'required|numeric',
            'item_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'item_description'=>'nullable|string',
            'item_size'=>'required',
        ]);

        $shopOwner = DB::table('shop_owners')
        ->where('id', session('LoggedShop'))
        ->first();

        if ($request->hasFile('item_image')) {
        $path = $request->item_image->store('item', 'public');

        $todayDate = date('Y-m-d H:i:s');
        $query = DB::table('shop_items')
                ->insert([
                    'item_name'=> $request->item_name,
                    'item_brand'=> $request->item_brand,
                    'item_price'=> $request->item_price, //
                    'category_id'=> $request->category_id, //
                    'item_stock'=> $request->item_stock,
                    'item_image'=> $path,
                    'item_description'=> $request->item_description, //
                    'item_size'=> $request->item_size, //
                    'created_at'=> $todayDate,
                    'updated_at'=> $todayDate,
                    'shop_id'=>$shopOwner->id
                ]);
        if($query){
            return redirect()->route('item.index')->with('success','Successfully add new item');
        }else{
            return back()->with('error','Something went wrong');
        }
        } else{
            return back()->with('error','Something went wrong');
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
        if(session()->has('LoggedShop')){
            $shopOwner = DB::table('shop_owners')
            ->where('id', session('LoggedShop'))
            ->first();

            $data = [
                'LoggedShopInfo'=> $shopOwner
            ];
        }

        $item=ShopItem::find($id);
        if($item){
            return view('shop.item.edit',$data,compact('item'));
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
        $item=ShopItem::find($id);

        if($item){
            $this->validate($request,[
                'item_name'=>'required|string',
                'item_brand'=>'required|string',
                'item_price'=>'required|numeric',
                'category_id'=>'required|exists:categories,id',
                'item_stock'=>'required|numeric',
                'item_image'=>'image|mimes:jpeg,png,jpg,gif,svg',
                'item_description'=>'nullable|string',
                'item_size'=>'required',
            ]);

            if ($request->hasFile('item_image')) {
                if($item->item_discount !=NULL){
                    Storage::delete('/public/'.$item->item_image);       
                    $path = $request->item_image->store('item', 'public');

                    $offer_price=($request->item_price-(($request->item_price*$item->item_discount)/100));

                    $todayDate = date('Y-m-d H:i:s');
                    $query = DB::table('shop_items')
                            ->where('id', $id)
                            ->update([
                                'item_name'=> $request->item_name,
                                'item_brand'=> $request->item_brand,
                                'item_price'=> $request->item_price, //
                                'offer_price'=> $offer_price, //
                                'category_id'=> $request->category_id, //
                                'item_stock'=> $request->item_stock,
                                'item_image'=> $path,
                                'item_description'=> $request->item_description, //
                                'item_size'=> $request->item_size, //
                                'updated_at'=> $todayDate
                            ]);
            
                    if($query){
                        return redirect()->route('item.index')->with('success','Successfully updated item');
                    }else{
                        return back()->with('error','Something went wrong');
                    }
                }
                else{
                    $todayDate = date('Y-m-d H:i:s');
                    $query = DB::table('shop_items')
                            ->where('id', $id)
                            ->update([
                                'item_name'=> $request->item_name,
                                'item_brand'=> $request->item_brand,
                                'item_price'=> $request->item_price, //
                                'category_id'=> $request->category_id, //
                                'item_stock'=> $request->item_stock,
                                'item_description'=> $request->item_description, //
                                'item_size'=> $request->item_size, //
                                'updated_at'=> $todayDate
                            ]);
                            if($query){
                                return redirect()->route('item.index')->with('success','Successfully updated item');
                            }else{
                                return back()->with('error','Something went wrong');
                            }
                }

            }else{
                if($item->item_discount !=NULL){
                    $todayDate = date('Y-m-d H:i:s');
                    $offer_price=($request->item_price-(($request->item_price*$item->item_discount)/100));
                    $query = DB::table('shop_items')
                            ->where('id', $id)
                            ->update([
                                'item_name'=> $request->item_name,
                                'item_brand'=> $request->item_brand,
                                'item_price'=> $request->item_price, //
                                'offer_price'=> $offer_price, //
                                'category_id'=> $request->category_id, //
                                'item_stock'=> $request->item_stock,
                                'item_description'=> $request->item_description, //
                                'item_size'=> $request->item_size, //
                                'updated_at'=> $todayDate
                            ]);
                            if($query){
                                return redirect()->route('item.index')->with('success','Successfully updated item');
                            }else{
                                return back()->with('error','Something went wrong');
                            }
                    }
                    else{
                        $todayDate = date('Y-m-d H:i:s');
                        $query = DB::table('shop_items')
                                ->where('id', $id)
                                ->update([
                                    'item_name'=> $request->item_name,
                                    'item_brand'=> $request->item_brand,
                                    'item_price'=> $request->item_price, //
                                    'category_id'=> $request->category_id, //
                                    'item_stock'=> $request->item_stock,
                                    'item_description'=> $request->item_description, //
                                    'item_size'=> $request->item_size, //
                                    'updated_at'=> $todayDate
                                ]);
                                if($query){
                                    return redirect()->route('item.index')->with('success','Successfully updated item');
                                }else{
                                    return back()->with('error','Something went wrong');
                                }
                    }

            }
        
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
        $item=ShopItem::find($id);
        if($item){
            $status = $item->delete();
            if($status){
                Storage::delete('/public/'.$item->item_image); 
                return redirect()->route('item.index')->with('success','Successfully delete the item');
            }
            else{
                return back()->with('error','Something went wrong');
            }
        }else{
            return back()->with('error','Data not found');
        }
    }

    public function stock()
    {
        if(session()->has('LoggedShop')){
            $shopOwner = DB::table('shop_owners')
            ->where('id', session('LoggedShop'))
            ->first();

            $data = [
                'LoggedShopInfo'=> $shopOwner
            ];
        }
        $Itemstock=DB::table('shop_items')
        ->join('categories','shop_items.category_id','=','categories.id')
        ->where('shop_items.shop_id',$shopOwner->id)
        ->get();
        return view('shop.item.stock',$data, compact('Itemstock'));
    }

    function editStock(Request $request, $id)
    {
    	$this->validate($request,[
            'item_stock'=>'required'
        ]);
        $todayDate = date('Y-m-d H:i:s');
        $query = DB::table('shop_items')
            ->where('id', $id)
            ->update([
                'item_stock'=> $request->item_stock,
                'updated_at'=> $todayDate
                ]);
    
            if($query){
                return back()->with('success','Successfully updated category');
            }else{
                return back()->with('error','Something went wrong');
            }
    }
    
}
