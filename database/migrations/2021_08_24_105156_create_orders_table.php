<?php

use Facade\Ignition\Tabs\Tab;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id')->references('id')->on('users');
            $table->unsignedBigInteger('order_type_id')->nullable();
            $table->foreign('order_type_id')->references('id')->on('universal_task_order_types');
            $table->string('contact_name')->nullable();
            $table->string('contact_company_name')->nullable();
            $table->string('contact_mobile')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('image')->nullable();
            $table->string('address')->nullable();
            $table->double('address_lat')->nullable();
            $table->double('address_lng')->nullable();
            $table->decimal('product_weight')->nullable();
            $table->decimal('product_height')->nullable();
            $table->decimal('product_length')->nullable();
            $table->decimal('product_width')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->string('ref_id')->nullable();
            $table->decimal('amount')->nullable();
            $table->string('instruction')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
