<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;

class Education extends Model
{
    use HasFactory, HasShortflakePrimary;

  protected $fillable = [
    'info_id', 'level', 'school', 'degree', 'from', 'to', 'scholarship', 'honors'
  ];

  public function education_levels() {
    return $this->belongsTo(EducationLevel::class, 'level');
  }
}
