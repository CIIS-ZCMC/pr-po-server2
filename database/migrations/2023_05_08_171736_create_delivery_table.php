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
        Schema::create('delivery', function (Blueprint $table) {
            $table->id();
            $table->string('PK_TRXNO');
            $table->string('Terms') -> nullable();
            $table->string('docno') -> nullable();
            $table->text('remarks') -> nullable();
            $table->decimal('curramt', 65, 3) -> nullable();
            $table -> unsignedBigInteger('FK_po_ID')-> unsigned() -> nullable();
            $table -> foreign('FK_po_ID') -> references('id') -> on('purchase_order') -> onUpdate('cascade');
            $table -> unsignedBigInteger('FK_department_ID')-> unsigned() -> nullable();
            $table -> foreign('FK_department_ID') -> references('id') -> on('department') -> onUpdate('cascade');
            $table -> boolean('deleted') -> default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery');
    }
};
