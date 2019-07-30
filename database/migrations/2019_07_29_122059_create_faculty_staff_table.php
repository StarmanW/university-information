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
            $table->unsignedBigInteger('user_id');
            $table->string('faculty_id', 4);
            $table->string('name');
            $table->string('specialization');
            $table->string('area_of_interest');
            $table->string('position');
            $table->timestamps();
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
