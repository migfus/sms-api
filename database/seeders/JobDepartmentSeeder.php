<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobDepartmentSeeder extends Seeder
{
  public function run(): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name'    => 'College of Nursing',
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name'    => 'College of Engineering',
      ],
    ];

    foreach($data as $row) {
      \App\Models\JobDepartment::create($row);
    }
  }
}
