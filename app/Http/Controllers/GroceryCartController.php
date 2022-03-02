<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use App\Models\ShopItem;
use App\Models\Customer;
use App\Models\GroceryCart;
use App\Models\GroceryList;
use App\Models\Order;
use Carbon\Carbon;
use DateTime;
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
        if (GroceryCart::where('customer_id', session('LoggedCustomer'))->where('created_at', '>', now()->subSeconds(10))->exists()) {
           return back()->with('success','Item has successfully added to your Grocery Cart');
        }
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
            
              return back()->with('error','Item already exits in your Grocery Cart');
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
         return back()->with('success','Item has added in your Grocery Cart');

        

    }

    public function cart2($itemID)
    {
        if (GroceryCart::where('customer_id', session('LoggedCustomer'))->where('created_at', '>', now()->subSeconds(10))->exists()) {
           return back()->with('success','Item has successfully added to your Grocery Cart');
        }
        $customer = customer::find(session('LoggedCustomer'));
            
        $item = ShopItem::find($itemID);
        $qty=$item->item_stock;
        $list = GroceryList::where('item_id', $itemID)->where('customer_id',session('LoggedCustomer'))
        ->first();
        
        if(($list->item_quantity)>$qty){
            return back()->with('error','Item quantity is over item stock');
        }
        if (GroceryCart::where('item_id', $item->id)->where('customer_id', $customer->id)->where('checkout','false')->exists()) {
              return back()->with('error','Item already exits in your Grocery Cart');
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

    public function cancel()
    {
        if (GroceryCart::where('customer_id', session('LoggedCustomer'))->where('updated_at', '>', now()->subSeconds(10))->exists()) {
            return back()->with('error','Checkout is cancelled');
         }
        $customer = customer::where('id', session('LoggedCustomer'))->first();

        $order = Order::where('customer_id',session('LoggedCustomer'))->where('shop_id',$customer->fav_shop)->max('id');
        $items = GroceryCart::where('customer_id',session('LoggedCustomer'))->where('order_id',$order)->get();

        foreach($items as $item){ //add quantity yg checkout tadi
            $shopItem = ShopItem::where('id',$item->item_id)->first();
            $update2 = ShopItem::where('id',$item->item_id)->update([
                'item_stock' => ($shopItem->item_stock)+($item->item_quantity),
            ]);
        $update = GroceryCart::where('customer_id',session('LoggedCustomer'))->where('order_id',$order)
            ->update([
                'checkout' => 'false',
                'order_id'=> NULL,
                ]);


       
        };

        $deletedRows = Order::where('id', $order)->delete();

        $info = DB::table('grocery_carts')
        ->join('shop_items','grocery_carts.item_id','=','shop_items.id')
        ->where('customer_id', session('LoggedCustomer'))
        ->where('checkout','false')
        ->where('grocery_carts.shop_id',$customer->fav_shop)
        ->select('grocery_carts.id AS id','grocery_carts.item_quantity AS item_quantity', 'grocery_carts.shop_id AS shop_id',
        'grocery_carts.total_price AS total_price','shop_items.item_brand AS item_brand','shop_items.item_price AS item_price',
        'shop_items.offer_price AS offer_price','shop_items.item_name AS item_name','shop_items.id AS item_id',
        'shop_items.item_startPromo AS item_startPromo','shop_items.item_endPromo AS item_endPromo')
        ->get();

        $now =\Carbon\Carbon::now()->format('H:i:s');;
        $end = '22:00:00';
        $start = '08:00:00';

        return view('customer.cart.groceryCart')->with('info',$info)->with('now',$now)->with('start',$start)->with('end',$end);


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
    
            return back()->with('success','Item has been successfully edited!');
       
    }
    
    public function checkout(Request $request){
       
        $input = new DateTime($request->deliveryDT);
        $input=$input->format('H:i');
        $input=strtotime($input);

        $end =strtotime('20:00');
        $start =strtotime('08:00');
        if($input>=$end || $input<=$start) {
            return back()->with('error', 'Please choose different time');
        }
        if (Order::where('customer_id', session('LoggedCustomer'))->where('created_at', '>', now()->subSeconds(10))->exists()) {
            return view('customer.order.orderDetails',compact('cart','order'))->with('success','Cart has been checkout');
        }

        $customer = customer::where('id', session('LoggedCustomer'))
        ->first();

        $order = GroceryCart::where('customer_id',session('LoggedCustomer'))
        ->where('checkout','false')->where('shop_id',$customer->fav_shop)->get();
    
        foreach($order as $order){
            if($order->item_quantity>(ShopItem::where('id',$order->item_id)->value('item_stock'))){
                return back()->with('error','item more than stock');
            }
        }

        $createOrder = new Order;
        $createOrder->payment =$request->payment;
        $createOrder->customer_id=$customer->id;
        $createOrder->shop_id=$customer->fav_shop;
        $createOrder->total_payment = number_format((float)$request->totalPrice, 2, '.', '');
        $createOrder->status = 'Preparing';
        if($request->delivery ==='deliveryLater'){
            $createOrder->checkOutDelivery = $request->deliveryDT;
        }else{
            $createOrder->checkOutDelivery = now(); 
        }
        
        $createOrder->save();

        $order2 = GroceryCart::where('customer_id',session('LoggedCustomer'))
        ->where('checkout','false')->where('shop_id',$customer->fav_shop)->get(); 

        foreach($order2 as $order){
            $update = GroceryCart::where('customer_id',session('LoggedCustomer'))->where('item_id',$order->item_id)->where('checkout','false')
            ->update([
                'checkout' => 'true',
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
                    if($request->payment ==='Credit/Debit Card'){
                        \Stripe\Stripe::setApiKey('sk_test_51KOJ8oCVYgvhDegI4dhcDA4r9kp37HJUYnhkk3hMPH53d0w3JCbj8NkUP2TWkAsyvB9KFfbNDfMdw79Nr8XazPH100MNpOM3IS');
            
                        $amount =$createOrder->total_payment;
                        $amount *= 100;
                        $amount = (int) $amount;
                        
                        $payment_intent = \Stripe\PaymentIntent::create([
                            'description' => 'Stripe Test Payment',
                            'amount' => $amount,
                            'currency' => 'MYR',
                            'description' => 'Payment From ReadyGrocer',
                            'payment_method_types' => ['card'],
                        ]);
                        $intent = $payment_intent->client_secret;
                
                        return view('customer.cart.credit-card',compact('intent'))->with('totalprice',$createOrder->total_payment);
                    }
                    
                    return view('customer.order.orderDetails',compact('cart','order'))->with('success','Cart has been checkout');
            }
            return back()->with('error','Cart cannot be check out');
    }


    
    public function afterPayment()
    {
        // echo 'Payment Has been Received';
        $customer = customer::where('id', session('LoggedCustomer'))
        ->first();

        $order = Order::where('customer_id',session('LoggedCustomer'))->where('shop_id',$customer->fav_shop)->orderBy('id', 'DESC')->first();

        $cart = GroceryCart::where('customer_id',session('LoggedCustomer'))->where('shop_id',$customer->fav_shop)->where('order_id',$order->id)->get();

        return view('customer.order.orderDetails',compact('cart','order'))->with('success','Cart has been checkout');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedRows = GroceryCart::where('id', $id)->delete();

        return back()->with('success','Item has been successfully deleted!'); 
    }
}
