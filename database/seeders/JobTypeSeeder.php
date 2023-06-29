<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTypeSeeder extends Seeder
{
  public function run(): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => $snowflake->next(),
        'name' => 'Faculty'
      ],
      [
        'id' => $snowflake->next(),
        'name' => 'Staff'
      ],
      [
        'id' => $snowflake->next(),
        'name' => 'Research'
      ],
    ];

    foreach($data as $row) {
      \App\Models\JobType::create($row);
    }
  }
}
