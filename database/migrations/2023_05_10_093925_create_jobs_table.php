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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->default();
            $table->unsignedBigInteger('site_id')->nullable()->default();
            $table->string('description')->nullable()->default('');
            $table->string('owner')->nullable()->default('');
            $table->unsignedBigInteger('status')->nullable()->default(0);
            $table->string('completed_date')->nullable()->default('');
            $table->unsignedBigInteger('days_in_progress')->nullable()->default(0);
            $table->unsignedBigInteger('total_sell_price')->nullable()->default(0);
            $table->unsignedBigInteger('profit')->nullable()->default(0);
            $table->unsignedBigInteger('percentage')->nullable()->default(0);
            $table->string('invoiced')->nullable()->default('');
            $table->string('remaining_invoice_amount')->nullable()->default('');
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
        Schema::dropIfExists('jobs');
    }
};
