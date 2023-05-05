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
        Schema::create('pr_items', function (Blueprint $table) {
            $table->id();
            $table -> integer('quantity');
            $table -> string('unit');
            $table -> double('unit_cost',15,3); 
            $table -> decimal('initial_cost',65,3); 
            $table -> decimal('final_cost',65,3); 
            $table -> boolean('status') -> default(0);

            $table -> unsignedBigInteger('FK_pr_ID')-> unsigned();
            $table -> foreign('FK_pr_ID') -> references('id') -> on('purchase_request') -> onUpdate('cascade');
            
            $table -> unsignedBigInteger('FK_item_ID')-> unsigned();
            $table -> foreign('FK_item_ID') -> references('id') -> on('items') -> onUpdate('cascade');
            
            $table -> boolean('deleted') -> default(0);
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pr_items');
    }
};
