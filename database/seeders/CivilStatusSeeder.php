<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CivilStatusSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        'id' => 549717001907709,
        'user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
        'name'    => 'Single',
      ],
      [
        'id' => 549717001913612,
        'user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
        'name'    => 'Married',
      ],
      [
        'id' => 549717001921661,
        'user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
        'name'    => 'Separated',
      ],
      [
        'id' => 549717001931074,
        'user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
        'name'    => 'Widowed',
      ],
    ];

    foreach($data as $row) {
      \App\Models\CivilStatus::create($row);
    }
  }
}
