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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); # csatlakozás a users táblához és törléskor a kapcsolódó taskok is törlődnek
            $table->string('title'); # kötelező mező a feladat címének tárolására
            $table->text('description')->nullable(); # feladat leírása, nem kötelező mező
            $table->string('status')->default('pending'); # feladat állapota, alapértelmezett érték: függőben
            $table->string('priority')->default('medium'); # feladat prioritása, alapértelmezett érték: közepes
            $table->dateTime('due_date'); # feladat határideje
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
