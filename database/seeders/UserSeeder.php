<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Person;
use App\Models\User;

class UserSeeder extends Seeder
{
  public function run(): void {
    $data = [
      [
        'id' => $_ENV['SEEDER_PERSON_STAFF_ID'], //staff [first user],
        'user_id' => $_ENV['SEEDER_PERSON_STAFF_ID'], //staff [first user],
        'last_name' => 'Staff',
        'first_name' => '',
        'mid_name' => '',
        'ext_name' => '',
        'civil_status_id' => \App\Models\CivilStatus::get()->first()->id, // single
        'birth_day' => Carbon::now(),
        'birth_place_id' => DB::table('address_cities')->where('id', 258)->first()->id, // valencia city, bukidnon
        'blood_type_id' => \App\Models\BloodType::get()->first()->id, // O+
        'sex' => 1,
        'height' => 1.6,
        'weight' => 65.1,
        'address_id' => DB::table('address_cities')->where('id', 258)->first()->id, // valencia city, bukidnon
        'address_barangay' => 'Poblacion',
        'address_street' => 'Laviña Ave.',
        'address' => 'P5',
        'gsis_id' => null,
        'pagibig_id' => null,
        'tin_id' => null,
        'philhealth_id' => null,
        'sss_id' => null,
        'agency_id' => null,
      ],
      [
        'id' => $_ENV['SEEDER_PERSON_APPLICANT_ID'], //applicant [first user],
        'user_id' => $_ENV['SEEDER_PERSON_APPLICANT_ID'], //applicant [first user],
        'last_name' => 'Belonio',
        'first_name' => 'Schwarzenegger',
        'mid_name' => 'Reposposa',
        'ext_name' => '',
        'civil_status_id' => \App\Models\CivilStatus::get()->first()->id, // single
        'birth_day' => Carbon::now(),
        'birth_place_id' => DB::table('address_cities')->where('id', 258)->first()->id, // valencia city, bukidnon
        'blood_type_id' => \App\Models\BloodType::get()->first()->id, // O+
        'sex' => 1,
        'height' => 1.6,
        'weight' => 65.1,
        'address_id' => DB::table('address_cities')->where('id', 258)->first()->id, // valencia city, bukidnon
        'address_barangay' => 'Poblacion',
        'address_street' => 'Laviña Ave.',
        'address' => 'P5',
        'gsis_id' => null,
        'pagibig_id' => null,
        'tin_id' => null,
        'philhealth_id' => null,
        'sss_id' => null,
        'agency_id' => null
      ],
    ];

    foreach($data as $row) {
      $info = \App\Models\Info::create($row);
      $this->CreateNumber($info->id);
      $this->CreateExperience($info->id);
      $this->CreateEducation($info->id);
      $this->CreateEligibility($info->id);
      $this->CreateVoluntary($info->id);
      $this->CreateSeminar($info->id);
      $this->CreateSkill($info->id);
      $this->CreateFile($info->id);
    }

    User::create(
      [
        'id' => $_ENV['SEEDER_USER_STAFF_ID'], //staff [first user],
        'email' => 'staff@gmail.com',
        'password'=> Hash::make('12345678'),
        'avatar'   => 'https://static.vecteezy.com/system/resources/thumbnails/002/002/403/small/man-with-beard-avatar-character-isolated-icon-free-vector.jpg',
      ],
    )->assignRole('Staff');
    User::create(
      [
        'id' => $_ENV['SEEDER_USER_APPLICANT_ID'], //applicant [first user],
        'email' => 'applicant@gmail.com',
        'password'=> Hash::make('12345678'),
        'avatar'   => 'https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?w=2000',
      ],
    )->assignRole('Applicant');
  }

  private function CreateNumber($info_id): void {
    \App\Models\MobileNumber::create([
      'info_id' => $info_id,
      'allow_notify' => 1,
      'number' => rand(0, 999999999),
    ]);
  }

