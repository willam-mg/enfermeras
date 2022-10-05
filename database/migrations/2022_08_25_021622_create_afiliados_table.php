<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfiliadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afiliados', function (Blueprint $table) {
            $table->id();
            $table->string('numero_afiliado', 50);
            $table->string('cargo', 50);
            $table->string('nombre_completo', 50);
            $table->string('numero_matricula',50);
            $table->string('ci', 50)->unique();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('grupo_sanguineo', 50);
            $table->string('egreso', 100)->comment('institucion de egreso');
            $table->string('domicilio', 300)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->date('fecha_registro');
            $table->string('anos_servicio', 20)->nullable();
            $table->string('src_foto', 100)->nullable();
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
        Schema::dropIfExists('afiliados');
    }
}
