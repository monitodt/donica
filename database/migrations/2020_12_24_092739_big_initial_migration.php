<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BigInitialMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('home_address');
            $table->string('comment',2000)->nullable();
            $table->timestamps();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('consist');
            $table->float('cost');
            $table->float('real_cost');
        });
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('product_count');
            $table->boolean('is_billed');
            $table->boolean('is_sent');
            $table->boolean('finished');
            $table->float('summary_cost');
            $table->float('marginality');
            $table->foreign('customer_id')->references('id')->on('contacts')->onDelete('no action');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('no action');
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
        Schema::dropIfExists('purchases');
        Schema::dropIfExists('products');
        Schema::dropIfExists('contacts');
    }
}
