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
            $table->date('fecha_entrega');
            $table->time('hora_entrega');
            $table->foreignId('user_id')->constrained('users')->nullable();
            $table->foreignId('afiliado_id')->constrained('afiliados')->nullable();
            $table->string('observacion', 300);
            $table->tinyInteger('estado')->default(2)->comment('2 = pendiente, 1 = entregado');
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
