<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('experiences', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('person_id')->unsigned();
      $table->string('position');
      $table->string('company');
      $table->date('from');
      $table->date('to')->nullable();
      $table->decimal('salary', 8, 2)->nullable();
      $table->bigInteger('salary_type_id')->unsinged();
      $table->tinyInteger('sg')->unsgined()->nullable();
      $table->bigInteger('work_status_id')->unsgined();
        // [1] hourly, [2] daily, [3] monthly
      $table->boolean('is_government')->default(0);
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('experiences');
  }
};
