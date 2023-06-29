<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('jobs', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('user_id')->unsinged();
      $table->string('title');
      $table->date('posted_at');
      $table->date('unposted_at');
      $table->bigInteger('job_location_id')->unsigned();
      $table->bigInteger('job_department_id')->unsigned();
      $table->bigInteger('job_type_id')->unsigned();
      $table->bigInteger('job_status_id')->unsigned();
      $table->string('requirements');
      $table->string('responsibilities');
      $table->string('qualifications');
      $table->string('description');
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('jobs');
  }
};
