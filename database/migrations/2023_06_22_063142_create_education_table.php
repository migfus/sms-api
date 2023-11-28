<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('education', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('info_id')->unsigned();
      $table->bigInteger('level')->unsigned();
      $table->string('school');
      $table->string('degree')->nullable();
      $table->date('from');
      $table->date('to')->nullable();
      $table->string('scholarship')->nullable();
      $table->string('honors')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void {
      Schema::dropIfExists('education');
  }
};
