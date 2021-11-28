<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use App\Models\ShopItem;
use App\Models\Customer;
use App\Models\GroceryCart;
use App\Models\GroceryList;
use App\Models\Order;
use Illuminate\Support\Facades\DB;


class GroceryCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function cart(Request $request,$itemID)
    {
        $item = ShopItem::find($itemID);
        $qty=$item->item_stock;
        $this->validate($request,[
            'item_quantity'=>'required|numeric|max:'.$qty,
        ]);

        if(session()->has('LoggedCustomer')){
            $customer = customer::where('id', session('LoggedCustomer'))
            ->first();
        }
        
        if (GroceryCart::where('item_id', $item->id)->where('customer_id', $customer->id)->where('checkout','false')->exists()) {
            
              return back()->with('error','already exits in your Grocery Cart');
    }
        $dt = now();
        $newCart = new GroceryCart;
            $newCart->customer_id=$customer->id;
            $newCart->shop_id=$customer->fav_shop;
            $newCart->item_id=$itemID;
            if (($dt >= $item->item_startPromo) && ($dt <= $item->item_endPromo)){                //check also if promo_date not null //check if date today is between item_startPromo & item_endPromo
                $newCart->total_price=($item->offer_price)*($request->item_quantity);            //check
            }else{
                $newCart->total_price=($item->item_price)*($request->item_quantity);
            }
            $newCart->item_quantity=$request->input('item_quantity');

            $newCart->save();
         return back()->with('success','successful');

        

    }

    public function cart2($itemID)
    {
        $customer = customer::find(session('LoggedCustomer'));
            
        $item = ShopItem::find($itemID);
        $qty=$item->item_stock;
        $list = GroceryList::where('item_id', $itemID)->where('customer_id',session('LoggedCustomer'))
        ->first();
        
        if(($list->item_quantity)>$qty){
            return back()->with('error','Item quantity is over item stock');
        }
        if (GroceryCart::where('item_id', $item->id)->where('customer_id', $customer->id)->where('checkout','false')->exists()) {
              return back()->with('error','already exits in your Grocery Cart');
        }

        $dt = now();

        $newCart = new GroceryCart;
            $newCart->customer_id=$customer->id;
            $newCart->shop_id=$customer->fav_shop;
            $newCart->item_id=$itemID;
            $newCart->item_quantity=$list->item_quantity;
        if (($dt >= $item->item_startPromo) && ($dt <= $item->item_endPromo)){       //check if date today is between item_startPromo & item_endPromo
            $newCart->total_price=($item->offer_price)*($list->item_quantity);            //check
        }else{
            $newCart->total_price=($item->item_price)*($list->item_quantity);
        }
         $newCart->save();
         return back()->with('success','successful');

    }

    public function editItem(){

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
        $item = DB::table('grocery_carts')
        ->join('shop_items','grocery_carts.item_id','=','shop_items.id')
        ->first();

        $itemID = GroceryCart::where('id',$id)->value('item_id');
       
        $qty = ShopItem::where('id',$itemID)->value('item_stock');
        
        $this->validate($request,[
            'item_quantity'=>'required|numeric|max:'.$qty,
        ]);

        $update = GroceryCart::where('id',$id)
        ->update([
            'item_quantity' => $request->item_quantity,
            'total_price' =>($item->offer_price)*($request->item_quantity)
             ]);
    
            return back();
       
    }
    
    public function checkout(Request $request){
        $customer = customer::where('id', session('LoggedCustomer'))
        ->first();

        $order = GroceryCart::where('customer_id',session('LoggedCustomer'))
        ->where('checkout','false')->where('shop_id',$customer->fav_shop)->get();

// validate can be use for $request only kot
    //     $this->validate($request,[
    //         'item_quantity'=>'required|numeric|max:'.$stock,
    //     ]);

    // find() kena declare dulu
        foreach($order as $order){
            if($order->item_quantity>(ShopItem::where('id',$order->item_id)->value('item_stock'))){
                return back()->with('error','item more than stock');
            }
        }

        $createOrder = new Order;
        $createOrder->payment =$request->payment;
        $createOrder->customer_id=$customer->id;
        $createOrder->shop_id=$customer->fav_shop;
        // $createOrder->status = 'pending delivery';//
        $createOrder->total_payment = $request->totalPrice;
        $createOrder->status = 'preparing';

        if($request->delivery ==='deliveryLater'){
            $createOrder->checkOutDelivery = $request->deliveryDT;
        }else{
            $createOrder->checkOutDelivery = now(); 
        }
        
        $createOrder->save();

        $order2 = GroceryCart::where('customer_id',session('LoggedCustomer'))
        ->where('checkout','false')->where('shop_id',$customer->fav_shop)->get(); //why kena fetch data again eh

        foreach($order2 as $order){
            $update = GroceryCart::where('customer_id',session('LoggedCustomer'))->where('item_id',$order->item_id)->where('checkout','false')
            ->update([
                'checkout' => 'true',
                // 'payment' => $request->payment,
                'order_id'=> $createOrder->id,
                ]);

            $updateitem = ShopItem::where('id',$order->item_id)
            ->update([
                'item_stock' => (ShopItem::where('id',$order->item_id)->value('item_stock'))-($order->item_quantity),
                ]);

            $updatelist = GroceryList::where('item_id',$order->item_id)
            ->update([
                'last_bought' => now(),
            ]); 
        }
            
            if($update){
                $cart = $order2;
                $order = $createOrder;
                   return view('customer.order.orderDetails',compact('cart','order'))->with('success','Cart has been checkout');

                // return view('customer.cart.checkout')->with('success','Cart has been checkout');
            }
            return back()->with('error','Cart cannot be check out');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item =  GroceryCart::find($id);
        $item->delete();

        return back();
    }
}
