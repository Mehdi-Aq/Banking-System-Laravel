<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Support\Facades\DB;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->char('transaction_no',13);
            $table->enum('type',array("Transfer", "Deposit"))->default("Transfer");
            $table->unsignedDouble('amount',11,2);
            $table->unsignedBigInteger('account_no')->nullable();
            $table->enum('status',array("Pending", "Completed", "Canceled"))->default("Pending");
            $table->string('contact_email');
            $table->timestamps();

            $table->foreign('account_no')->references('account_no')->on('accounts');
            $table->index('account_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
