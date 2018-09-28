<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('price', 10 ,2);
            $table->timestamps();
        });
        DB::table('price_packages')->insert([
           'name'                => "CheckSeriViettel",
           'price'                => 50,
           'created_at'           => \Carbon\Carbon::now(),
           'updated_at'           => \Carbon\Carbon::now()
       ]);
        DB::table('price_packages')->insert([
           'name'                => "CheckBillViettel",
           'price'                => 50,
           'created_at'           => \Carbon\Carbon::now(),
           'updated_at'           => \Carbon\Carbon::now()
       ]);
        DB::table('price_packages')->insert([
           'name'                => "PayBillViettel",
           'price'                => 50,
           'created_at'           => \Carbon\Carbon::now(),
           'updated_at'           => \Carbon\Carbon::now()
       ]);
        DB::table('price_packages')->insert([
           'name'                => "CheckSeriMobi",
           'price'                => 50,
           'created_at'           => \Carbon\Carbon::now(),
           'updated_at'           => \Carbon\Carbon::now()
       ]);
        DB::table('price_packages')->insert([
           'name'                => "CheckBillMobi",
           'price'                => 50,
           'created_at'           => \Carbon\Carbon::now(),
           'updated_at'           => \Carbon\Carbon::now()
       ]);
        DB::table('price_packages')->insert([
           'name'                => "PayBillMobi",
           'price'                => 50,
           'created_at'           => \Carbon\Carbon::now(),
           'updated_at'           => \Carbon\Carbon::now()
       ]);
        DB::table('price_packages')->insert([
           'name'                => "CheckSeriVina",
           'price'                => 50,
           'created_at'           => \Carbon\Carbon::now(),
           'updated_at'           => \Carbon\Carbon::now()
       ]);
        DB::table('price_packages')->insert([
           'name'                => "CheckBillVina",
           'price'                => 50,
           'created_at'           => \Carbon\Carbon::now(),
           'updated_at'           => \Carbon\Carbon::now()
       ]);
        DB::table('price_packages')->insert([
           'name'                => "PayBillVina",
           'price'                => 50,
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
        Schema::dropIfExists('price_packages');
    }
}
