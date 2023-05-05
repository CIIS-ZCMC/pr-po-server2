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
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');
            $table->string('ext_name') -> nullable();
            $table->string('contact') -> nullable();

            //Foreign key user, profile must assign to one user account unique account
            $table->unsignedBigInteger('FK_user_ID');
            $table->foreign('FK_user_ID')->references('id')->on('users')->onUpdate('cascade');

            //Foreign key department, user must belong to one deparment
            $table->unsignedBigInteger('FK_address_ID')->unsigned() -> nullable();
            $table->foreign('FK_address_ID')->references('id')->on('address')->onUpdate('cascade');
            $table->boolean('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
