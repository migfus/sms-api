<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('voluntaries', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('info_id')->unsigned();
      $table->string('name');
      $table->date('from');
      $table->date('to')->nullable();
      $table->decimal('hours', 5, 2);
      $table->string('position');
      $table->timestamps();
    });
  }

  public function down(): void {
      Schema::dropIfExists('voluntaries');
  }
};
