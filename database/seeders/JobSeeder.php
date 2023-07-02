<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        'id' => 549718390787165,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'job_location_id' => \App\Models\JobLocation::where('id', 549718062930975)->first()->id, // CMU,
        'job_type_id' => \App\Models\JobType::where('id', 549718712245638)->first()->id, // faculty
        'job_status_id' => \App\Models\JobStatus::where('id', 549718506430213)->first()->id, // Job Order
        'job_department_id' => \App\Models\JobDepartment::where('id', 549717969211197)->first()->id, // College of Nursing
        'title' => 'Administrative Aide III',
        'requirements' => 'Requirements are idk',
        'responsibilities' => 'my responsibilities are you know',
        'qualifications' => 'qualifications are',
        'description' => 'description is considering omehtm',
        'posted_at' => '2023-06-22',
        'unposted_at' => '2023-06-25',
      ],
      [
        'id' => 549718390797331,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'job_location_id' => \App\Models\JobLocation::where('id', 549718062943377)->first()->id, // CSC, Malaybalay,
        'job_type_id' => \App\Models\JobType::where('id', 549718712254629)->first()->id, // staff
        'job_status_id' => \App\Models\JobStatus::where('id', 549718506460392)->first()->id, // Permanent idk
        'job_department_id' => \App\Models\JobDepartment::where('id', 549717969218065)->first()->id, // College of Engineering
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
