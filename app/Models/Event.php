<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;

class Event extends Model
{
    use HasFactory, HasShortflakePrimary;

  public function EventCategory() {
    return $this->belongsTo(EventCategory::class, 'event_category_id');
  }
}
