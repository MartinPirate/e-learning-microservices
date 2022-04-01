<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
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
            $table->float('amount');
            $table->string('currency');
            $table->enum('type', ['credit', 'debit']);
            //$table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('paid_to')->nullable();
            $table->enum('status', ['complete', 'pending', 'failed', 'cancelled'])->default('pending');
            $table->string('details')->nullable();
            $table->string('reference')->nullable();
            $table->enum('gateway', ['paypal', 'stripe', 'wepay']);
            $table->unsignedBigInteger('paid_by');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('paid_by')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('paid_to')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');


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
}
