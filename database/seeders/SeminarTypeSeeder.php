<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeminarTypeSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        'user_id' => 1,
        'name' => 'Managerial'
      ],
      [
        'user_id' => 1,
        'name' => 'Supervisory'
      ],
      [
        'user_id' => 1,
        'name' => 'Technical'
      ],
    ];

    foreach($data as $row) {
      \App\Models\SeminarType::create($row);
    }
  }
}
