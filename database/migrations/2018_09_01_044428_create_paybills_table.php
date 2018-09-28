<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaybillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paybills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone_number');
            $table->string('codeCard');
            $table->integer('cardValue'); // mệnh giá
            $table->integer('network_id');
            $table->integer('user_id'); //1 thành công -1 lỗi
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
        Schema::dropIfExists('paybills');
    }
}
