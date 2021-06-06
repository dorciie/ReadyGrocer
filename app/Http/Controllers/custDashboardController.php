<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;
use App\Models\shopOwner;
use App\Models\shopItem;
use App\Models\GroceryList;
use App\Models\Category;
use App\Models\GroceryCart;
use Illuminate\Support\Facades\DB;

class custDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->has('LoggedCustomer')){
        $customer = customer::where('id', session('LoggedCustomer'))
        ->first();}
        
        $shops = shopOwner::all()->toArray();

        return view('customer.shop.tables',compact('shops'))->with('custID',$customer);
    }


    public function listOfCategory($categoryID)
    {
        if(session()->has('LoggedCustomer')){
            $customer = customer::where('id', session('LoggedCustomer'))
            ->first();}
            
      
        $shop = shopOwner::get()->where('id', $customer->fav_shop);
        $items = shopItem::all()->where('shop_id', $customer->fav_shop)->where('category_id', $categoryID);
        $data = [
            'LoggedCustomerInfo'=> $customer
        ];
        return view('customer.items.category')->with('name',$data)->with('customer',$customer)->with('items',$items)->with('shop',$shop);
    }

    public function itemDetails($itemID)
    {
        if(session()->has('LoggedCustomer')){
            $customer = customer::where('id', session('LoggedCustomer'))
            ->first();}
            
        
      
        $shop = DB::table('shop_owners')
        ->get()
        ->where('id', $customer->fav_shop);

        $items = shopItem::all()
        ->where('shop_id', $customer->fav_shop)
        ->where('id', $itemID);

        $data = [
            'LoggedCustomerInfo'=> $customer
        ];
        return view('customer.items.itemdetails')->with('name',$data)->with('customer',$customer)->with('shop',$shop)->with('shop',$shop)->with('items',$items);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
      
        
        $list = GroceryList::all()->where('customer_id', session('LoggedCustomer'));

        return view('customer.GroceryList.GroceryList')->with('list',$list);
    }

    public function cart()
    {
      
        $cart = GroceryCart::all()->where('customer_id', session('LoggedCustomer'));
        $info = DB::table('shop_items')
        ->join('grocery_carts','shop_items.id','=','grocery_carts.item_id')->get();
        return view('customer.cart.groceryCart')->with('cart',$cart)->with('info',$info);
    }

    public function checkout()
    {
        $checkout = GroceryCart::where('customer_id',session('LoggedCustomer'))->delete();
        return view('customer.cart.checkout')->with('success','Cart successfully check out');
    }

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
