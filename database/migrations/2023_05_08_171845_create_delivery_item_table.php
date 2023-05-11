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
        Schema::create('delivery_item', function (Blueprint $table) {
            $table -> id();
            $table -> integer('qty');
            $table -> string('unit');
            $table -> integer('conversion');
            $table -> double('vat');
            $table -> decimal('landcost', 65, 3);
            $table -> decimal('landamt', 65, 3);
            $table -> decimal('netamt', 65, 3);
            $table -> unsignedBigInteger('FK_item_ID')-> unsigned();
            $table -> foreign('FK_item_ID') -> references('id') -> on('items') -> onUpdate('cascade');
            
            $table -> unsignedBigInteger('FK_delivery_ID')-> unsigned();
            $table -> foreign('FK_delivery_ID') -> references('id') -> on('delivery') -> onUpdate('cascade');
            
            $table -> boolean('deleted') -> default(0);
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_item');
    }
};
