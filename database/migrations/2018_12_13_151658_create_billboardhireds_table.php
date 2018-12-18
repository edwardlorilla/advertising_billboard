<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillboardhiredsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billboardhireds', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('billboard_id');
            $table->foreign('billboard_id')->references('id')->on('billboards');
            $table->unsignedInteger('subject_id');
            $table->string('subject_type', 100);
            $table->string('date_hired_from');
            $table->string('date_hired_to');
            $table->timestamps();
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->unsignedInteger('billboardhired_id');
            $table->foreign('billboardhired_id')->references('id')->on('billboardhireds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billboardhireds');
    }
}
