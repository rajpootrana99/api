<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_headers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('header_id');
            $table->string('cost_code');
            $table->unsignedBigInteger('code');
            $table->string('sub_header');
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
        Schema::dropIfExists('sub_headers');
    }
};
