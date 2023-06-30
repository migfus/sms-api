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
        'id' => 562170298208755294,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'College of Nursing',
      ],
      [
        'id' => 562170298208755295,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'College of Engineering',
      ],
    ];

    foreach($data as $row) {
      \App\Models\JobDepartment::create($row);
    }
  }
}
