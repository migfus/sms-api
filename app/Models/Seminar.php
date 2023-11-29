<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;

class Seminar extends Model
{
    use HasFactory, HasShortflakePrimary;

  protected $fillable = [
    'info_id', 'name', 'from', 'to', 'hours', 'seminar_type_id', 'sponsor'
  ];

  public function seminar_type() {
    return $this->belongsTo(SeminarType::class);
  }
}
