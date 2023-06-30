<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobLocationSeeder extends Seeder
{
  public function run(): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => 562170298246501053,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'CMU',
      ],
      [
        'id' => 562170298246501054,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'CSC, Malaybalay',
      ],
    ];

    foreach($data as $row) {
      \App\Models\JobLocation::create($row);
    }
  }
}
