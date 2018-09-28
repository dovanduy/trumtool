<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('networks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        DB::table('networks')->insert([
           'name'                => "Viettel",
           'created_at'           => \Carbon\Carbon::now(),
           'updated_at'           => \Carbon\Carbon::now()
       ]);
         DB::table('networks')->insert([
           'name'                => "Mobi",
           'created_at'           => \Carbon\Carbon::now(),
           'updated_at'           => \Carbon\Carbon::now()
       ]);
          DB::table('networks')->insert([
           'name'                => "Vina",
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
        Schema::dropIfExists('networks');
    }
}
