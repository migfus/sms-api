<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobStatusSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        'id' => 549718506430213,
        'name' => 'Job Order'
      ],
      [
        'id' => 549718506436103,
        'name' => 'Contractual'
      ],
      [
        'id' => 549718506444746,
        'name' => 'Temporary'
      ],
      [
        'id' => 549718506460392,
        'name' => 'Permanent'
      ],
    ];

    foreach($data as $row) {
      \App\Models\JobStatus::create($row);
    }
  }
}
