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
        Schema::create('purchase_request', function (Blueprint $table) {
            $table->id();
            $table -> string("pr_no") -> nullable();
            $table -> string("proc_pr_no") -> nullable();
            $table -> date("pr_date") -> nullable();
            $table -> string('funds') -> nullable();
            $table -> string('rcc') -> nullable();
            $table -> longText('purpose') -> nullable();
            $table -> string('rfq_no') -> nullable();
            $table -> date("proc_date") -> nullable();
            $table -> date("posting_date") -> nullable(); 
            $table -> date("opening_date") -> nullable();
            $table -> boolean('deleted')->default(0);
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_request');
    }
};
