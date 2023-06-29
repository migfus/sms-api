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
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name' => 'Managerial'
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name' => 'Supervisory'
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name' => 'Technical'
      ],
    ];

    foreach($data as $row) {
      \App\Models\SeminarType::create($row);
    }
  }
}
