<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('mobile_numbers', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('info_id')->unsigned();
      $table->boolean('allow_notify')->default(1);
      $table->decimal('number', 10, 0);
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('mobile_numbers');
  }
};
