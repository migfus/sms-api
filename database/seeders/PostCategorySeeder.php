<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
  public function run(): void{
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name' => 'News'
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'name' => 'Updates',
      ],
    ];

    foreach($data as $row) {
      \App\Models\PostCategory::create($row);
    }
  }
}
