<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_id')->nullable();
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id')->references('id')->on('users');
            $table->unsignedBigInteger('assigned_id')->nullable();
            $table->foreign('assigned_id')->references('id')->on('users');
            $table->unsignedBigInteger('order_assignment_id')->nullable();
            $table->foreign('order_assignment_id')->references('id')->on('order_assignments');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id')->references('id')->on('areas');
            $table->unsignedBigInteger('current_status_id')->nullable();
            $table->foreign('current_status_id')->references('id')->on('order_statuses');
            $table->timestamp('deadline')->nullable();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->text('qrcode')->nullable();
            $table->string('instruction')->nullable();
            $table->decimal('assigned_amount',11,2)->nullable();
            $table->decimal('collected_amount',11,2)->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_mobile')->nullable();
            $table->string('contact_address')->nullable();
            $table->string('ref_id')->nullable();
            $table->integer('sequence')->nullable();
            $table->integer('sequence_version')->nullable();
            $table->decimal('service_charge',11,2)->nullable();
            $table->string('cancellation_reason')->nullable();
            $table->string('reschedule_reason')->nullable();
            $table->enum('payment',['PAID', 'DUE', 'IN PROGRESS'])->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
