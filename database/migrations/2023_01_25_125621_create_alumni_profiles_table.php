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
        Schema::create('alumni_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('about_me')->nullable();
            $table->string('picture')->nullable();
            $table->unsignedBigInteger('college_graduated_from');
            $table->foreign('college_graduated_from')
              ->references('id')->on('college_names')->onDelete('cascade');
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
        Schema::dropIfExists('alumni_profiles');
    }
};
