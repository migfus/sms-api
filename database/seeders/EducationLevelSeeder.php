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
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name' => 'College',
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name' => 'Masteral',
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name' => 'Doctoral',
      ],
    ];

    foreach($data as $row) {
      \App\Models\EducationLevel::create($row);
    }
  }
}
