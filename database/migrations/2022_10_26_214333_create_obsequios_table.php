<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObsequiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obsequios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_entrega')->nullable();
            $table->time('hora_entrega')->nullable();
            $table->foreignId('user_id')->constrained('users')->nullable();
            $table->foreignId('afiliado_id')->constrained('afiliados');
            $table->integer('gestion')->nullable();
            $table->string('observacion', 300)->nullable();
            $table->tinyInteger('estado')->default(2)->comment('2 = pendiente, 3 = entregado');
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
        Schema::dropIfExists('obsequios');
    }
}
