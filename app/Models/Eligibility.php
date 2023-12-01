<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;

class Eligibility extends Model
{
    use HasFactory, HasShortflakePrimary;

  protected $fillable = [
    'info_id',
    'name',
    'address_id',
    'rating',
    'exam_date',
    'validity_date',
    'number'
  ];
}
