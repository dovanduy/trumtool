<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('token')->nullable()->default(NULL);
            $table->integer('type_account_id');
            $table->integer('user_id');
            $table->boolean('status'); //1: ok, 2: error
            $table->string('note')->nullable()->default(NULL);
            $table->timestamps();
        });
        DB::table('accounts')->insert([
            'username'             => "1002241100_00018_DBCN",
            'password'             => "nghean@123",
            'type_account_id'      => 2,
            'user_id'              => 1,
            'status'               => true,
            'created_at'           => \Carbon\Carbon::now(),
            'updated_at'           => \Carbon\Carbon::now()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
