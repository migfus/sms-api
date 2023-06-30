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
        'id' => 562170298955338553,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'post_category_id' => \App\Models\PostCategory::where('id', 562170298925980667)->first()->id, //news
        'active' => 1,
        'title'   => 'Lorem Ipsum',
        'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto accusantium praesentium eius, ut atque fuga culpa, similique sequi cum eos quis dolorum.',
        'cover'   => 'https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80',
      ],
      [
        'id' => 562170298959533050,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'post_category_id' => \App\Models\PostCategory::where('id', 562170298925980668)->first()->id, // updates
        'active' => 1,
        'title'   => 'Lorem Ipsum',
        'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto accusantium praesentium eius, ut atque fuga culpa, similique sequi cum eos quis dolorum.',
        'cover'   => 'https://images.unsplash.com/photo-1547586696-ea22b4d4235d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80',
      ],
      [
        'id' => 562170298963728480,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'post_category_id' => \App\Models\PostCategory::where('id', 562170298925980667)->first()->id, //news
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
