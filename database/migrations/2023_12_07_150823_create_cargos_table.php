<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->string('name_cargo');
            $table->bigInteger('area_ip_id')->unsigned();
            $table->foreign('area_ip_id')
                ->references('id')
                ->on('area_ips')
                ->onDelete('cascade');
            $table->string('apellido_paterno')->nullable();
            $table->string('apellido_materno')->nullable();
            $table->string('nombre')->nullable();
            $table->string('dni')->nullable();
            $table->string('correo_institucional')->nullable();
            $table->string('nombre_equipo')->nullable();
            $table->string('usuario_red')->nullable();
            $table->string('procesador')->nullable();
            $table->string('memoria')->nullable();
            $table->string('sistema_opreativo')->nullable();
            $table->string('mac_dispositivo')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargos');
    }
};
