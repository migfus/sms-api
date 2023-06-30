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
        'user_id' => 1,
        'name' => 'Primary',
      ],
      [
        'id' => 562170298007426869,
        'user_id' => 1,
        'name' => 'Secondary',
      ],
      [
        'id' => 562170298007426870,
        'user_id' => 1,
        'name' => 'Vocational',
      ],
      [
        'id' => 562170298007426871,
        'user_id' => 1,
        'name' => 'College',
      ],
      [
        'id' => 562170298007426872,
        'user_id' => 1,
        'name' => 'Masteral',
      ],
      [
        'id' => 562170298007426873,
        'user_id' => 1,
        'name' => 'Doctoral',
      ],
    ];

    foreach($data as $row) {
      \App\Models\EducationLevel::create($row);
    }
  }
}
