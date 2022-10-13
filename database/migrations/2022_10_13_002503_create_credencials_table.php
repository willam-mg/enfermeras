<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCredencialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credencials', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_registro');
            $table->date('fecha_emision');
            $table->date('fecha_vencimiento');
            $table->tinyInteger('renovacion')->default(2)->comment('2 = no, 1 = si');
            $table->decimal('costo_renovacion', 11, 2)->nullable();
            $table->tinyInteger('estado')->default(2)->comment('2 = pendiente, 1 = entregado');
            $table->foreignId('afiliado_id')->constrained('afiliados');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credencials');
    }
}
