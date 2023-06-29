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
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name'    => 'Single',
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name'    => 'Married',
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name'    => 'Separated',
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name'    => 'Widowed',
      ],
    ];

    foreach($data as $row) {
      \App\Models\CivilStatus::create($row);
    }
  }
}
