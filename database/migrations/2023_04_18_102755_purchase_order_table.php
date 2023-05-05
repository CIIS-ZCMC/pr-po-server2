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
        Schema::create('purchase_order', function (Blueprint $table){
            $table -> id();
            $table -> string('po_no');
            $table -> string('po_trxno');
            $table -> date('po_date');
            $table -> string('series_number') -> nullable();
            $table -> string('purpose') -> nullable();
            $table -> string('caf_number') -> nullable();
            $table -> string('terms') -> nullable();
            $table -> string('procurement_mode') -> nullable();
            $table -> decimal('total', 65, 3);

            $table -> unsignedBigInteger('FK_pr_ID')-> unsigned();
            $table -> foreign('FK_pr_ID') -> references('id') -> on('purchase_request') -> onUpdate('cascade');
            
            $table -> unsignedBigInteger('FK_department_ID')-> unsigned();
            $table -> foreign('FK_department_ID') -> references('id') -> on('department') -> onUpdate('cascade');
            
            $table -> unsignedBigInteger('FK_supplier_ID')-> unsigned();
            $table -> foreign('FK_supplier_ID') -> references('id') -> on('supplier') -> onUpdate('cascade');
            $table -> boolean('deleted') -> default(0);
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExist('purchase_order');
    }
};
