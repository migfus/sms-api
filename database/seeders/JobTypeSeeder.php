<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTypeSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        'id' => 549718712245638,
        'name' => 'Faculty'
      ],
      [
        'id' => 549718712254629,
        'name' => 'Staff'
      ],
      [
        'id' => 549718712267890,
        'name' => 'Research'
      ],
    ];

    foreach($data as $row) {
      \App\Models\JobType::create($row);
    }
  }
}
