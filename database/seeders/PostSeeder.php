<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
  public function run(): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => $snowflake->next(),
        'user_id' => \App\Models\User::get()->first()->id,
        'post_category_id' => \App\Models\PostCategory::get()->first()->id,
        'active' => 1,
        'title'   => 'Lorem Ipsum',
        'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto accusantium praesentium eius, ut atque fuga culpa, similique sequi cum eos quis dolorum.',
        'cover'   => 'https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80',
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => \App\Models\User::get()->first()->id,
        'post_category_id' => \App\Models\PostCategory::get()->skip(1)->first()->id,
        'active' => 1,
        'title'   => 'Lorem Ipsum',
        'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto accusantium praesentium eius, ut atque fuga culpa, similique sequi cum eos quis dolorum.',
        'cover'   => 'https://images.unsplash.com/photo-1547586696-ea22b4d4235d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80',
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => \App\Models\User::get()->first()->id,
        'post_category_id' => \App\Models\PostCategory::get()->first()->id,
        'active' => 1,
        'title'   => 'Lorem Ipsum',
        'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto accusantium praesentium eius, ut atque fuga culpa, similique sequi cum eos quis dolorum.',
        'cover'   => 'https://images.unsplash.com/photo-1492724441997-5dc865305da7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80',
      ]
    ];


    foreach($data as $row) {
      \App\Models\Post::create($row);
    }
  }
}
