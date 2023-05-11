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
        Schema::create('issuance_item', function (Blueprint $table) {
            $table -> id();
            $table -> date('req_date') -> nullable();
            $table -> integer('qty');
            $table -> date('exp_date') -> nullable();
            $table -> integer('conversion');
            $table -> integer('inv_balance');
            $table -> decimal('price', 15, 3);
            $table -> decimal('netcost', 35, 3);

            $table -> unsignedBigInteger('FK_item_ID')-> unsigned();
            $table -> foreign('FK_item_ID') -> references('id') -> on('items') -> onUpdate('cascade');
            
            $table -> unsignedBigInteger('FK_issuance_ID')-> unsigned();
            $table -> foreign('FK_issuance_ID') -> references('id') -> on('issuance') -> onUpdate('cascade');
            
            $table -> unsignedBigInteger('FK_po_ID')-> unsigned() -> nullable();
            $table -> foreign('FK_po_ID') -> references('id') -> on('purchase_order') -> onUpdate('cascade');
            
            $table -> boolean('deleted') -> default(0);
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issuance_item');
    }
};
