<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('seminars', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('info_id')->unsgined();
      $table->string('name');
      $table->date('from');
      $table->date('to')->nullable();
      $table->decimal('hours', 5, 2);
      $table->bigInteger('seminar_type_id');
      $table->string('sponsor');
      $table->timestamps();
    });
  }

  public function down(): void {
      Schema::dropIfExists('seminars');
  }
};
