<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('postal')->nullable();
            $table->string('code')->nullable();
            $table->string('address')->nullable();
            $table->string('town')->nullable();
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->string('pre1')->nullable();
            $table->string('pre2')->nullable();
            $table->string('pre3')->nullable();
            $table->string('pre4')->nullable();
            $table->string('pre5')->nullable();
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
        Schema::dropIfExists('registers');
    }
}
