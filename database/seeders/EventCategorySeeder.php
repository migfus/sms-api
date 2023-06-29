<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventCategorySeeder extends Seeder
{
  public function run(): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => $snowflake->next(),
        'name' => 'Holiday',
        'bg_color' => '16A34A',
        'text_color' => 'fff',
        'user_id' => 1,
      ],
      [
        'id' => $snowflake->next(),
        'name' => 'Event',
        'bg_color' => 'FBBF24',
        'text_color' => '000',
        'user_id' => 1,
      ]
    ];

    foreach($data as $row) {
      \App\Models\EventCategory::create($row);
    }
  }
}
