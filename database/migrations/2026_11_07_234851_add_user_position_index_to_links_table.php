<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Índice para consultas de listagem e reordenação por usuário + posição.
     */
    public function up(): void
    {
        Schema::table('links', function (Blueprint $table) {
            $table->index(['user_id', 'position'], 'links_user_id_position_index');
        });
    }

    public function down(): void
    {
        Schema::table('links', function (Blueprint $table) {
            $table->dropIndex('links_user_id_position_index');
        });
    }
};
