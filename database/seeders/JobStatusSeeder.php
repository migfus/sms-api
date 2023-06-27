<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobStatusSeeder extends Seeder
{
  public function run(): void {
    $data = [
      ['name' => 'Job Order'],
      ['name' => 'Contractual'],
      ['name' => 'Temporary'],
      ['name' => 'Permanent'],
    ];

    foreach($data as $row) {
      \App\Models\JobStatus::create($row);
    }
  }
}
