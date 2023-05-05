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
        Schema::create('items_category', function (Blueprint $table) {
            $table->id();
            
            $table -> unsignedBigInteger('FK_item_ID')-> unsigned();
            $table -> foreign('FK_item_ID') -> references('id') -> on('items') -> onUpdate('cascade'); 
            
            $table -> unsignedBigInteger('FK_category_ID')-> unsigned();
            $table -> foreign('FK_category_ID') -> references('id') -> on('category') -> onUpdate('cascade');
            
            $table -> boolean('deleted') -> default(0);
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items_category');
    }
};
