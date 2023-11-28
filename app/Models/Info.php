<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;


class Info extends Model
{
    use HasFactory, HasShortflakePrimary;

    protected $fillable = [
      'user_id',
      'last_name',
      'first_name',
      'mid_name',
      'ext_name',
      'civil_status_id',
      'birth_day',
      'birth_place_id',
      'blood_type_id',
      'sex',
      'height',
      'weight',
      'address_id',
      'address',
    ];

    public function civil_status() {
      return $this->belongsTo(CivilStatus::class, 'civil_status_id');
    }

    public function blood_type() {
      return $this->belongsTo(BloodType::class, 'blood_type_id');
    }
}
