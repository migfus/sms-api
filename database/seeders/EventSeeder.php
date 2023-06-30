<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
  public function run(): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => 562170298431053281,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'event_category_id' => \App\Models\EventCategory::where('id', 562170298397498532)->first()->id, // HOliday
        'title' => 'Buenas Deas sheess',
        'start' => Carbon::now()->add(3, 'day'),
        'end' => Carbon::now()->add(4, 'day'),
      ],
      [
        'id' => 562170298435246529,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'event_category_id' => \App\Models\EventCategory::where('id', 562170298397498533)->first()->id, // Event
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
