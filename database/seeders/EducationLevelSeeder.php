<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationLevelSeeder extends Seeder
{
  public function run(): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => 562170298007426868,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'Primary',
      ],
      [
        'id' => 562170298007426869,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'Secondary',
      ],
      [
        'id' => 562170298007426870,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'Vocational',
      ],
      [
        'id' => 562170298007426871,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'College',
      ],
      [
        'id' => 562170298007426872,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'Masteral',
      ],
      [
        'id' => 562170298007426873,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'Doctoral',
      ],
    ];

    foreach($data as $row) {
      \App\Models\EducationLevel::create($row);
    }
  }
}
