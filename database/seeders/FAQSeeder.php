<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        // 'id' => 549717769433411,
        'answer_user_id' => $_ENV['SEEDER_USER_STAFF_ID'], //admin [first user],
        'approved_user_id' => $_ENV['SEEDER_USER_STAFF_ID'], //admin [first user],
        'question' => 'Can I use this website to generate only PDS?',
        'answer' => 'Yes, you can use this feature, it is available to everyone.',
        'points' => 100,
      ],
      [
        // 'id' => 549717769449759,
        'answer_user_id' => $_ENV['SEEDER_USER_STAFF_ID'], //admin [first user],
        'approved_user_id' => $_ENV['SEEDER_USER_STAFF_ID'], //admin [first user],
        'question' => 'If I registered, but not applied to any job, are my data being used by the staff?',
        'answer' => 'No, we only gather your data if you applied to a job.',
        'points' => 102,
      ],
      [
        // 'id' => 549717769466666,
        'answer_user_id' => $_ENV['SEEDER_USER_STAFF_ID'], //admin [first user],
        'approved_user_id' => $_ENV['SEEDER_USER_STAFF_ID'], //admin [first user],
        'question' => 'How to get the result the application ASAP?',
        'answer' => "Our staff will notify the status of application ASAP thru SMS and email",
        'points' => 103,
      ],
      [
        // 'id' => 549717769479859,
        'answer_user_id' => $_ENV['SEEDER_USER_STAFF_ID'], //admin [first user],
        'approved_user_id' => $_ENV['SEEDER_USER_STAFF_ID'], //admin [first user],
        'question' => 'Can I delete my account?',
        'answer' => "No, you cannot delete manually your account due to record puroses.",
        'points' => 104,
      ],
    ];

    foreach($data as $row) {
      \App\Models\FAQ::create($row);
    }
  }
}
