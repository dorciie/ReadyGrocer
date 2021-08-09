<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//untuk password nanti
use Illuminate\Support\Facades\DB;
use App\Models\shopOwner;
use App\Models\ShopItem;

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

        return view('shop.index', $data, compact('lowStock','noStock'));
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
