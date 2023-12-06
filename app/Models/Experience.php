<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;

class Experience extends Model
{
    use HasFactory, HasShortflakePrimary;

  protected $fillable = [
    'info_id',
    'position',
    'company',
    'from',
    'to',
    'salary',
    'salary_type_id',
    'sg',
    'work_status_id',
    'is_government',
  ];

  public function work_status() {
    return $this->belongsTo(WorkStatus::class);
  }

  public function salary_type() {
    return $this->belongsTo(SalaryType::class);
  }
}
