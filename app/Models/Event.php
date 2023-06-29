<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

  public function EventCategory() {
    return $this->belongsTo(EventCategory::class, 'event_category_id');
  }
}
