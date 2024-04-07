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
            $table->boolean('role_id')->default(0);
            $table->string('fname');
            $table->string('lname');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('contact');
            $table->string('gender');
            $table->text('address');
            $table->text('profile');
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
