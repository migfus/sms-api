<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalaryTypeSeeder extends Seeder
{
  public function run(): void
  {
    $data = [
      [
        // 'id' => 1,
        'name' => 'Monthly'
      ],
      [
        // 'id' => 2,
        'name' => 'Daily'
      ],
    ];

    foreach($data as $row) {
      \App\Models\SalaryType::create($row);
    }
  }
}
