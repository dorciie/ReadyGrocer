<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroceryListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grocery_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('item_quantity');
            $table->char('item_frequency');
            $table->foreign('shop_id')->references('id')->on('shop_owners')->onDelete('cascade'); //cascade -> delete shop akan delete item
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); //cascade -> delete shop akan delete item
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade'); //cascade -> delete shop akan delete item
            $table->foreign('item_id')->references('id')->on('shop_items')->onDelete('cascade'); //cascade -> delete shop akan delete item

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
        Schema::dropIfExists('grocery_lists');
    }
}
