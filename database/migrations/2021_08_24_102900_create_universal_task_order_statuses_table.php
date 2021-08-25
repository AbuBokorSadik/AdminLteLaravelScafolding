<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniversalTaskOrderStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universal_task_order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->string('color')->nullable();
            $table->tinyInteger('flow_enable')->default(1);
            $table->tinyInteger('lcf')->default(1);
            $table->integer('sequence')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('universal_task_order_statuses');
    }
}
