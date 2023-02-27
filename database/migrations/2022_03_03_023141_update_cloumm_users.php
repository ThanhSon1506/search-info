<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCloummUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('date')->nullable();
            $table->integer('gender')->default(0);
            $table->date('date_start')->nullable();
            $table->string('cover')->nullable();
            $table->string('cover_after')->nullable();
            $table->string('description')->nullable();
            $table->integer('position')->default(0);
            $table->integer('action')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
