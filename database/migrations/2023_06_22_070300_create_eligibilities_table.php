<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('eligibilities', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('info_id');
      $table->string('name');
      $table->integer('address_id');
      $table->decimal('rating', 5, 2);
      $table->date('exam_date'); // exam date
      $table->date('validity_date'); // expiration
      $table->string('number');
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('eligibilities');
  }
};
