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
        Schema::create('partials', function (Blueprint $table) {
            $table->id();

            $table->integer('total');
            $table->integer('items');
            $table->enum('status',['PENDIENTE', 'CANCELADA'])->default('PENDIENTE');
            $table->enum('aprobation', ['APROBADO', 'NO APROBADO', 'PAGADO'])->default('APROBADO');

            $table->foreignId('payment_id')->nullable()->constrained();
            $table->foreignId('remission_id')->constrained()->onUpdate('cascade');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade');

            $table->foreignId('responsible_id')
            ->references('id')
            ->on('users');

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
        Schema::dropIfExists('partials');
    }
};
