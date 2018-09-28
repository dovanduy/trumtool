<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckbillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkbills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone_number');
            $table->integer('contract_id')->nullable()->default(NULL);
            $table->string('customerName')->nullable()->default(NULL);
            $table->decimal('amount_of_debt', 10 ,2);
            $table->string('payMethodName')->nullable()->default(NULL);
            $table->integer('network_id');
            $table->integer('user_id');
            $table->boolean('status');
            $table->string('note')->nullable()->default(NULL);
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
        Schema::dropIfExists('checkbills');
    }
}
