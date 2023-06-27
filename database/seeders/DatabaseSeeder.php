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
        PostCategorySeeder::class,
        PostSeeder::class,
        RoleAndPermissionsSeeder::class,
        CivilStatusSeeder::class,
        WorkStatusSeeder::class,
        EducationLevelSeeder::class,
        SeminarTypeSeeder::class,

        JobStatusSeeder::class,
        JobTypeSeeder::class,
        JobDepartmentSeeder::class,
        JobLocationSeeder::class,
        JobSeeder::class,
        FAQSeeder::class,
        // EligibilitySeeder::class,

        UserSeeder::class,
      ]);
    }
}
