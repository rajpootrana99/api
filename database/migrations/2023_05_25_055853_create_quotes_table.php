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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('estimate_id');
            $table->unsignedBigInteger('eid')->nullable()->default(0);
            $table->unsignedBigInteger('qid')->nullable()->default(0);
            $table->unsignedBigInteger('line')->nullable()->default(0);
            $table->unsignedBigInteger('uid')->nullable()->default(0);
            $table->string('description')->nullable()->default('');
            $table->string('unit')->nullable()->default('');
            $table->unsignedBigInteger('qty')->nullable()->default(1);
            $table->unsignedDouble('rate')->nullable()->default(0);
            $table->unsignedDouble('amount')->nullable()->default(0);
            $table->unsignedDouble('margin')->nullable()->default(0);
            $table->unsignedDouble('subtotal')->nullable()->default(0);
            $table->unsignedDouble('gst')->nullable()->default(0);
            $table->unsignedDouble('amount_inc_gst')->nullable()->default(0);
            $table->unsignedDouble('variation_total')->nullable()->default(0);
            $table->unsignedDouble('order_unit_price')->nullable()->default(0);
            $table->unsignedDouble('order_total_amount')->nullable()->default(0);
            $table->unsignedDouble('work_cost')->nullable()->default(0);
            $table->unsignedDouble('inc_as_margin')->nullable()->default(0);
            $table->unsignedDouble('total_float')->nullable()->default(0);
            $table->unsignedDouble('total_margin')->nullable()->default(0);
            $table->string('quote_complete')->nullable()->default('');
            $table->string('quote_type')->nullable()->default('');
            $table->string('job_label')->nullable()->default('');
            $table->string('write_orders')->nullable()->default('');
            $table->string('eid_code')->nullable()->default('');
            $table->string('vo')->nullable()->default('');
            $table->unsignedDouble('total_extras')->nullable()->default(0);
            $table->string('cost_code_label')->nullable()->default('');
            $table->unsignedDouble('amount_ordered')->nullable()->default(0);
            $table->unsignedDouble('capture_savings')->nullable()->default(0);
            $table->unsignedDouble('movement')->nullable()->default(0);
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
        Schema::dropIfExists('quotes');
    }
};
