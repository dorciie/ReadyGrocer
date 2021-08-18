<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->char('payment');
            $table->timestamp('checkoutDelivery')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('shop_id');
            $table->foreign('shop_id')->references('id')->on('shop_owners')->onDelete('cascade'); //cascade -> delete shop akan delete item
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade'); //cascade -> delete shop akan delete item
            $table->float('total_payment')->default(0);
            $table->timestamps();
            $table->enum('status', ['preparing', 'delivering', 'delivered'])->default('preparing');

    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
