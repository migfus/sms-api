<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobLocationSeeder extends Seeder
{
  public function run(): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name' => 'CMU',
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name' => 'CSC, Malaybalay',
      ],
    ];

    foreach($data as $row) {
      \App\Models\JobLocation::create($row);
    }
  }
}
