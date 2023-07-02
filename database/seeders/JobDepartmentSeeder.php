<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobDepartmentSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        'id' => 549717969211197,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'College of Nursing',
      ],
      [
        'id' => 549717969218065,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'College of Engineering',
      ],
    ];

    foreach($data as $row) {
      \App\Models\JobDepartment::create($row);
    }
  }
}
