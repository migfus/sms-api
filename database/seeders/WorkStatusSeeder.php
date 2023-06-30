<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
      $snowflake = app('Kra8\Snowflake\Snowflake');
      $data = [
        [
          'id' => 562170297944513802,
          'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
          'name' => 'Job Order',
        ],
        [
          'id' => 562170297944513803,
          'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
          'name' => 'Contractual',
        ],
        [
          'id' => 562170297944513804,
          'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
          'name' => 'Temporary',
        ],
        [
          'id' => 562170297944513805,
          'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
          'name' => 'Permanent',
        ],
        [
          'id' => 562170297944513806,
          'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
          'name' => 'On-Call',
        ],
      ];

      foreach($data as $row) {
        \App\Models\WorkStatus::create($row);
      }
    }
}
