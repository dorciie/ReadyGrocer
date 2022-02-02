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
            
      
        $shop = shopOwner::find($customer->fav_shop);
        $items = shopItem::all()->where('shop_id', $customer->fav_shop)->where('category_id', $categoryID);
        $data = [
            'LoggedCustomerInfo'=> $customer
        ];
        return view('customer.items.category',compact('shop'))->with('name',$data)->with('customer',$customer)->with('items',$items);
    }

    public function itemDetails($itemID)
    {
        if(session()->has('LoggedCustomer')){
            $customer = customer::where('id', session('LoggedCustomer'))
            ->first();}
            
        $shop = shopOwner::find($customer->fav_shop);
       
        $items = shopItem::all()
        ->where('shop_id', $customer->fav_shop)
        ->where('id', $itemID);

        $itemName = shopItem::where('id',$itemID)->where('shop_id',$customer->fav_shop)->value('item_name');
        $first = strtok($itemName, " ");

        $similar = shopItem::where('shop_id', $customer->fav_shop)
        ->where('id','!=',$itemID)->where('item_name','like','%'.$first.'%')
        ->where('item_stock','>',0)
        ->get();


        $data = [
            'LoggedCustomerInfo'=> $customer
        ];
        return view('customer.items.itemdetails',compact('shop'))->with('name',$data)->with('customer',$customer)->with('items',$items)->with('similar',$similar);
    }

    public function recommendationDetails()
    {
        if(session()->has('LoggedCustomer')){
            $customer = customer::where('id', session('LoggedCustomer'))
            ->first();}
            
        $shop = shopOwner::find($customer->fav_shop);
        
        $time = now();
        $favourites = $customer->fav_shop;
        $recommendation = DB::select("SELECT * FROM shop_items 
        WHERE shop_items.item_startPromo <= '$time' 
        AND shop_items.item_stock > 0
        AND shop_items.category_id IN 
        (SELECT category_id FROM shop_items 
         RIGHT JOIN grocery_carts ON shop_items.id = grocery_carts.item_id 
         WHERE grocery_carts.customer_id = '$customer->id' 
         AND grocery_carts.shop_id = '$favourites' 
         AND grocery_carts.order_id IS NOT NULL)"
            );
       

        $data = [
            'LoggedCustomerInfo'=> $customer
        ];
        // return view('customer.dashboard')->with('recommendation',$recommendation)->with('shop', $shop)->with('name', $data)->with('categories', $categories)->with('items', $items);

        return view('customer.items.recommendation',compact('shop'))->with('name',$data)->with('customer',$customer)->with('recommendation',$recommendation);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $customer = customer::where('id', session('LoggedCustomer'))
        ->first();
        
        $list = DB::table('grocery_lists')
        ->join('shop_items','grocery_lists.item_id','=','shop_items.id')
        ->where('customer_id', session('LoggedCustomer'))
        ->where('grocery_lists.shop_id', $customer->fav_shop)
        ->select('grocery_lists.id AS id','shop_items.id AS item_id','grocery_lists.item_quantity AS item_quantity','grocery_lists.item_frequency AS item_frequency', 'grocery_lists.shop_id AS shop_id','shop_items.item_name AS item_name','shop_items.item_brand AS item_brand','shop_items.item_price AS item_price','shop_items.item_description AS item_description','shop_items.category_id AS category_id')
        ->get();
       

        return view('customer.GroceryList.GroceryList')->with('list',$list);
    }

    public function cart()
    {
        $customer = customer::where('id', session('LoggedCustomer'))->first();
        
        
        $info = DB::table('grocery_carts')
        ->join('shop_items','grocery_carts.item_id','=','shop_items.id')
        ->where('customer_id', session('LoggedCustomer'))
        ->where('checkout','false')
        ->where('grocery_carts.shop_id',$customer->fav_shop)
        ->select('grocery_carts.id AS id','grocery_carts.item_quantity AS item_quantity', 'grocery_carts.shop_id AS shop_id','grocery_carts.total_price AS total_price','shop_items.item_brand AS item_brand','shop_items.item_price AS item_price','shop_items.offer_price AS offer_price','shop_items.item_name AS item_name','shop_items.id AS item_id','shop_items.item_startPromo AS item_startPromo','shop_items.item_endPromo AS item_endPromo')
        ->get();
        return view('customer.cart.groceryCart')->with('info',$info);
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
