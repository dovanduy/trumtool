<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        DB::table('type_accounts')->insert([
           'name'                => "myViettel",
           'created_at'           => \Carbon\Carbon::now(),
           'updated_at'           => \Carbon\Carbon::now()
       ]);
        DB::table('type_accounts')->insert([
           'name'                => "bccsViettel",
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
        Schema::dropIfExists('type_accounts');
    }
}
