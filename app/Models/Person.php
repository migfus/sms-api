<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;

class Person extends Model
{
    use HasFactory, HasShortflakePrimary;

  public function civil_status() {
    return $this->belongsTo(CivilStatus::class, 'civil_status_id');
  }

  public function blood_type() {
    return $this->belongsTo(BloodType::class, 'blood_type_id');
  }
}
