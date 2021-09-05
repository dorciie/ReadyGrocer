<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\shopOwner;
use App\Models\ShopItem;
use App\Models\Order;
use App\Models\GroceryCart;
use App\Models\Category; 

date_default_timezone_set("Asia/Kuala_Lumpur");
class shopOwnerController extends Controller
{
    function shopDashboard(){
        if(session()->has('LoggedShop')){
            $shopOwner = DB::table('shop_owners')
            ->where('id', session('LoggedShop'))
            ->first();

            $data = [
                'LoggedShopInfo'=> $shopOwner
            ];
        }
        
        //view stock of item
        $lowStock=DB::table('shop_items')
                ->join('categories','shop_items.category_id','=','categories.id')
                ->where('shop_items.shop_id',$shopOwner->id)
                ->where('item_stock','<=','10')
                ->where('item_stock','>','0')
                ->get();

        $noStock=DB::table('shop_items')
                ->join('categories','shop_items.category_id','=','categories.id')
                ->where('shop_items.shop_id',$shopOwner->id)
                ->where('item_stock','==','0')
                ->get();

        //view bar graph (table order)
        $payment = Order::select(DB::raw("(sum(total_payment)) as payment"))
                   ->whereYear('created_at', date('Y'))
                   ->where('shop_id',$shopOwner->id)
                   ->where('status','delivered')
                   ->groupBy(DB::raw("MONTH(created_at)"))
                   ->pluck('payment');

        $months = Order::select(DB::raw("MONTH(created_at) as month"))
                 ->whereYear('created_at', date('Y'))
                 ->where('shop_id',$shopOwner->id)
                 ->where('status','delivered')
                 ->groupBy(DB::raw("MONTH(created_at)"))
                 ->pluck('month');

        $totalSales = Order::select(DB::raw("(sum(total_payment)) as payment"))
                 ->whereYear('created_at', date('Y'))
                 ->where('shop_id',$shopOwner->id)
                 ->where('status','delivered')
                 ->first();
        
        $year = Order::select(DB::raw("YEAR(created_at) as year"))->distinct()
              ->whereYear('created_at','!=', date('Y'))
              ->where('shop_id',$shopOwner->id)
              ->where('status','delivered')
              ->get();

        if(empty(DB::table('orders')->where('orders.status','delivered')->whereYear('created_at', date('Y'))->count())){
            $Oneyear = shopOwner::select(DB::raw("YEAR(created_at) as years"))->distinct()
                    ->whereYear('created_at', date('Y'))
                    ->first();
        }else{
            $Oneyear = Order::select(DB::raw("YEAR(created_at) as years"))->distinct()
                    ->whereYear('created_at', date('Y'))
                    ->where('shop_id',$shopOwner->id)
                    ->where('status','delivered')
                    ->first();
        }

        $datas = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $datas[$month-1] = $payment[$index];
        }

        //view pie graph (table grocery cart)
        $totalItemSold = GroceryCart::select(DB::raw("(sum(item_quantity)) as totalItem"))
                 ->join('orders','grocery_carts.order_id','=','orders.id')
                 ->whereYear('orders.created_at', date('Y'))
                 ->where('grocery_carts.shop_id',$shopOwner->id)
                 ->where('grocery_carts.checkout','true')
                 ->where('orders.status','delivered')
                 ->first();

        $record = GroceryCart::select('categories.category_name',DB::raw("(sum(grocery_carts.item_quantity)) as totalItems"))
                 ->join('shop_items','grocery_carts.item_id','=','shop_items.id')
                 ->join('categories','shop_items.category_id','=','categories.id')
                 ->join('orders','grocery_carts.order_id','=','orders.id')
                 ->groupBy('categories.category_name')
                 ->whereYear('grocery_carts.created_at', date('Y'))
                 ->where('grocery_carts.checkout','true')
                 ->where('grocery_carts.shop_id',$shopOwner->id)
                 ->where('orders.status','delivered')
                 ->get();

        $dataPoints = [];
 
        foreach($record as $row) {
            $dataPoints['label'][] = $row->category_name;
            $dataPoints['data'][] = (int) $row->totalItems;
        }

        $itemSold = GroceryCart::select('categories.category_name',DB::raw("(sum(grocery_carts.item_quantity)) as totalItems"),'shop_items.id')
                ->join('shop_items','grocery_carts.item_id','=','shop_items.id')
                ->join('categories','shop_items.category_id','=','categories.id')
                ->join('orders','grocery_carts.order_id','=','orders.id')
                ->groupBy('shop_items.id','categories.category_name')
                ->whereYear('grocery_carts.created_at', date('Y'))
                ->where('grocery_carts.checkout','true')
                ->where('grocery_carts.shop_id',$shopOwner->id)
                ->where('orders.status','delivered')
                ->orderBy('categories.category_name')
                ->get();

