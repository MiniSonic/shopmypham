<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->decimal('total_money', 16, 2);
            $table->integer('status')->nullable()->default(1)
                ->comment('1 new, 2 success, 3: cancel by admin, 4: cancel by user')->default(getKeyByValue(getConfig('order-status.1'), getConfig('order-status')));
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
        Schema::dropIfExists('order');
    }
}
