<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('assigned_by_id');
            $table->foreign('assigned_by_id')->references('id')->on('users');
            $table->unsignedBigInteger('assigned_to_id');
            $table->foreign('assigned_to_id')->references('id')->on('users');
            $table->unsignedBigInteger('current_order_status_id')->nullable();
            $table->foreign('current_order_status_id')->references('id')->on('order_statuses');
            $table->decimal('collected_amount')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id')->references('id')->on('areas');
            $table->decimal('service_charge')->nullable();
            $table->decimal('area_charge')->nullable();
            $table->decimal('weight_charge')->nullable();
            $table->decimal('delivery_type_charge')->nullable();
            $table->string('cancellation_reason')->nullable();
            $table->string('reschedule_reason')->nullable();
            $table->enum('payment',['PAID', 'DUE', 'IN PROGRESS']);
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_assignments');
    }
}
