<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\shopOwner;
use App\Models\customer;
use App\Models\order;
use Mail;

date_default_timezone_set("Asia/Kuala_Lumpur");
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

        $custOrder=DB::table('orders')
        ->join('customers','orders.customer_id','=','customers.id')
        // ->join('grocery_carts','grocery_carts.order_id','=','orders.id')
        ->where('orders.shop_id',$shopOwner->id)
        ->orderBy('orders.status','ASC')
        ->get([
            'orders.id',
            'orders.total_payment',
            'orders.payment',
            'orders.status',
            'customers.name',
            'orders.checkoutDelivery'
        ]);

        $PreparingOrder=DB::table('orders')
        ->join('customers','orders.customer_id','=','customers.id')
        ->where('orders.shop_id',$shopOwner->id)
        ->where('orders.status','=','Preparing')
        ->orderBy('orders.checkoutDelivery','ASC')
        ->get([
            'orders.id',
            'orders.total_payment',
            'orders.payment',
            'orders.status',
            'customers.name',
            'orders.checkoutDelivery'
        ]);

        $DeliveringOrder=DB::table('orders')
        ->join('customers','orders.customer_id','=','customers.id')
        ->where('orders.shop_id',$shopOwner->id)
        ->where('orders.status','=','Delivering')
        ->get([
            'orders.id',
            'orders.total_payment',
            'orders.payment',
            'orders.status',
            'customers.name',
            'orders.checkoutDelivery'
        ]);

        $DeliveredOrder=DB::table('orders')
        ->join('customers','orders.customer_id','=','customers.id')
        ->where('orders.shop_id',$shopOwner->id)
        ->where('orders.status','=','Delivered')
        ->get([
            'orders.id',
            'orders.total_payment',
            'orders.payment',
            'orders.status',
            'customers.name',
            'orders.checkoutDelivery'
        ]);

        $countOrder=DB::table('orders')
        ->get();

        return view('shop.order.index',$data, compact('custOrder','countOrder','PreparingOrder','DeliveringOrder','DeliveredOrder'));
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customer($order_id)
    {
        if(session()->has('LoggedShop')){
            $shopOwner = DB::table('shop_owners')
            ->where('id', session('LoggedShop'))
            ->first();

            $custOrders=DB::table('grocery_carts')
            ->join('customers','grocery_carts.customer_id','=','customers.id')
            ->join('orders','grocery_carts.order_id','=','orders.id')
            ->join('shop_items','grocery_carts.item_id','=','shop_items.id')
            ->where('grocery_carts.shop_id',$shopOwner->id)
            ->where('grocery_carts.order_id',$order_id)
            ->first();

            $data = [
                'LoggedShopInfo'=> $shopOwner,
                'custOrders'    => $custOrders
            ];
        }

        $custOrder=DB::table('grocery_carts')
        ->join('customers','grocery_carts.customer_id','=','customers.id')
        ->join('orders','grocery_carts.order_id','=','orders.id')
        ->join('shop_items','grocery_carts.item_id','=','shop_items.id')
        ->where('grocery_carts.shop_id',$shopOwner->id)
        ->where('grocery_carts.order_id',$order_id)
        ->get();

        $OverallRate = DB::table('orders')
            ->where('id',$order_id)
            ->where('shop_id', $shopOwner->id)
            ->first(['rate','comment']);

        return view('shop.order.customer',$data, compact('custOrder','OverallRate'));
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

    //email untuk delivery
    public function deliverOrder($deliveryOrder)
    {
        if (Order::where('id', $deliveryOrder)->where('updated_at', '>', now()->subSeconds(10))->exists()) {
            // throw new Exception('Possible multi submit');
            return back()->with('success','An email has been send to customer to inform about the delivery');
        }
        //dd($request->all());
        $custOrder=DB::table('orders')
        ->join('customers','orders.customer_id','=','customers.id')
        ->join('shop_owners','orders.shop_id','=','shop_owners.id')
        ->where('orders.id',$deliveryOrder)
        ->first([
            'orders.id',
            'orders.total_payment',
            'orders.payment',
            'orders.status',
            'customers.name',
            'orders.checkoutDelivery',
            'customers.email',
            'shop_owners.shopName'
        ]);

        $ItemcustOrder=DB::table('grocery_carts')
        ->join('customers','grocery_carts.customer_id','=','customers.id')
        ->join('orders','grocery_carts.order_id','=','orders.id')
        ->join('shop_items','grocery_carts.item_id','=','shop_items.id')
        ->where('grocery_carts.order_id',$deliveryOrder)
        ->get();

        $this->deliveryEmail($custOrder, $ItemcustOrder);
        
        $todayDate = date('Y-m-d H:i:s');
        $query = DB::table('orders')
                ->where('id', $deliveryOrder)
                ->update([
                    'status'=> 'Delivering',
                    'updated_at'=> $todayDate
                ]);
        if($query){
            return back()->with('success','An email has been send to customer to inform about the delivery');
        }else{
            return back()->with('error','Something was not right, please try again');
        }
    }

    public function deliveryEmail($custOrder, $ItemcustOrder){
        Mail::send(
            'shop.order.deliverEmail',
            ['custOrder'=> $custOrder,
            'listItem'=>$ItemcustOrder],
            function($message) use ($custOrder){
                $message->to($custOrder->email);
                $message->subject("Delivery Information of ReadyGrocer");
            }
        );
    }

    //email untuk confirm item dah deliver
    // public function confirmPurchase($confirmPurchase)
    // {
    //     //dd($request->all());
    //     $custOrder=DB::table('orders')
    //     ->join('customers','orders.customer_id','=','customers.id')
    //     ->join('shop_owners','orders.shop_id','=','shop_owners.id')
    //     ->where('orders.id',$confirmPurchase)
    //     ->first([
    //         'orders.id',
    //         'orders.total_payment',
    //         'orders.payment',
    //         'orders.status',
    //         'customers.name',
    //         'orders.checkoutDelivery',
    //         'customers.email',
    //         'shop_owners.shopName'
    //     ]);

    //     $this->confirmPurchaseEmail($custOrder);
        
    //     $todayDate = date('Y-m-d H:i:s');
    //     $query = DB::table('orders')
    //             ->where('id', $confirmPurchase)
    //             ->update([
    //                 'status'=> 'Delivered',
    //                 'updated_at'=> $todayDate
    //             ]);
    //     if($query){
    //         return back()->with('success','Good Job! You have successfully completed this order.');
    //     }else{
    //         return back()->with('error','Something was not right, please try again');
    //     }
    // }

    // public function confirmPurchaseEmail($custOrder){
    //     Mail::send(
    //         'shop.order.confirmPurchaseEmail',
    //         ['custOrder'=> $custOrder],
    //         function($message) use ($custOrder){
    //             $message->to($custOrder->email);
    //             $message->subject("ReadyGrocer, Thank you for choosing us!");
    //         }
    //     );
    // }
}
