<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicacions', function (Blueprint $table) {
            $table->id();
            $table->string("titulo");
            $table->enum('tipo', ['Tiempo completo', 'Medio Tiempo', 'Temporal', 'Pasantias', 'Servicio']);
            $table->string("nivel")->nullable(); // junior, senior, manager
            $table->text("descripcion");
            $table->text("requerimientos")->nullable();
            $table->decimal("salario", 10, 2)->nullable();
            $table->string("ubicacion")->nullable();
            $table->integer("estado")->default(0); // 0: borrador, 1:publicado, 2: inactivo

            // N:1
            $table->bigInteger("empresa_id")->unsigned();
            $table->foreign("empresa_id")->references("id")->on("empresas");

            $table->bigInteger("categoria_id")->unsigned();
            $table->foreign("categoria_id")->references("id")->on("categorias");
            // quien publicó
            $table->bigInteger("persona_id")->unsigned();
            $table->foreign("persona_id")->references("id")->on("personas");
            
            // eliminacion temporal
            
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
        Schema::dropIfExists('publicacions');
        // $table->dropSoftDeletes();
    }
}
