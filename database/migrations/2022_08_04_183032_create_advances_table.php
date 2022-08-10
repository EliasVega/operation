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
        Schema::create('advances', function (Blueprint $table) {
            $table->id();

            $table->integer('amount');
            $table->string('description', 255);
            $table->enum('status',['PENDIENTE', 'CANCELADO'])->default('PENDIENTE');

            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
            $table->foreignId('payment_id')->nullable()->constrained()->onUpdate('cascade');
            $table->foreignId('responsible_id')->references('id')->on('users');

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
        Schema::dropIfExists('advances');
    }
};
