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
      $data = [
        [
          'id' => 549720216082390,
          'user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
          'name' => 'Job Order',
        ],
        [
          'id' => 549720216095137,
          'user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
          'name' => 'Contractual',
        ],
        [
          'id' => 549720216102557,
          'user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
          'name' => 'Temporary',
        ],
        [
          'id' => 549720216109951,
          'user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
          'name' => 'Permanent',
        ],
        [
          'id' => 549720216124830,
          'user_id' => $_ENV['SEEDER_USER_ADMIN_ID'], //admin [first user],
          'name' => 'On-Call',
        ],
      ];

      foreach($data as $row) {
        \App\Models\WorkStatus::create($row);
      }
    }
}
