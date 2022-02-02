<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\GroceryCart;
use App\Models\ShopOwner;
use App\Models\customer;
use Illuminate\Http\Request;

class CustOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = order::where('customer_id', session('LoggedCustomer'))->get();
        $pendingOrder = order::where('customer_id', session('LoggedCustomer'))->where('status','Delivering')->get();
        $completeOrder = order::where('customer_id', session('LoggedCustomer'))->where('status','Delivered')->get();

        return view('customer.order.orders')->with('order',$order)->with('pendingOrder',$pendingOrder)->with('completeOrder',$completeOrder);
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
        $cart = GroceryCart::where('order_id',$id)->get();
        $order = Order::find($id);
        return view('customer.order.orderDetails',compact('cart','order'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $update = Order::where('id',$id)
        ->update([
            'status' => 'Delivered'
                 ]);
        
                 return back();
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
        $shop = ShopOwner::where('id',Order::where('id',$id)->value('shop_id'))->first();
        $count = Order::where('shop_id',$shop->id)->whereNotNull('rate')->count();

        $update = Order::where('id',$id)
        ->update([
            'rate' => $request->rating,
            'comment' => $request->comment
            ]);

        
        
        $updateshop = ShopOwner::where('id',$shop->id)
        ->update([
            'rating'=> (($shop->rating)*($count)+($request->rating))/($count+1)
        ]);
            
            if($update){
                        return back()->with('success','Thank you for your feedback!');

            }
            return back()->with('error','Rating error');
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

    function pdf($orderID)
    {
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_customer_data_to_html($orderID));
     return $pdf->stream();
    }

    function convert_customer_data_to_html($orderID)
    {
     $customer_data = customer::all()->where('id',session('LoggedCustomer'))->first();
     $order = Order::find($orderID);
     $cart = GroceryCart::where('order_id',$orderID)->get();
     $iterate = 1;

     $output = '
     <h3 align="center">Order Reciept</h3>
     <p>Order at : '.$order->created_at.'</p>
     <p>Payment  : '.$order->payment.'</p>
     <p>Status   : '.$order->status.'</p>
     <p>Shop     : '.shopOwner::where('id',$order->shop_id)->value('shopName').'</p>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
        <tr>
            <th style="border: 1px solid; padding:12px;" width="20%">#</th>
            <th style="border: 1px solid; padding:12px;" width="30%">Item Name</th>
            <th style="border: 1px solid; padding:12px;" width="15%">Item Quantity</th>
            <th style="border: 1px solid; padding:12px;" width="15%">Total Price</th>
        </tr>
        <tbody> ';  
     foreach($cart as $cart)
     {
      $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$iterate.'</td>
       <td style="border: 1px solid; padding:12px;">aaa</td>
       <td style="border: 1px solid; padding:12px;">'.$cart->item_quantity.'</td>
       <td style="border: 1px solid; padding:12px;">'.$cart->total_price.'</td>
      </tr>
      
      ';
      $iterate++;
     };
    
     
     $output .= '
     <tr>
     <td style="border: 1px solid; padding:12px;"></td>
     <td style="border: 1px solid; padding:12px;"></td>
     <td style="border: 1px solid; padding:12px;">Total Payment (including 6% GST) : </td>
     <td style="border: 1px solid; padding:12px;">'.$order->total_payment.'</td>
    </tr>
     
     </table>';
    
     return $output;
    }
}
