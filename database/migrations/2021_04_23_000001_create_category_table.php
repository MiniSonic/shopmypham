<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->integer('parent_id')->nullable()->default(getConfig('parent_id_default'));;
            $table->integer('level')->nullable()->default(getConfig('category_level_default'));
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
        Schema::dropIfExists('category');
    }
}