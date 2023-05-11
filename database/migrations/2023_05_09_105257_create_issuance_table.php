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
        Schema::create('issuance', function (Blueprint $table) {
            $table -> id();
            $table -> string('PK_TRXNO');
            $table -> string('remarks') -> nullable();
            $table -> string('docno') -> nullable();
            $table -> integer('total_qty');
            $table -> integer('total_items');
            $table -> date('doc_date');
            $table -> decimal('total_price', 65, 3);
            $table -> boolean('cancel') -> default(false);

            $table -> unsignedBigInteger('FK_department_from_ID')-> unsigned();
            $table -> foreign('FK_department_from_ID') -> references('id') -> on('department') -> onUpdate('cascade');
            
            $table -> unsignedBigInteger('FK_department_to_ID')-> unsigned();
            $table -> foreign('FK_department_to_ID') -> references('id') -> on('department') -> onUpdate('cascade');
            $table -> boolean('deleted') -> default(0);
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issuance');
    }
};