  private function CreateExperience($info_id): void {
    $data = [
      [
        'info_id' => $info_id,
        'position' => 'Clerk',
        'company' => 'Central Mindanao University',
        'work_status_id' => \App\Models\WorkStatus::get()->first()->id, // Job Order
        'salary' => 11000,
        'salary_type_id' => 2,
        // [1] hourly, [2] daily, [3] monthly
        'is_government' => 1,
        'from' => '2018-10-28',
        'to' => null,
      ],
      [
        'info_id' => $info_id,
        'position' => 'OJT',
        'company' => 'Central Mindanao University',
        'work_status_id' => \App\Models\WorkStatus::get()->skip(2)->first()->id, // On Call
        'salary' => 5000,
        'salary_type_id' => 3,
        // [1] hourly, [2] daily, [3] monthly
        'is_government' => 1,
        'from' => '2018-06-01',
        'to' => '2018-10-27',
      ],
    ];

    foreach($data as $row) {
      \App\Models\Experience::create($row);
    }
  }

  private function CreateEducation($info_id): void {
    $data = [
      [
        'info_id' => $info_id,
        'level' => \App\Models\EducationLevel::get()->first()->id, // primary
        'school' => 'Valencia City Central School',
        'degree' => null,
        'scholarship' => null,
        'honors' => null,
        'from' => '2006-01-01',
        'to' => '2010-01-01',
      ],
      [
        'info_id' => $info_id,
        'level' => \App\Models\EducationLevel::get()->skip(1)->first()->id, // secondary
        'school' => 'Irene B. Antonio',
        'degree' => null,
        'scholarship' => null,
        'honors' => null,
        'from' => '2010-01-01',
        'to' => '2014-01-01',
      ],
      [
        'info_id' => $info_id,
        'level' => \App\Models\EducationLevel::get()->skip(2)->first()->id, // tertiary
        'school' => 'Central Mindanao University',
        'degree' => 'Bachelor of Information Technology',
        'scholarship' => null,
        'honors' => null,
        'from' => '2014-05-06',
        'to' => '2018-06-06',
      ],
    ];

    foreach($data as $row) {
      \App\Models\Education::create($row);
    }
  }

  private function CreateEligibility($info_id): void {
    $data = [
      [
        'info_id' => $info_id,
        'name' => 'EDPSE Eligibility',
        'address_id' => DB::table('address_cities')->where('id', 258)->first()->id, // valencia city, bukidnon
        'rating' => 84.5,
        'exam_date' => '2020-02-02',
        'validity_date' => '2025-02-05',
        'number' => '32169-022-6577',
      ]
    ];

    foreach($data as $row) {
      \App\Models\Eligibility::create($row);
    }
  }

  private function CreateVoluntary($info_id): void {
    $data = [
      [
        'info_id' => $info_id,
        'hours' => 2,
        'position' => 'Support',
        'name' => 'Voluntary Involvement',
        'from' => '2022-02-02',
        'to' => '2022-02-02',
      ],
    ];

    foreach($data as $row) {
      \App\Models\Voluntary::create($row);
    }
  }

  private function CreateSeminar($info_id): void {
    $data = [
      [
        'info_id' => $info_id,
        'seminar_type_id' => \App\Models\SeminarType::get()->first()->id, // managerial
        'name' => 'Seminar 1',
        'hours' => 2,
        'sponsor' => 'SponsorMan',
        'from' => '2022-02-02',
        'to' => '2022-02-02',
      ]
    ];

    foreach($data as $row) {
      \App\Models\Seminar::create($row);
    }
  }

  private function CreateSkill($info_id): void {
    $data = [
      [
        'info_id' => $info_id,
        'name' => 'Singing Shit',
        'recognition' => 'tapalado',
      ]
    ];

    foreach ($data as $row) {
      \App\Models\Skill::create($row);
    }
  }

  private function CreateFile($info_id): void {
    $data = [
      [
        'info_id' => $info_id,
        'filename' => 'Document1.docx',
        'url' => 'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg',
        'size' => 123,
      ],
      [
        'info_id' => $info_id,
        'filename' => 'ExcelProject.xlsx',
        'url' => 'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg',
        'size' => 456,
      ],
    ];

    foreach($data  as $row) {
      \App\Models\File::create($row);
    }
  }

}
