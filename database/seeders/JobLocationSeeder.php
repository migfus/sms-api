<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobLocationSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        'user_id' => 1,
        'name' => 'CMU',
      ],
      [
        'user_id' => 1,
        'name' => 'CSC, Malaybalay',
      ],
    ];

    foreach($data as $row) {
      \App\Models\JobLocation::create($row);
    }
  }
}
