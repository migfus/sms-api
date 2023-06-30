<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
  public function run(): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => $_ENV['SEEDER_PERSON_ID'], //admin [first user],
        'last_name' => '[Last]',
        'first_name' => '[First]',
        'mid_name' => '[mid]',
        'ext_name' => 'Jr',
        'civil_status_id' => \App\Models\CivilStatus::get()->first()->id, // single
        'birth_day' => Carbon::now(),
        'birth_place_id' => DB::table('address_cities')->where('id', 258)->first()->id, // valencia city, bukidnon
        'blood_type_id' => \App\Models\BloodType::get()->first()->id, // O+
        'sex' => 1,
        'height' => 1.6,
        'weight' => 65.1,
        'address_id' => DB::table('address_cities')->where('id', 258)->first()->id, // valencia city, bukidnon
        'address' => 'Bonifacion Street, Poblacion',
        'gsis_id' => 'GSIS - 12305349045',
        'pagibig_id' => 'pagibig - 12305349045',
        'tin_id' => 'tin',
      ]
    ];

    foreach($data as $row) {
      $person = \App\Models\Person::create($row);
      $this->CreateNumber($person->id);
      $this->CreateExperience($person->id);
      $this->CreateEducation($person->id);
      $this->CreateEligibility($person->id);
      $this->CreateVoluntary($person->id);
      $this->CreateSeminar($person->id);
      $this->CreateSkill($person->id);
      $this->CreateFile($person->id);
    }

    $data = [
      [
        'id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'person_id' => \App\Models\Person::where('id', 562170298468802382)->first()->id,
        'email' => 'admin@gmail.com',
        'password'=> Hash::make('12345678'),
        'avatar'   => 'https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80',
      ],
    ];


    foreach($data as $row) {
      \App\Models\User::create($row);
    }
  }

  private function CreateNumber($personID): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    \App\Models\MobileNumber::create([
      'id' => 562170298493967036,
      'person_id' => $personID,
      'allow_notify' => 1,
      'number' => rand(0, 999999999),
    ]);
  }

  private function CreateExperience($personID): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => 562170298506547577,
        'person_id' => $personID,
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
        'id' => 562170298510743384,
        'person_id' => $personID,
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

  private function CreateEducation($personID): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => 562170298535908295,
        'person_id' => $personID,
        'level' => \App\Models\EducationLevel::get()->first()->id, // primary
        'school' => 'Valencia City Central School',
        'degree' => null,
        'scholarship' => null,
        'honors' => null,
        'from' => '2006-01-01',
        'to' => '2010-01-01',
      ],
      [
        'id' => 562170298548491374,
        'person_id' => $personID,
        'level' => \App\Models\EducationLevel::get()->skip(1)->first()->id, // secondary
        'school' => 'Irene B. Antonio',
        'degree' => null,
        'scholarship' => null,
        'honors' => null,
        'from' => '2010-01-01',
        'to' => '2014-01-01',
      ],
      [
        'id' => 562170298552686089,
        'person_id' => $personID,
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

  private function CreateEligibility($personID): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => 562170298582048044,
        'person_id' => $personID,
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

  private function CreateVoluntary($personID): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => 562170298594629059,
        'person_id' => $personID,
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

  private function CreateSeminar($personID): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => 562170298607211811,
        'person_id' => $personID,
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

  private function CreateSkill($personID): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => 562170298623990408,
        'person_id' => $personID,
        'name' => 'Singing Shit',
        'recognition' => 'tapalado',
      ]
    ];

    foreach ($data as $row) {
      \App\Models\Skill::create($row);
    }
  }

  private function CreateFile($personID): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => 562170298632378820,
        'person_id' => $personID,
        'filename' => 'Document1.docx',
        'url' => 'http://somehting.com'
      ],
      [
        'id' => 562170298632378821,
        'person_id' => $personID,
        'filename' => 'ExcelProject.xlsx',
        'url' => 'http://excelinhere.com'
      ],
    ];

    foreach($data  as $row) {
      \App\Models\File::create($row);
    }
  }

}
