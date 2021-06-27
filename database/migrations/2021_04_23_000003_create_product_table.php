
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id')->nullable();
            $table->string('name');
            $table->decimal('price_origin', 16, 2);
            $table->decimal('price_sell', 16, 2);
            $table->integer('sale')->nullable()->default(0);
            $table->string('avatar')->nullable();
            $table->integer('hot')->nullable()->default(getConfig('product-no-hot'));
            $table->longText('sort_describe')->nullable();
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
        Schema::dropIfExists('product');
    }
}
