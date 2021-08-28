<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ShopItem;
use Illuminate\Support\Facades\DB;
date_default_timezone_set("Asia/Kuala_Lumpur");
class DeletePromotion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Promotion:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete promotion after end promotion';

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
        \Log::info("Cron is working fine!");
        $items = ShopItem::all();
        $todayDate = date('Y-m-d');
        foreach($items as $item){
            $item_endPromo = $item->item_endPromo;
            if($todayDate > $item_endPromo){
                $query = DB::table('shop_items')
                    // ->whereNotNull('item_discount')
                    // ->whereNotNull('item_endPromo')
                    // ->whereNotNull('item_startPromo')
                    ->where('id',$item->id)
                    ->update([
                        'item_startPromo'=> NULL, //
                        'item_endPromo'=> NULL, //
                        'offer_price'=> "0.00", //
                        'item_discount'=> "0.00", //
                    ]);
            }
        }
    }
}
