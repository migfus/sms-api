<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CivilStatusSeeder extends Seeder
{
  public function run(): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => 562170297889986620,
        'user_id' => 1,
        'name'    => 'Single',
      ],
      [
        'id' => 562170297889986621,
        'user_id' => 1,
        'name'    => 'Married',
      ],
      [
        'id' => 562170297889986622,
        'user_id' => 1,
        'name'    => 'Separated',
      ],
      [
        'id' => 562170297889986623,
        'user_id' => 1,
        'name'    => 'Widowed',
      ],
    ];

    foreach($data as $row) {
      \App\Models\CivilStatus::create($row);
    }
  }
}
