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
        'id' => $snowflake->next(),
        'user_id' => 1,
        'title' => 'Administrative Aide III',
        'posted_at' => '2023-06-22',
        'unposted_at' => '2023-06-25',
        'job_location_id' => \App\Models\JobLocation::get()->first()->id, // CMU,
        'job_type_id' => \App\Models\JobType::get()->first()->id, // faculty
        'job_status_id' => \App\Models\JobStatus::get()->first()->id, // Job Order
        'job_department_id' => \App\Models\JobDepartment::get()->first()->id, // College of Nursing
        'requirements' => 'Requirements are idk',
        'responsibilities' => 'my responsibilities are you know',
        'qualifications' => 'qualifications are',
        'description' => 'description is considering omehtm'
      ],
      [
        'id' => $snowflake->next(),
        'user_id' => 1,
        'title' => 'Clerical Aide III',
        'posted_at' => '2023-06-22',
        'unposted_at' => '2023-06-25',
        'job_location_id' => \App\Models\JobLocation::get()->skip(1)->first()->id, // CSC, Malaybalay,
        'job_type_id' => \App\Models\JobType::get()->skip(1)->first()->id, // staff
        'job_status_id' => \App\Models\JobStatus::get()->skip(1)->first()->id, // Permanent idk
        'job_department_id' => \App\Models\JobDepartment::get()->skip(1)->first()->id, // College of Engineering
        'requirements' => 'Requirements are idk',
        'responsibilities' => 'my responsibilities are you know',
        'qualifications' => 'qualifications are',
        'description' => 'description is considering omehtm'
      ],
    ];

    foreach($data as $row) {
      \App\Models\Job::create($row);
    }
  }
}
