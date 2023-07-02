<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeminarTypeSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        'id' => 549719216912249,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'Managerial'
      ],
      [
        'id' => 549719216924775,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'Supervisory'
      ],
      [
        'id' => 549719216936296,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'Technical'
      ],
    ];

    foreach($data as $row) {
      \App\Models\SeminarType::create($row);
    }
  }
}
