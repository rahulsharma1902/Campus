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
        Schema::create('staff_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('about_me')->nullable();
            $table->string('picture')->nullable();
            $table->unsignedBigInteger('college_id');
            $table->foreign('college_id')
              ->references('id')->on('college_names')->onDelete('cascade');
            $table->string('location')->nullable();
            $table->unsignedBigInteger('position_id');
            $table->foreign('position_id')
              ->references('id')->on('positions')->onDelete('cascade');
              $table->unsignedBigInteger('dept_id');
              $table->foreign('dept_id')
                ->references('id')->on('depts')->onDelete('cascade');
            $table->string('social_links')->nullable();
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
              ->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('staff_profiles');
    }
};
