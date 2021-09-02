<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnForUniversalTaskOrderTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('universal_task_order_types', function (Blueprint $table) {
            $table->decimal('charge',11,2)->after('color')->nullable();
            $table->enum('slab',['F','P'])->after('charge')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('universal_task_order_types', function (Blueprint $table) {
            //
        });
    }
}
