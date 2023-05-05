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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->integer('restrict')->comment('0->openAccount, 1->blockedAccount');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('reset_code')->nullable();
            $table->rememberToken();

            $table->unsignedBigInteger('FK_role_ID') -> unsigned() -> nullable();
            $table->foreign('FK_role_ID')->references('id')->on('role')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('deleted') -> default(0); 
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};