<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table){
            $table->increments('id');
            $table->integer('subscription_id')->unsigned();
            $table->foreign('subscription_id')->references('subscription')->on('id');
            $table->double('price', 5, 2);
            $table->date('date');
            $table->boolean('ignore_taxes');
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
        Schema::dropIfExists('invoices');
    }
}
