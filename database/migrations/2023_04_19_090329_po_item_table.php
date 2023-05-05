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
        Schema::create('po_item', function(Blueprint $table){
            $table -> id();
            $table -> text('item_spec') -> nullable();
            $table -> integer('quantity');
            $table -> decimal('price', 65, 3);
            $table -> decimal('total_price', 65, 3);
            
            $table -> unsignedBigInteger('FK_po_ID')-> unsigned();
            $table -> foreign('FK_po_ID') -> references('id') -> on('purchase_order') -> onUpdate('cascade');
            
            $table -> unsignedBigInteger('FK_item_ID')-> unsigned();
            $table -> foreign('FK_item_ID') -> references('id') -> on('items') -> onUpdate('cascade');
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('po_item');
    }
};
