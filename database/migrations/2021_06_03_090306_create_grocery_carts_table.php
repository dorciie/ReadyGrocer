<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroceryCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grocery_carts', function (Blueprint $table) {
            $table->id();
            $table->integer('item_quantity');
            $table->float('total_price')->default(0);

            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('shop_id')->references('id')->on('shop_owners')->onDelete('cascade'); //cascade -> delete shop akan delete item
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade'); //cascade -> delete shop akan delete item

            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('order_id');
            $table->foreign('item_id')->references('id')->on('shop_items')->onDelete('cascade'); //cascade -> delete shop akan delete item
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade'); //cascade -> delete shop akan delete item

            $table->enum('checkout', ['true', 'false'])->default('false');

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
        Schema::dropIfExists('grocery_carts');
    }
}
