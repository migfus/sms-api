<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        'user_id' => 1,
        'title' => 'Administrative Aide III',
        'posted_at' => '2023-06-22',
        'unposted_at' => '2023-06-25',
        'job_location_id' => \App\Models\JobLocation::where('id', 1)->first()->id, // CMU,
        'job_type_id' => \App\Models\JobType::where('id', 1)->first()->id, // faculty
        'job_status_id' => \App\Models\JobStatus::where('id', 1)->first()->id, // Job Order
        'job_department_id' => \App\Models\JobDepartment::where('id', 1)->first()->id, // College of Nursing
        'requirements' => 'Requirements are idk',
        'responsibilities' => 'my responsibilities are you know',
        'qualifications' => 'qualifications are',
        'description' => 'description is considering omehtm'
      ],
      [
        'user_id' => 1,
        'title' => 'Clerical Aide III',
        'posted_at' => '2023-06-22',
        'unposted_at' => '2023-06-25',
        'job_location_id' => \App\Models\JobLocation::where('id', 2)->first()->id, // CSC, Malaybalay,
        'job_type_id' => \App\Models\JobType::where('id', 2)->first()->id, // staff
        'job_status_id' => \App\Models\JobStatus::where('id', 2)->first()->id, // Permanent idk
        'job_department_id' => \App\Models\JobDepartment::where('id', 2)->first()->id, // College of Engineering
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
