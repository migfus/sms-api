<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTypeSeeder extends Seeder
{
  public function run(): void {
    $data = [
      ['name' => 'Faculty'],
      ['name' => 'Staff'],
      ['name' => 'Research'],
    ];

    foreach($data as $row) {
      \App\Models\JobType::create($row);
    }
  }
}
