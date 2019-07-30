<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EnforceForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('faculty_staff', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('faculty_id')->references('id')->on('faculties');
        });

        Schema::table('programme_loans', function (Blueprint $table) {
            $table->foreign('prog_id')->references('id')->on('programmes');
            $table->foreign('loan_id')->references('id')->on('loans');
        });

        Schema::table('programmes', function (Blueprint $table) {
            $table->foreign('faculty_id')->references('id')->on('faculties');
        });

        Schema::table('programme_certificates', function (Blueprint $table) {
            $table->foreign('prog_id')->references('id')->on('programmes');
            $table->foreign('cert_id')->references('id')->on('certificates');
        });

        Schema::table('programme_courses', function (Blueprint $table) {
            $table->foreign('prog_id')->references('id')->on('programmes');
            $table->foreign('course_id')->references('id')->on('courses');
        });

        Schema::table('campus_programmes', function (Blueprint $table) {
            $table->foreign('prog_id')->references('id')->on('programmes');
            $table->foreign('campus_id')->references('id')->on('campuses');
        });

        Schema::table('campus_faculties', function (Blueprint $table) {
            $table->foreign('faculty_id')->references('id')->on('faculties');
            $table->foreign('campus_id')->references('id')->on('campuses');
        });

        Schema::table('accomodations', function (Blueprint $table) {
            $table->foreign('campus_id')->references('id')->on('campuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropForeign('user_id');
        });

        Schema::table('faculty_staff', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('faculty_id');
        });

        Schema::table('programme_loans', function (Blueprint $table) {
            $table->dropForeign('prog_id');
            $table->dropForeign('loan_id');
        });

        Schema::table('programmes', function (Blueprint $table) {
            $table->dropForeign('faculty_id');
        });

        Schema::table('programme_certificates', function (Blueprint $table) {
            $table->dropForeign('prog_id');
            $table->dropForeign('cert_id');
        });

        Schema::table('programme_courses', function (Blueprint $table) {
            $table->dropForeign('prog_id');
            $table->dropForeign('course_id');
        });

        Schema::table('campus_programmes', function (Blueprint $table) {
            $table->dropForeign('prog_id');
            $table->dropForeign('campus_id');
        });

        Schema::table('campus_faculties', function (Blueprint $table) {
            $table->dropForeign('faculty_id');
            $table->dropForeign('campus_id');
        });

        Schema::table('accomodations', function (Blueprint $table) {
            $table->dropForeign('campus_id');
        });
    }
}
