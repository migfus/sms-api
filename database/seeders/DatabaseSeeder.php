<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
      $this->call([
        AddressSQL::class,

        BloodTypeSeeder::class,
        RoleAndPermissionsSeeder::class,
        CivilStatusSeeder::class,
        WorkStatusSeeder::class,
        EducationLevelSeeder::class,
        SeminarTypeSeeder::class,
        SalaryTypeSeeder::class,

        JobStatusSeeder::class,
        JobTypeSeeder::class,
        JobDepartmentSeeder::class,
        JobLocationSeeder::class,
        JobSeeder::class,
        FAQSeeder::class,
        EventCategorySeeder::class,
        EventSeeder::class,
        // EligibilitySeeder::class,

        UserSeeder::class,

        PostCategorySeeder::class,
        PostSeeder::class,
      ]);
    }
}
