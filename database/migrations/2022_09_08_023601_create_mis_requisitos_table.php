<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMisRequisitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mis_requisitos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_presentacion');
            $table->time('hora_presentacion');
            $table->foreignId('requisito_id')->constrained('requisitos');
            $table->foreignId('afiliado_id')->constrained('afiliados');
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
        Schema::dropIfExists('mis_requisitos');
    }
}
