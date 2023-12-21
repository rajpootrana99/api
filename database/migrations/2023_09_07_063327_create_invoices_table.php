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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->unsignedBigInteger('task_id')->nullable();
            $table->string('customer_po_number')->nullable();
            $table->string('issue_date')->nullable();
            $table->string('due_date')->nullable();
            $table->string('sent_date')->nullable();
            $table->integer('amount_are')->nullable();
            $table->string('note')->nullable();
            $table->unsignedBigInteger('sub_total')->nullable();
            $table->unsignedBigInteger('tax')->nullable();
            $table->unsignedBigInteger('total')->nullable();
            $table->string('status')->nullable()->default(0);
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
        Schema::dropIfExists('invoices');
    }
};
