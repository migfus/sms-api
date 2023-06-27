<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodTypeSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        'user_id' => 1,
        'name'    => 'O+',
      ],
      [
        'user_id' => 1,
        'name'    => 'O-',
      ],
      [
        'user_id' => 1,
        'name'    => 'A+',
      ],
      [
        'user_id' => 1,
        'name'    => 'A-',
      ],
      [
        'user_id' => 1,
        'name'    => 'B+',
      ],
      [
        'user_id' => 1,
        'name'    => 'B-',
      ],
      [
        'user_id' => 1,
        'name'    => 'AB+',
      ],
      [
        'user_id' => 1,
        'name'    => 'AB-',
      ],
    ];


    foreach($data as $row) {
      \App\Models\BloodType::create($row);
    }
  }
}
