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
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->default();
            $table->unsignedBigInteger('site_id')->nullable()->default();
            $table->string('description')->nullable()->default('');
            $table->unsignedBigInteger('priority')->nullable()->default(0);
            $table->string('eid')->nullable()->default('');
            $table->string('item')->nullable()->default('');
            $table->string('uid')->nullable()->default('');
            $table->unsignedBigInteger('status')->nullable()->default(0);
            $table->string('completed_date')->nullable()->default('');
            $table->string('days_in_progress')->nullable()->default('');
            $table->float('quoted_price_ex_gst')->nullable()->default(0);
            $table->float('est_cost_price')->nullable()->default(0);
            $table->float('profit')->nullable()->default(0);
            $table->string('type')->nullable()->default();
            $table->string('proj_no')->nullable()->default();
            $table->string('requested_by')->nullable()->default();
            $table->string('requested_date')->nullable()->default();
            $table->string('requested_completion')->nullable()->default();
            $table->string('forecast_start_on_site')->nullable()->default('');
            $table->string('project_duration')->nullable()->default('');
            $table->string('forecast_completion')->nullable()->default('');
            $table->string('forecast_value')->nullable()->default('');
            $table->string('forecast_margin')->nullable()->default('');
            $table->float('forecast_profit')->nullable()->default();
            $table->string('month')->nullable()->default('');
            $table->string('quote_type')->nullable()->default('');

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
        Schema::dropIfExists('enquiries');
    }
};
