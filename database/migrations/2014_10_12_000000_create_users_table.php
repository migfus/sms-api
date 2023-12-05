<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('email')->unique()->nullable();
      $table->string('password')->nullable();
      $table->string('avatar')->nullable();

      $table->boolean('notify_email_job')->boolean()->default(false);
      $table->boolean('notify_email_news')->boolean()->default(false);
      $table->boolean('notify_email_event')->boolean()->default(false);

      $table->boolean('notify_sms_job')->boolean()->default(false);
      $table->boolean('notify_sms_news')->boolean()->default(false);
      $table->boolean('notify_sms_event')->boolean()->default(false);

      $table->timestamp('email_verified_at')->nullable();
      $table->rememberToken();
      $table->timestamps();
    });
  }

  public function down(): void {
      Schema::dropIfExists('users');
  }
};
