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
            $table->string('tx_unique_id')->unique()->nullable();
            $table->string('order_id')->unique()->nullable();
            $table->unsignedBigInteger('sender_id')->nullable();
            $table->foreign('sender_id')->references('id')->on('user_accounts');
            $table->unsignedBigInteger('receiver_id')->nullable();
            $table->foreign('receiver_id')->references('id')->on('user_accounts');
            // $table->unsignedBigInteger('transaction_type_id')->nullable();
            // $table->foreign('transaction_type_id')->references('id')->on('transaction_types');
            // $table->unsignedBigInteger('transaction_status_id')->nullable();
            // $table->foreign('transaction_status_id')->references('id')->on('transaction_statuses');
            $table->decimal('amount', 16, 4);
            $table->decimal('sender_fee', 16, 4)->nullable();
            $table->decimal('sender_tax', 16, 4)->nullable();
            $table->decimal('sender_commission', 16, 2)->nullable();
            $table->decimal('sender_service_charge', 16, 2)->nullable();
            $table->decimal('total_amount', 16, 4)->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at')->nullable();
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
