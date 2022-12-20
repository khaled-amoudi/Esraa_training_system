<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('user_id');
            $table->string('group_number');
            $table->string('attendance_days')->default(8)->nullable();
            $table->string('attendance_state')->default(1);
            $table->string('grades_state')->default(1);
            $table->unsignedBigInteger('semester_id');
            $table->softDeletes();
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
        Schema::dropIfExists('groups');
    }
};
