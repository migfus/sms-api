<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobDepartmentSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        'user_id' => 1,
        'name'    => 'College of Nursing',
      ],
      [
        'user_id' => 1,
        'name'    => 'College of Engineering',
      ],
    ];

    foreach($data as $row) {
      \App\Models\JobDepartment::create($row);
    }
  }
}
