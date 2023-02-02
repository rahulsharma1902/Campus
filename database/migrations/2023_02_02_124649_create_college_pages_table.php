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
        Schema::create('college_pages', function (Blueprint $table) {
            $table->id();
            $table->string('college_name')->nullable();
            $table->string('history')->nullable();
            $table->string('address')->nullable();
            $table->string('type')->nullable();
            $table->string('admin_contact')->nullable();
            $table->string('school_management')->nullable();
            $table->string('location')->nullable();
            $table->string('population')->nullable();
            $table->string('faculties')->nullable();
            $table->string('union_leader')->nullable();
            $table->string('images')->nullable();
            $table->string('information_section')->nullable();
            $table->string('review')->nullable();
            $table->unsignedBigInteger('college_id');
            $table->foreign('college_id')
              ->references('id')->on('college_names')->onDelete('cascade');
            $table->unsignedBigInteger('moderator_id');
              $table->foreign('moderator_id')
                ->references('id')->on('staff_profiles')->onDelete('cascade');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('college_pages');
    }
};
