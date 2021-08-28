<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use App\Models\ShopItem;
use App\Models\shopOwner;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ShopItemImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function startRow(): int
    {
        return 2;
    }
    
    public function model(array $row)
    {
        $shopOwner = DB::table('shop_owners')
            ->where('id', session('LoggedShop'))
            ->first();

        return new ShopItem([
            'item_name' => $row[0],
            'item_brand' => $row[1],
            'item_price' => $row[2],
            'item_stock' => $row[3],
            'item_size' => $row[4],
            'shop_id' => $shopOwner->id 
        ]);
    }
}
