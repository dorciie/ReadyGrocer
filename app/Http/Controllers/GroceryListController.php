<?php

namespace App\Http\Controllers;

use App\Models\GroceryList;
use App\Models\customer;
use App\Models\ShopItem;
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
            $customer = customer::where('id', session('LoggedCustomer'))
            ->first();}

        if (GroceryList::where('item_id', $itemID)->where('customer_id', $customer->id)->exists()) {
            
              return back()->with('error','already exits in your groceryList');
    }
       $newList = new GroceryList;
            $newList->customer_id=$customer->id;
            $newList->shop_id=$customer->fav_shop;
            $newList->item_id= $itemID;
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
        $this->validate($request,[
            'item_frequency'=>'required',
            'item_quantity'=>'required',
        ]);
        $update = GroceryList::where('customer_id',session('LoggedCustomer'))
        ->where('item_id',$id)
        ->update([
            'item_quantity' => $request->item_quantity,
            'item_frequency' => $request->item_frequency
            ]);
            
            if($update){
                        return back()->with('success','List has been updated!');

            }
            return back()->with('error','List cannot be updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedRows = GroceryList::where('id', $id)->delete();
        return back()->with('success','successful');
    }
}
