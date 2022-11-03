<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcreditacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acreditaciones', function (Blueprint $table) {
            $table->id();
            $table->integer('gestion');
            $table->integer('mes');
            $table->decimal('monto', 8, 2);
            $table->tinyInteger('estado')->default(2)->comment('2 = Pendiente, 3 = Pagado');
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
        Schema::dropIfExists('acreditacions');
    }
}
