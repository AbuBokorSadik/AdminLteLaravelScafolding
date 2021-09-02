<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyIdAndTypeIdColumnForCompanyTaskOrderTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_task_order_types', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->after('id');
            $table->foreign('company_id')->references('id')->on('users');
            $table->unsignedBigInteger('type_id')->after('company_id');
            $table->foreign('type_id')->references('id')->on('universal_task_order_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_task_order_types', function (Blueprint $table) {
            //
        });
    }
}
