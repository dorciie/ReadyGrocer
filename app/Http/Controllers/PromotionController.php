<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\shopOwner;
use App\Models\Category; 
use App\Models\ShopItem; 

date_default_timezone_set("Asia/Kuala_Lumpur");
class PromotionController extends Controller
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
        $shopItem=ShopItem::orderBy('item_startPromo','ASC')
        ->where('shop_id',$shopOwner->id)
        ->whereNotNull('item_discount')
        ->whereNotNull('item_endPromo')
        ->whereNotNull('item_startPromo')
        ->get();

        //delete promotion after end date of the promotion
        $shopItems = DB::table('shop_items')
        ->where('shop_id',$shopOwner->id)
        ->whereNotNull('item_discount')
        ->whereNotNull('item_endPromo')
        ->whereNotNull('item_startPromo')
        ->get();
        foreach ($shopItems as $items) {
            $todayDate = date('Y-m-d');
            $item_endPromo = $items->item_endPromo;
            if($todayDate > $item_endPromo){
                $query = DB::table('shop_items')
                    ->where('shop_id',$shopOwner->id)
                    ->whereNotNull('item_discount')
                    ->whereNotNull('item_endPromo')
                    ->whereNotNull('item_startPromo')
                    ->where('item_endPromo',$item_endPromo)
                    ->update([
                        'item_startPromo'=> NULL, //
                        'item_endPromo'=> NULL, //
                        'offer_price'=> "0.00", //
                        'item_discount'=> "0.00", //
                    ]);
            }
        }

        return view('shop.promotion.index',$data, compact('shopItem'));
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
        return view('shop.promotion.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'item_startPromo'=>'required',
            'item_endPromo'=>'required|after_or_equal:item_startPromo',
            'item_discount'=>'required|numeric',
        ]);

        // $offer_price=($request->item_price-(($request->item_price*$request->item_discount)/100));
        // $allItem = array();
        foreach($request->items_id as $item){
            // $i=0;
            $shopItems = DB::table('shop_items')
            ->where('id', $item)
            ->first();

            $itemPrice = $shopItems->item_price;
            $offer_price=($itemPrice-(($itemPrice*$request->item_discount)/100));
            $item_startPromo = date('Y-m-d',strtotime($request->item_startPromo));
            $item_endPromo = date('Y-m-d',strtotime($request->item_endPromo));
            $todayDate = date('Y-m-d H:i:s');
            $query = DB::table('shop_items')
                ->where('id', $item)
                ->update([
                    'item_startPromo'=> $item_startPromo, //
                    'item_endPromo'=> $item_endPromo, //
                    'offer_price'=> $offer_price, //
                    'item_discount'=> $request->item_discount, //
                    'updated_at'=> $todayDate
                ]);
        }
        if($query){
            return redirect()->route('promotion.index')->with('success','Successfully schedule the promotion to the item(s)');
        }else{
            return back()->with('error','Something went wrong');
        }
        // return $allItem;
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
            return view('shop.promotion.edit',$data,compact('item'));
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
                'item_startPromo'=>'required',
                'item_endPromo'=>'required|after_or_equal:item_startPromo',
                'item_discount'=>'required|numeric'
            ]);
                $todayDate = date('Y-m-d H:i:s');
                $offer_price=($item->item_price-(($item->item_price*$request->item_discount)/100));
                $query = DB::table('shop_items')
                        ->where('id', $id)
                        ->update([
                            'item_startPromo'=> $request->item_startPromo, //
                            'item_endPromo'=> $request->item_endPromo, //
                            'offer_price'=> $offer_price, //
                            'item_discount'=> $request->item_discount, //
                            'updated_at'=> $todayDate
                        ]);
        
                if($query){
                    return redirect()->route('promotion.index')->with('success','Successfully updated promotion');
                }else{
                    return back()->with('error','Something went wrong');
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
                $todayDate = date('Y-m-d H:i:s');
                $query = DB::table('shop_items')
                        ->where('id', $id)
                        ->update([
                            'item_startPromo'=> NULL, //
                            'item_endPromo'=> NULL, //
                            'offer_price'=> NULL, //
                            'item_discount'=> NULL, //
                            'updated_at'=> $todayDate
                        ]);
            if($query){
                return redirect()->route('promotion.index')->with('success','Successfully delete the item');
            }
            else{
                return back()->with('error','Something went wrong');
            }
        }else{
            return back()->with('error','Data not found');
        }
    }
}
