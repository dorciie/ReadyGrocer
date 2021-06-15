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
        $item = ShopItem::where('id',$itemID)->first();
        $qty=$item->item_stock;
        $this->validate($request,[
            'item_quantity'=>'required|numeric|max:'.$qty,
        ]);

        if(session()->has('LoggedCustomer')){
            $customer = customer::where('id', session('LoggedCustomer'))
            ->first();}
        

        if (GroceryCart::where('item_id', $item->id)->where('customer_id', $customer->id)->exists()) {
            
              return back()->with('error','already exits in your Grocery Cart');
    }
       $newCart = new GroceryCart;
            $newCart->customer_id=$customer->id;
            $newCart->shop_id=$customer->fav_shop;
            $newCart->item_id=$itemID;
            $newCart->total_price=($item->offer_price)*($request->item_quantity);
            $newCart->item_quantity=$request->input('item_quantity');

            $newCart->save();
         return back()->with('success','successful');

        

    }

    public function cart2($itemID)
    {
        // $item = ShopItem::where('id',$itemID)->first();
        // $qty=$item->item_stock;
        // $this->validate($request,[
        //     'item_quantity'=>'required|numeric|max:'.$qty,
        // ]);

        if(session()->has('LoggedCustomer')){
            $customer = customer::where('id', session('LoggedCustomer'))
            ->first();}

        $item = ShopItem::where('id', $itemID)
        ->first();
        $qty=$item->item_stock;
        $list = GroceryList::where('item_id', $itemID)
        ->first();
        
        if(($list->item_quantity)>$qty){
            return back()->with('error','Item quantity is over item stock');
        }
        if (GroceryCart::where('item_id', $item->id)->where('customer_id', $customer->id)->exists()) {
            
              return back()->with('error','already exits in your Grocery Cart');
    }
       $newCart = new GroceryCart;
            $newCart->customer_id=$customer->id;
            $newCart->shop_id=$customer->fav_shop;
            $newCart->item_id=$itemID;
            $newCart->total_price=($item->offer_price)*($list->item_quantity);
            $newCart->item_quantity=$list->item_quantity;

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

        $request->validate([
            'item_quantity' => 'max:'.$item->item_stock
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

        $createOrder = new Order;
        $createOrder->payment =$request->payment;
        $createOrder->customer_id=$customer->id;
        $createOrder->shop_id=$customer->fav_shop;
        $createOrder->total_price = $request->totalPrice;
        $createOrder->status = 'pending delivery';
        if($request->delivery ==='deliveryLater'){
            $createOrder->checkOutDelivery = $request->deliveryDT;
            
        }else{
            $createOrder->checkOutDelivery = now(); 
        }
        
        $createOrder->save();

         $update = GroceryCart::where('customer_id',session('LoggedCustomer'))
        ->update([
            'checkout' => 'true',
            'payment' => $request->payment,
            'order_id'=> $createOrder->id,
            ]);
            
            if($update){
                        return view('customer.cart.checkout')->with('success','Cart has been checkout');
            }
            return back()->with('error','Cart cannot be check out');;
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
