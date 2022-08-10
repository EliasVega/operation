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
        Schema::create('operating_partials', function (Blueprint $table) {
            $table->id();

            $table->integer('quantity');
            $table->integer('price');
            $table->integer('subtotal');
            $table->integer('item');
            $table->enum('status', ['PENDIENTE', 'PAGADO'])->default('PENDIENTE');

            $table->foreignId('operation_id')->constrained()->onUpdate('cascade');
            $table->foreignId('operating_id')->constrained()->onUpdate('cascade');
            $table->foreignId('partial_id')->constrained()->onUpdate('cascade');
            $table->foreignId('payment_id')->nullable()->constrained();

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
        Schema::dropIfExists('operating_partials');
    }
};
