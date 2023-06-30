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
        'id' => 562170298171006199,
        'name' => 'Faculty'
      ],
      [
        'id' => 562170298171006200,
        'name' => 'Staff'
      ],
      [
        'id' => 562170298171006201,
        'name' => 'Research'
      ],
    ];

    foreach($data as $row) {
      \App\Models\JobType::create($row);
    }
  }
}
