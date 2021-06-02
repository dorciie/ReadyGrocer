<?php

namespace App\Http\Controllers;

use App\Models\GroceryList;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
class GroceryListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$itemID)
    {
        $this->validate($request,[
            'item_frequency'=>'required',
            'item_quantity'=>'required',
        ]);

        if(session()->has('LoggedCustomer')){
            $customer = DB::table('customers')
            ->where('id', session('LoggedCustomer'))
            ->first();}

        $item = DB::table('shop_items')
        ->where('id', $itemID)
        ->first();

        $newList = new GroceryList;
            $newList->customer_id=$customer->id;
            $newList->category_id=$item->category_id;
            $newList->shop_id=$customer->fav_shop;
            $newList->item_id=$itemID;
            $newList->item_quantity=$request->input('item_quantity');
            $newList->item_frequency=$request->input('item_frequency');

            $newList->save();
        return back()->with('success','successful');
    }

    public function addList($itemID)
    {
        
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
