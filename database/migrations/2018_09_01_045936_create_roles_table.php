<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('title');
            $table->timestamps();
        });
        $data = [
            // check seri
            [
             'name' => 'checkseriviettel.create,checkseriviettel.store',
             'title' => 'Check Seri Viettel',
             "created_at" =>  \Carbon\Carbon::now(),
             "updated_at" => \Carbon\Carbon::now()
            ],
            [
                'name' => 'checkserimobi.create,checkserimobi.store',
                'title' => 'Check Seri Mobi',
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                'name' => 'checkserivina.create,checkserivina.store',
                'title' => 'Check Seri Vina',
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ],
            // pay bill
            [
                'name' => 'paybillvina.create,paybillvina.store',
                'title' => 'Pay Bill Vina',
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                'name' => 'paybillmobi.create,checkPhonemobi.store,getOTPmobi.store,getTokenmobi.store,paybillmobi.store',
                'title' => 'Pay Bill Mobi',
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ],
            // data phone
            [
                'name' => 'dataphonemobi.create,dataphonemobigetoken.store,dataphonemobiaddphone.store',
                'title' => 'Data Phone Mobi',
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ],
            
            ];
            // thieeus SUB
            foreach ($data as $key => $value) {
                DB::table('roles')->insert($value);
            }
        }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
