<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->timestamp('ins_date')->useCurrent();
            $table->timestamp('upd_date')->nullable();
            $table->char('del_flag')->default(0)->comment('deleted:1, active:0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}