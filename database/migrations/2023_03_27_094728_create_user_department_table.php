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
        Schema::create('user_department', function (Blueprint $table) {
            $table->id();

            $table -> unsignedBigInteger('FK_user_ID')-> unsigned();
            $table -> foreign('FK_user_ID') -> references('id') -> on('users') -> onUpdate('cascade');

            $table -> unsignedBigInteger('FK_department_ID')-> unsigned();
            $table -> foreign('FK_department_ID') -> references('id') -> on('department') -> onUpdate('cascade');
            
            $table->boolean('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_department');
    }
};
