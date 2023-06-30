<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeminarTypeSeeder extends Seeder
{
  public function run(): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => 562170298074537243,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'Managerial'
      ],
      [
        'id' => 562170298074537244,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'Supervisory'
      ],
      [
        'id' => 562170298074537245,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'Technical'
      ],
    ];

    foreach($data as $row) {
      \App\Models\SeminarType::create($row);
    }
  }
}
