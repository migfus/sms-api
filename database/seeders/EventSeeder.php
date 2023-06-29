<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        'user_id' => 1,
        'event_category_id' => \App\Models\EventCategory::where('id', 1)->first()->id, // HOliday
        'title' => 'Buenas Deas sheess',
        'start' => Carbon::now()->add(3, 'day'),
        'end' => Carbon::now()->add(4, 'day'),
      ],
      [
        'user_id' => 1,
        'event_category_id' => \App\Models\EventCategory::where('id', 2)->first()->id, // Event
        'title' => 'CMU Event',
        'start' => Carbon::now()->add(1, 'day'),
        'end' => Carbon::now()->add(3, 'day'),
      ],
    ];

    foreach($data as $row) {
      \App\Models\Event::create($row);
    }
  }
}
