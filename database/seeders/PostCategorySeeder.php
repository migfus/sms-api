<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
  public function run(): void{
    $data = [
      [
        'user_id' => 1,
        'name' => 'News'
      ],
      [
        'user_id' => 1,
        'name' => 'Updates',
      ],
    ];

    foreach($data as $row) {
      \App\Models\PostCategory::create($row);
    }
  }
}
