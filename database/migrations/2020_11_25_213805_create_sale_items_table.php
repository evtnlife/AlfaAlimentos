<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sale_id')->unsigned();
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('kit_id')->unsigned()->nullable();
            $table->integer('quantity');
            $table->decimal('item_cost',8,2);
            $table->decimal('item_price',8,2);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('sale_id')->references('id')->on('sales');
            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('kit_id')->references('id')->on('kits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_items');
    }
}
