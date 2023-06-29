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
          'id' => $snowflake->next(),
          'user_id' => 1,
          'name' => 'Job Order',
        ],
        [
          'id' => $snowflake->next(),
          'user_id' => 1,
          'name' => 'Contractual',
        ],
        [
          'id' => $snowflake->next(),
          'user_id' => 1,
          'name' => 'Temporary',
        ],
        [
          'id' => $snowflake->next(),
          'user_id' => 1,
          'name' => 'Permanent',
        ],
        [
          'id' => $snowflake->next(),
          'user_id' => 1,
          'name' => 'On-Call',
        ],
      ];

      foreach($data as $row) {
        \App\Models\WorkStatus::create($row);
      }
    }
}
