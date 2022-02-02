<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\GroceryCart;
use App\Models\GroceryList;
use App\Models\ShopItem;
use Illuminate\Console\Command;
use DateTime;

class updateCart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cart:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'System update cart automatically according to list';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $allList = GroceryList::all(); //get only item which do not exists in customer's grocery cart
        $dtnow = \Carbon\Carbon::now();
        $shopitems = ShopItem::all();
        
        foreach($allList as $list){
            \Log::info("Test 1");
            if($list->last_bought!=NULL){
                if(($list->item_frequency)==='Daily'&& (((new DateTime($list->last_bought))->diff($dtnow))->format('%a')>1) &&($list->item_quantity)>=(ShopItem::where('id',$list->item)->value('item_stock'))) {
                     if((GroceryCart::where('customer_id',$list->customer_id)->where('item_id',$list->item_id)->where('checkout','false')->get())->isEmpty()){
                        $newCart = new GroceryCart;
                        $newCart->customer_id=$list->customer_id;
                        $newCart->shop_id=Customer::where('id',$list->customer_id)->value('fav_shop');
                        $newCart->item_id=$list->item_id;
                        $newCart->item_quantity=$list->item_quantity;

                         $item = ShopItem::where('id',$list->item_id)->first();                 
                            
                    if ($item->item_startPromo!=NULL && $dtnow >= $item->item_startPromo){       
                        $newCart->total_price=($item->offer_price)*($list->item_quantity);           
                    }else{
                        $newCart->total_price=($item->item_price)*($list->item_quantity);
                    }
                    $newCart->save();

                    }
                }elseif(($list->item_frequency)==='Weekly' && (((new DateTime($list->last_bought))->diff($dtnow))->format('%a')>7)) {

                    if((GroceryCart::where('customer_id',$list->customer_id)->where('item_id',$list->item_id)->where('checkout','false')->get())->isEmpty()){
                        $newCart = new GroceryCart;
                        $newCart->customer_id=$list->customer_id;
                        $newCart->shop_id=Customer::where('id',$list->customer_id)->value('fav_shop');
                        $newCart->item_id=$list->item_id;
                        $newCart->item_quantity=$list->item_quantity;

                         $item = ShopItem::where('id',$list->item_id)->first();                  
                            
                    if ($item->item_startPromo!=NULL && $dtnow >= $item->item_startPromo){       
                        $newCart->total_price=($item->offer_price)*($list->item_quantity);           
                    }else{
                        $newCart->total_price=($item->item_price)*($list->item_quantity);
                    }
                    $newCart->save();

                    }
                    
                }elseif(($list->item_frequency)==='Fortnight' && (((new DateTime($list->last_bought))->diff($dtnow))->format('%a')>14)) {

                    if((GroceryCart::where('customer_id',$list->customer_id)->where('item_id',$list->item_id)->where('checkout','false')->get())->isEmpty()){
                        $newCart = new GroceryCart;
                        $newCart->customer_id=$list->customer_id;
                        $newCart->shop_id=Customer::where('id',$list->customer_id)->value('fav_shop');
                        $newCart->item_id=$list->item_id;
                        $newCart->item_quantity=$list->item_quantity;

                         $item = ShopItem::where('id',$list->item_id)->first();                  
                            
                    if ($item->item_startPromo!=NULL && $dtnow >= $item->item_startPromo){       
                        $newCart->total_price=($item->offer_price)*($list->item_quantity);           
                    }else{
                        $newCart->total_price=($item->item_price)*($list->item_quantity);
                    }
                    $newCart->save();

                    }

                }elseif(($list->item_frequency)==='Monthly' && (((new DateTime($list->last_bought))->diff($dtnow))->format('%m')>1)) { //need to change format from date time to days only
                //either count %d months>1 or days>30
                    if((GroceryCart::where('customer_id',$list->customer_id)->where('item_id',$list->item_id)->where('checkout','false')->get())->isEmpty()){
                        $newCart = new GroceryCart;
                        $newCart->customer_id=$list->customer_id;
                        $newCart->shop_id=Customer::where('id',$list->customer_id)->value('fav_shop');
                        $newCart->item_id=$list->item_id;
                        $newCart->item_quantity=$list->item_quantity;

                         $item = ShopItem::where('id',$list->item_id)->first();                  //item_promo cannot be null
                            
                    if ($item->item_startPromo!=NULL && $dtnow >= $item->item_startPromo){       //check if date today is between item_startPromo & item_endPromo
                        $newCart->total_price=($item->offer_price)*($list->item_quantity);            //check
                    }else{
                        $newCart->total_price=($item->item_price)*($list->item_quantity);
                    }
                    $newCart->save();

                    }
                     

                }
            }
        }
    }
    
}
