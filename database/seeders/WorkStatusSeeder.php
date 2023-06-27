<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $data = [
        [
          'user_id' => 1,
          'name' => 'Job Order',
        ],
        [
          'user_id' => 1,
          'name' => 'Contractual',
        ],
        [
          'user_id' => 1,
          'name' => 'Temporary',
        ],
        [
          'user_id' => 1,
          'name' => 'Permanent',
        ],
        [
          'user_id' => 1,
          'name' => 'On-Call',
        ],
      ];

      foreach($data as $row) {
        \App\Models\WorkStatus::create($row);
      }
    }
}
