<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckserisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkseris', function (Blueprint $table) {
            $table->increments('id');
            $table->string('seriNumber'); // số seri
            $table->integer('cardValue'); // mệnh giá
            $table->string('dateUsed')->nullable()->default(NULL); // ngày sử dụng nếu đã sử dụng
            $table->string('isdn')->nullable()->default(NULL); // thuê bao sử dụng nếu đã sử dụng
            $table->string('cardExpired'); // ngày hết hạn 
            $table->string('ownerName')->nullable()->default(NULL); //đơn vị phát hành
            $table->integer('network_id'); // nhà mạng
            $table->integer('user_id'); // id user check
            $table->boolean('status'); // -1: đã sử dụng;  0 chưa sử dụng; 1 chưa sử dụng
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
        Schema::dropIfExists('checkseris');
    }
}
