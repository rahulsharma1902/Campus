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
        Schema::create('joinPages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('college_id');
            $table->foreign('college_id')
              ->references('id')->on('college_names')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
              $table->foreign('user_id')
                ->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('joinPages');
    }
};
