<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('firstName');
            $table->string('lastName');
            $table->decimal('tcoin', 12,2);
            $table->integer('isadmin');
            $table->integer('isactive');
            $table->string('phone')->nullable()->default(NULL);
            $table->string('fb')->nullable()->default(NULL);
            $table->ipAddress('last_ip')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert([
           'email'                => "hungphanht95@gmail.com",
           'password'             => bcrypt('1'),
           'firstName'            => "Hùng",
           'lastName'             => "Phan",
           'tcoin'                => 99999999,
           'isadmin'              => 1,//1 : admin, 0 member
           'isactive'             => 1, // 1 hoạt động, 0 chưa kích hoạt
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
        Schema::dropIfExists('users');
    }
}
