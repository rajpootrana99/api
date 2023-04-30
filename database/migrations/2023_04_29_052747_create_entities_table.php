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
        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->bigInteger('abn')->nullable();
            $table->string('entity')->nullable();
            $table->string('primary_phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('director')->nullable();
            $table->string('trade')->nullable();
            $table->string('inc')->nullable();
            $table->string('abbrev')->nullable();
            $table->string('pl_expirey')->nullable();
            $table->string('wc_expirey')->nullable();
            $table->string('item_type')->nullable();
            $table->string('path')->nullable();
            $table->string('payment_terms')->nullable();
            $table->string('contract_signed')->nullable();
            $table->integer('active')->default(0);
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
        Schema::dropIfExists('entities');
    }
};
