<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('total',8,2);
            $table->decimal('cost', 8,2);
            $table->decimal('discount',8,2)->default(0);
            //PaymentType
            // AV - A vista
            // CC - Cart�o de Cr�dito
            // PA - Parcelado
            // EP - Entrada + Parcelado
            $table->enum('payment_type', ['AV', 'CC', 'PA', 'EP']);
            $table->integer('qtd_parcels')->unsigned();
            $table->integer('payment_day')->unsigned();
            $table->timestamp('inicial_date');
            $table->integer('user_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('branch_id')->unsigned();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('branch_id')->references('id')->on('branch');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
