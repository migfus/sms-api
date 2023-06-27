<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationLevelSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        'user_id' => 1,
        'name' => 'Primary',
      ],
      [
        'user_id' => 1,
        'name' => 'Secondary',
      ],
      [
        'user_id' => 1,
        'name' => 'Vocational',
      ],
      [
        'user_id' => 1,
        'name' => 'College',
      ],
      [
        'user_id' => 1,
        'name' => 'Masteral',
      ],
      [
        'user_id' => 1,
        'name' => 'Doctoral',
      ],
    ];

    foreach($data as $row) {
      \App\Models\EducationLevel::create($row);
    }
  }
}
