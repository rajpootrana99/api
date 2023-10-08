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
        Schema::create('invoice_quote', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('quote_id')->nullable();
            $table->string('description')->nullable()->default('');
            $table->string('account')->nullable()->default(0);
            $table->unsignedBigInteger('qty')->nullable()->default(1);
            $table->unsignedDouble('rate')->nullable()->default(0);
            $table->unsignedDouble('amount')->nullable()->default(0);
            $table->unsignedDouble('tax')->nullable()->default(0);
            $table->unsignedDouble('total')->nullable()->default(0);
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
        Schema::dropIfExists('invoice_quote');
    }
};
