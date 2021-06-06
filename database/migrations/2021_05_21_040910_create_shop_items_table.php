<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->string('item_brand');
            $table->dateTime('item_startPromo')->nullable();
            $table->dateTime('item_endPromo')->nullable();
            $table->float('item_price')->default(0);
            $table->float('offer_price')->default(0)->nullable();
            $table->float('item_discount')->default(0)->nullable();
            $table->integer('item_stock');
            $table->string('item_image');
            $table->longText('item_description')->nullable();
            $table->string('item_size');
            $table->enum('item_status',['active','inactive'])->default('active');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('shop_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); //cascade -> delete category akan delete item
            $table->foreign('shop_id')->references('id')->on('shop_owners')->onDelete('cascade'); //cascade -> delete shop akan delete item
            //kalau delete parent tanak delete child (onDelete('SET NULL'))
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_items');
    }
}
