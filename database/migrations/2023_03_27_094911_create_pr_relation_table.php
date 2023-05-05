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
        Schema::create('pr_relation', function (Blueprint $table) {
            $table -> id();
            $table -> boolean('mms_approval')->default(0);
            $table -> boolean('procurement_approval')->default(0);
            $table -> boolean('budget_approval')->default(0);
            $table -> boolean('accounting_approval')->default(0);
            $table -> boolean('finance_approval')->default(0);
            $table -> boolean('bidding_status')->default(0);
            $table -> boolean('po_status')->default(0);

            $table -> float("estimated_grand",65,3) -> nullable();
            $table -> float("final_grand",65,3) -> nullable();

            $table -> unsignedBigInteger('FK_user_ID')-> unsigned() -> nullable();
            $table -> foreign('FK_user_ID') -> references('id') -> on('users') -> onUpdate('cascade');

            $table -> unsignedBigInteger('FK_department_ID')-> unsigned();
            $table -> foreign('FK_department_ID') -> references('id') -> on('department') -> onUpdate('cascade');

            $table -> unsignedBigInteger('FK_pr_ID')-> unsigned();
            $table -> foreign('FK_pr_ID') -> references('id') -> on('purchase_request') -> onUpdate('cascade');

            $table -> boolean('deleted') -> default(0);
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pr_relation');
    }
};
