<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_payments', function (Blueprint $table) {
            $table->increments('player_payment_id');
            $table->string('customer_id', 50)->nullable();
            $table->string('charge_id', 50)->nullable();
            $table->float('charge_amount', 5, 2)->nullable()->default(null);
            $table->string('charge_status', 20)->nullable();
            $table->string('plan_id', 50)->nullable();
            $table->string('plan_interval', 20)->nullable();
            $table->float('plan_amount', 5, 2)->nullable()->default(null);
            $table->string('subscription_id', 50)->nullable();
            $table->string('subscription_status', 20)->nullable();
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
        Schema::dropIfExists('player_payments');
    }
}
