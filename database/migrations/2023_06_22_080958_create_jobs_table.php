<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('jobs', function (Blueprint $table) {
      $table->id();
      $table->integer('user_id')->unsinged();
      $table->string('title');
      $table->date('posted_at');
      $table->date('unposted_at');
      $table->integer('job_location_id')->unsigned();
      $table->integer('job_department_id')->unsigned();
      $table->integer('job_type_id')->unsigned();
      $table->integer('job_status_id')->unsigned();
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
