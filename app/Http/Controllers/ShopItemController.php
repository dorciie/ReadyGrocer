<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\shopOwner;
use App\Models\Category; 
use App\Models\ShopItem; 
use App\Models\GroceryCart; 
use File;
use Illuminate\Support\Facades\Storage;
use App\Imports\ShopItemImport;
use Excel;

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

        //delete promotion after end date of the promotion
        // $shopItems = DB::table('shop_items')
        // ->where('shop_id',$shopOwner->id)
        // ->whereNotNull('item_discount')
        // ->whereNotNull('item_endPromo')
        // ->whereNotNull('item_startPromo')
        // ->get();
        // foreach ($shopItems as $items) {
        //     $todayDate = date('Y-m-d');
        //     $item_endPromo = $items->item_endPromo;
        //     if($todayDate > $item_endPromo){
        //         $query = DB::table('shop_items')
        //             ->where('shop_id',$shopOwner->id)
        //             ->whereNotNull('item_discount')
        //             ->whereNotNull('item_endPromo')
        //             ->whereNotNull('item_startPromo')
        //             ->where('item_endPromo',$item_endPromo)
        //             ->update([
        //                 'item_startPromo'=> NULL, //
        //                 'item_endPromo'=> NULL, //
        //                 'offer_price'=> "0.00", //
        //                 'item_discount'=> "0.00", //
        //             ]);
        //     }
        // }
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
                'item_description'=>'nullable|string',
                'item_size'=>'required',
            ]);

            if($item->item_image == NULL){
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
            }

            if ($request->hasFile('item_image')) {
                    Storage::delete('/public/'.$item->item_image);       
                    $path = $request->item_image->store('item', 'public');

                    $todayDate = date('Y-m-d H:i:s');
                    $query = DB::table('shop_items')
                            ->where('id', $id)
                            ->update([
                                'item_name'=> $request->item_name,
                                'item_brand'=> $request->item_brand,
                                'item_price'=> $request->item_price, //
                                'category_id'=> $request->category_id, //
                                'item_stock'=> $request->item_stock,
                                'item_image'=> $path,
                                'item_description'=> $request->item_description, //
                                'item_size'=> $request->item_size, //
                                'updated_at'=> $todayDate
                            ]);
            
                    if($query){
                        return redirect()->route('item.index')->with('success','Successfully update the item details');
                    }else{
                        return back()->with('error','Something went wrong');
                    }

            }else{
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
                                return redirect()->route('item.index')->with('success','Successfully update the item details');
                            }else{
                                return back()->with('error','Something went wrong');
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
        $groceryCart = GroceryCart::where('item_id', $id)->where('order_id',"!=",NULL)->first();
        if($item){
            if($groceryCart){
                return back()->with('error','This item cannot be deleted to keep track the order history');
            }else{
                $status = $item->delete();
                if($status){
                    Storage::delete('/public/'.$item->item_image); 
                    return redirect()->route('item.index')->with('success','Successfully delete the item');
                }
                else{
                    return back()->with('error','Something went wrong');
                }
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
        ->get([
            'shop_items.id',
            'shop_items.item_name',
            'shop_items.item_brand',
            'shop_items.item_stock',
            'categories.category_name'
        ]);

        $LowStock=DB::table('shop_items')
        ->join('categories','shop_items.category_id','=','categories.id')
        ->where('shop_items.shop_id',$shopOwner->id)
        ->where('shop_items.item_stock','<=','10')
        ->where('shop_items.item_stock','>','0')
        ->get([
            'shop_items.id',
            'shop_items.item_name',
            'shop_items.item_brand',
            'shop_items.item_stock',
            'categories.category_name'
        ]);

        $ActiveStock=DB::table('shop_items')
        ->join('categories','shop_items.category_id','=','categories.id')
        ->where('shop_items.shop_id',$shopOwner->id)
        ->where('shop_items.item_stock','>','10')
        ->get([
            'shop_items.id',
            'shop_items.item_name',
            'shop_items.item_brand',
            'shop_items.item_stock',
            'categories.category_name'
        ]);

        $NoStock=DB::table('shop_items')
        ->join('categories','shop_items.category_id','=','categories.id')
        ->where('shop_items.shop_id',$shopOwner->id)
        ->where('shop_items.item_stock','=','0')
        ->get([
            'shop_items.id',
            'shop_items.item_name',
            'shop_items.item_brand',
            'shop_items.item_stock',
            'categories.category_name'
        ]);

        $time = now();
        $recommendation = DB::select("SELECT * FROM shop_items 
        WHERE shop_items.item_startPromo <= '$time' 
        -- AND shop_items.item_stock > 0
        AND shop_items.item_stock <= 10
        AND shop_items.category_id IN 
        (SELECT category_id FROM shop_items 
         RIGHT JOIN grocery_carts ON shop_items.id = grocery_carts.item_id 
         AND grocery_carts.shop_id = '$shopOwner->id' 
         AND grocery_carts.order_id IS NOT NULL)"
        );

        return view('shop.item.stock',$data, compact('recommendation','Itemstock','LowStock','ActiveStock','NoStock'));
    }

    function editStock(Request $request, $id)
    {
        $item=ShopItem::find($id);
        if($item){
            $this->validate($request,[
                'item_stock'=>'required'
            ]);
            $todayDate = date('Y-m-d H:i:s');
            $query = DB::table('shop_items')
                ->where('id', $id)
                ->update([
                    'item_stock'=> $request->item_stock,
                    'updated_at'=> $todayDate,
                    ]);
        
            // if($query){
                return back()->with('success','Successfully updated stock item');
            // }else{
            //     return back()->with('fail','Something went wrong');
            // }
        }else{
            return back()->with('fail','Data not found');
        }
    }

    public function import(Request $request){
        $this->validate($request,[
            'file'=>'required'
        ]);
        Excel::import(new ShopItemImport, $request->file);
        return back()->with('success','Successfully import items data from excel file.');
    }
    
}
