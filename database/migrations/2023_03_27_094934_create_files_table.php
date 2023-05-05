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
        Schema::create('files', function (Blueprint $table) {
            $table -> id();
            $table -> string('name');
            $table -> unsignedBigInteger('FK_pr_relation_ID')-> unsigned();
            $table -> foreign('FK_pr_relation_ID') -> references('id') -> on('pr_relation') -> onUpdate('cascade');
            $table -> boolean('deleted') -> default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
