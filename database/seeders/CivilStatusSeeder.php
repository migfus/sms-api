<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CivilStatusSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        'user_id' => 1,
        'name'    => 'Single',
      ],
      [
        'user_id' => 1,
        'name'    => 'Married',
      ],
      [
        'user_id' => 1,
        'name'    => 'Separated',
      ],
      [
        'user_id' => 1,
        'name'    => 'Widowed',
      ],
    ];

    foreach($data as $row) {
      \App\Models\CivilStatus::create($row);
    }
  }
}
