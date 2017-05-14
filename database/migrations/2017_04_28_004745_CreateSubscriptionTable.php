<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user');
            $table->integer('plan_id')->unsigned();
            $table->foreign('plan_id')->references('id')->on('plan');
            $table->integer('renew_plan_id')->unsigned()->nullable();
            $table->foreign('renew_plan_id')->references('id')->on('plan');
            $table->double('price')->nullable()->default(NULL);
            $table->date('starts_at');
            $table->date('ends_at');
            $table->enum('status', array('active', 'expired', 'cancelled'));
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
        Schema::dropIfExists('subscriptions');
    }
}