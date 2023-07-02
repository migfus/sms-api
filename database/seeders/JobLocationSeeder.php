<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobLocationSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        'id' => 549718062930975,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'CMU',
      ],
      [
        'id' => 549718062943377,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'CSC, Malaybalay',
      ],
    ];

    foreach($data as $row) {
      \App\Models\JobLocation::create($row);
    }
  }
}
