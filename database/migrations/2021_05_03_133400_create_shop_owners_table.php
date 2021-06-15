<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_owners', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->char('email'); 
            $table->char('shopName'); 
            $table->char('address'); 
            $table->string('password');
            $table->decimal('rating',5,2)->nullable();
            $table->double('address_latitude')->nullable();
            $table->double('address_longitude')->nullable();
            $table->longText('shop_description')->nullable(); //
            $table->float('delivery_charge')->nullable(); //
            $table->string('phone_number')->nullable(); //
            $table->string('shop_image')->nullable(); //
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
        Schema::dropIfExists('shop_owners');
    }
}
