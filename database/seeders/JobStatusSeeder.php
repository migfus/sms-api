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
        'id' => 562170298120672848,
        'name' => 'Job Order'
      ],
      [
        'id' => 562170298120672849,
        'name' => 'Contractual'
      ],
      [
        'id' => 562170298120672850,
        'name' => 'Temporary'
      ],
      [
        'id' => 562170298120672851,
        'name' => 'Permanent'
      ],
    ];

    foreach($data as $row) {
      \App\Models\JobStatus::create($row);
    }
  }
}
