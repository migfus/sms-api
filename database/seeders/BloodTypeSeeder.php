<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodTypeSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        'id' => 549716690333042,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'O+',
      ],
      [
        'id' => 549716690340549,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'O-',
      ],
      [
        'id' => 549716690347712,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'A+',
      ],
      [
        'id' => 549716690357634,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'A-',
      ],
      [
        'id' => 549716690365452,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'B+',
      ],
      [
        'id' => 549716690370736,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'B-',
      ],
      [
        'id' => 549716690379297,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'AB+',
      ],
      [
        'id' => 549716690383368,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'AB-',
      ],
    ];


    foreach($data as $row) {
      \App\Models\BloodType::create($row);
    }
  }
}
