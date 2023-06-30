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
        'id' => 562170298925980667,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'News'
      ],
      [
        'id' => 562170298925980668,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name' => 'Updates',
      ],
    ];

    foreach($data as $row) {
      \App\Models\PostCategory::create($row);
    }
  }
}
