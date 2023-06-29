<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobStatusSeeder extends Seeder
{
  public function run(): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => $snowflake->next(),
        'name' => 'Job Order'
      ],
      [
        'id' => $snowflake->next(),
        'name' => 'Contractual'
      ],
      [
        'id' => $snowflake->next(),
        'name' => 'Temporary'
      ],
      [
        'id' => $snowflake->next(),
        'name' => 'Permanent'
      ],
    ];

    foreach($data as $row) {
      \App\Models\JobStatus::create($row);
    }
  }
}
