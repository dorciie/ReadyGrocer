<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\shopOwner;
use App\Models\Category; 
use App\Models\ShopItem; 
use App\Models\GroceryCart; 

date_default_timezone_set("Asia/Kuala_Lumpur");
class CategoryController extends Controller
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
        // $categories = DB::table('categories')->get();
        $categories=Category::orderBy('id','DESC')
        ->where('shop_id',$shopOwner->id)
        ->get();
        // $categories->Category::orderBy('id','DESC')->get();
        return view('shop.category.index',$data, compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(session()->has('LoggedShop')){
            $shopOwner = DB::table('shop_owners')
            ->where('id', session('LoggedShop'))
            ->first();

            $data = [
                'LoggedShopInfo'=> $shopOwner
            ];
        }
        return view('shop.category.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'category_name'=>'required|string|unique:categories,category_name,NULL,id,shop_id,'.session('LoggedShop')
        ]);
        $shopOwner = DB::table('shop_owners')
            ->where('id', session('LoggedShop'))
            ->first();
        $todayDate = date('Y-m-d H:i:s');
        $query = DB::table('categories')
                ->insert([
                    'category_name'=> $request->category_name,
                    'created_at'=> $todayDate,
                    'updated_at'=> $todayDate,
                    'shop_id'=>$shopOwner->id
                ]);

        if($query){
            return redirect()->route('category.index')->with('success','Successfully add new category');
        }else{
            return back()->with('error','Something went wrong');
        }
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
        if(session()->has('LoggedShop')){
            $shopOwner = DB::table('shop_owners')
            ->where('id', session('LoggedShop'))
            ->first();

            $data = [
                'LoggedShopInfo'=> $shopOwner
            ];
        }
        // $category = DB::table('categories')
        //     ->where('id', $id)
        //     ->first();
        $category=Category::find($id);
        if($category){
            return view('shop.category.edit',$data,compact('category'));
        }else{
            return back()->with('error','Data not found');
        }
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
        $category=Category::find($id);
        if($category){
            $this->validate($request,[
                'category_name'=>'required|string|unique:categories,category_name,NULL,id,shop_id,'.session('LoggedShop')
            ]);
            $todayDate = date('Y-m-d H:i:s');
            $query = DB::table('categories')
                    ->where('id', $id)
                    ->update([
                        'category_name'=> $request->category_name,
                        'updated_at'=> $todayDate
                    ]);
    
            if($query){
                return redirect()->route('category.index')->with('success','Successfully updated category');
            }else{
                return back()->with('error','Something went wrong');
            }
        }else{
            return back()->with('error','Data not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        $ItemID = DB::table('shop_items')
                ->join('grocery_carts', 'grocery_carts.item_id','=','shop_items.id')
                ->join('categories', 'shop_items.category_id','=','categories.id')
                ->where('categories.id', $id)
                ->first();
        
        if($category){
            if($ItemID){
                return back()->with('error','This category cannot be deleted to keep track the order history');
            }else{
                // return back()->with('success','DELETED');
                $status = $category->delete();
                if($status){
                    return redirect()->route('category.index')->with('success','Successfully delete the category');
                }
                else{
                    return back()->with('error','Something went wrong');
                }
            }
        }else{
            return back()->with('error','Data not found');
        }
    }
}
