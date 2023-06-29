<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodTypeSeeder extends Seeder
{
  public function run(): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name'    => 'O+',
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name'    => 'O-',
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name'    => 'A+',
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name'    => 'A-',
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name'    => 'B+',
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name'    => 'B-',
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name'    => 'AB+',
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name'    => 'AB-',
      ],
    ];


    foreach($data as $row) {
      \App\Models\BloodType::create($row);
    }
  }
}
