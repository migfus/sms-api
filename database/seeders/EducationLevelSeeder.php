<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationLevelSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        'id' => 549717181106559,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'Primary',
      ],
      [
        'id' => 549717181120481,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'Secondary',
      ],
      [
        'id' => 549717181124844,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'Vocational',
      ],
      [
        'id' => 549717181133505,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'College',
      ],
      [
        'id' => 549717181143755,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'Masteral',
      ],
      [
        'id' => 549717181150779,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'Doctoral',
      ],
    ];

    foreach($data as $row) {
      \App\Models\EducationLevel::create($row);
    }
  }
}
