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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('amount');
            $table->biginteger('discount');
            $table->bigInteger('total');
            $table->string('reference', 20)->nullable();

            $table->foreignId('bank_id')->nullable()->constrained()->onUpdate('cascade');//Banco de destino de fondos
            $table->foreignId('payment_method_id')->constrained()->onUpdate('cascade');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
            $table->foreignId('responsible_id')->references('id')->on('users');
            $table->foreignId('bank_origin_id')->references('id')->on('banks'); //Banco de origen de fondos

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
        Schema::dropIfExists('payments');
    }
};
