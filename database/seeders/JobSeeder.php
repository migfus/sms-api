<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
  public function run(): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => 562170298288444730,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'job_location_id' => \App\Models\JobLocation::where('id', 562170298246501053)->first()->id, // CMU,
        'job_type_id' => \App\Models\JobType::where('id', 562170298171006199)->first()->id, // faculty
        'job_status_id' => \App\Models\JobStatus::where('id', 562170298120672848)->first()->id, // Job Order
        'job_department_id' => \App\Models\JobDepartment::where('id', 562170298208755294)->first()->id, // College of Nursing
        'title' => 'Administrative Aide III',
        'requirements' => 'Requirements are idk',
        'responsibilities' => 'my responsibilities are you know',
        'qualifications' => 'qualifications are',
        'description' => 'description is considering omehtm',
        'posted_at' => '2023-06-22',
        'unposted_at' => '2023-06-25',
      ],
      [
        'id' => 562170298301028637,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'job_location_id' => \App\Models\JobLocation::where('id', 562170298246501054)->first()->id, // CSC, Malaybalay,
        'job_type_id' => \App\Models\JobType::where('id', 562170298171006200)->first()->id, // staff
        'job_status_id' => \App\Models\JobStatus::where('id', 562170298120672851)->first()->id, // Permanent idk
        'job_department_id' => \App\Models\JobDepartment::where('id', 562170298208755295)->first()->id, // College of Engineering
        'title' => 'Clerical Aide III',
        'requirements' => 'Requirements are idk',
        'responsibilities' => 'my responsibilities are you know',
        'qualifications' => 'qualifications are',
        'description' => 'description is considering omehtm',
        'posted_at' => '2023-06-22',
        'unposted_at' => '2023-06-25'
      ],
    ];

    foreach($data as $row) {
      \App\Models\Job::create($row);
    }
  }
}
