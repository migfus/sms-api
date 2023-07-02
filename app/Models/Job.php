<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;

class Job extends Model
{
  use HasFactory, HasShortflakePrimary;

  public function JobLocation() {
    return $this->belongsTo(JobLocation::class, 'job_location_id');
  }

  public function JobDepartment() {
    return $this->belongsTo(JobDepartment::class, 'job_department_id');
  }

  public function JobStatus() {
    return $this->belongsTo(JobStatus::class, 'job_status_id');
  }

  public function JobType() {
    return $this->belongsTo(JobType::class, 'job_type_id');
  }
}
