<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_staff', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->bigIncrements('user_id');
            $table->string('faculty_id', 10);
            $table->string('name');
            $table->string('specialization');
            $table->string('area_of_interest');
            $table->string('position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculty_staff');
    }
}