        return view('shop.index', $data, compact('lowStock','noStock', 'datas','totalSales', 'year', 'Oneyear', 'totalItemSold','dataPoints','itemSold'));

    }

    public function updateYear(Request $request){
        if(session()->has('LoggedShop')){
            $shopOwner = DB::table('shop_owners')
            ->where('id', session('LoggedShop'))
            ->first();

            $data = [
                'LoggedShopInfo'=> $shopOwner
            ];
        }

        //view stock of item
        $lowStock=DB::table('shop_items')
                ->join('categories','shop_items.category_id','=','categories.id')
                ->where('shop_items.shop_id',$shopOwner->id)
                ->where('item_stock','<=','10')
                ->where('item_stock','>','0')
                ->get();

        $noStock=DB::table('shop_items')
                ->join('categories','shop_items.category_id','=','categories.id')
                ->where('shop_items.shop_id',$shopOwner->id)
                ->where('item_stock','==','0')
                ->get();

        //view bar graph (table order)
        $payment = Order::select(DB::raw("(sum(total_payment)) as payment"))
                ->whereYear('created_at', $request->year)
                ->where('shop_id',$shopOwner->id)
                ->where('status','delivered')
                ->groupBy(DB::raw("MONTH(created_at)"))
                ->pluck('payment');

        $months = Order::select(DB::raw("MONTH(created_at) as month"))
                ->whereYear('created_at', $request->year)
                ->where('shop_id',$shopOwner->id)
                ->where('status','delivered')
                ->groupBy(DB::raw("MONTH(created_at)"))
                ->pluck('month');

        $totalSales = Order::select(DB::raw("(sum(total_payment)) as payment"))
                    ->whereYear('created_at', $request->year)
                    ->where('shop_id',$shopOwner->id)
                    ->where('status','delivered')
                    ->first();

        $year = Order::select(DB::raw("YEAR(created_at) as year"))->distinct()
                ->whereYear('created_at','!=', $request->year)
                ->where('shop_id',$shopOwner->id)
                ->where('status','delivered')
                ->get();

        if(empty(DB::table('orders')->where('orders.status','delivered')->whereYear('created_at', $request->year)->count())){
            $Oneyear = shopOwner::select(DB::raw("YEAR(created_at) as years"))->distinct()
                    ->whereYear('created_at', $request->year)
                    ->first();
        }else{
            $Oneyear = Order::select(DB::raw("YEAR(created_at) as years"))->distinct()
                    ->whereYear('created_at', $request->year)
                    ->where('shop_id',$shopOwner->id)
                    ->where('status','delivered')
                    ->first();
            }

        $datas = array(0,0,0,0,0,0,0,0,0,0,0,0);
            foreach($months as $index => $month){
            $datas[$month-1] = $payment[$index];
        }

        //sales for items
        $totalItemSold = GroceryCart::select(DB::raw("(sum(item_quantity)) as totalItem"))
                 ->join('orders','grocery_carts.order_id','=','orders.id')
                 ->whereYear('orders.created_at', $request->year)
                 ->where('grocery_carts.shop_id',$shopOwner->id)
                 ->where('grocery_carts.checkout','true')
                 ->where('orders.status','delivered')
                 ->first();

        $record = GroceryCart::select('category_name',DB::raw("(sum(item_quantity)) as totalItems"))
                 ->join('shop_items','grocery_carts.item_id','=','shop_items.id')
                 ->join('categories','shop_items.category_id','=','categories.id')
                 ->join('orders','grocery_carts.order_id','=','orders.id')
                 ->groupBy('categories.category_name')
                 ->whereYear('grocery_carts.created_at', $request->year)
                 ->where('grocery_carts.checkout','true')
                 ->where('grocery_carts.shop_id',$shopOwner->id)
                 ->where('orders.status','delivered')
                 ->get();

        $dataPoints = [];

        foreach($record as $row) {
        $dataPoints['label'][] = $row->category_name;
        $dataPoints['data'][] = (int) $row->totalItems;
        }

        $itemSold = GroceryCart::select('categories.category_name',DB::raw("(sum(grocery_carts.item_quantity)) as totalItems"),'shop_items.id')
                ->join('shop_items','grocery_carts.item_id','=','shop_items.id')
                ->join('categories','shop_items.category_id','=','categories.id')
                ->join('orders','grocery_carts.order_id','=','orders.id')
                ->groupBy('shop_items.id','categories.category_name')
                ->whereYear('grocery_carts.created_at', $request->year)
                ->where('grocery_carts.checkout','true')
                ->where('grocery_carts.shop_id',$shopOwner->id)
                ->where('orders.status','delivered')
                ->orderBy('categories.category_name')
                ->get();

        return view('shop.index', $data, compact('lowStock','noStock', 'datas','totalSales', 'year', 'Oneyear', 'totalItemSold','dataPoints','itemSold'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
