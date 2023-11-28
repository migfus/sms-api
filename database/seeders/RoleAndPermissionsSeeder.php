<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionsSeeder extends Seeder
{
  public function run(): void {
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    // NOTE USERS
    // Permission::create(['name' => 'index user']);
    // Permission::create(['name' => 'store user']);
    // Permission::create(['name' => 'update user']);
    // Permission::create(['name' => 'destroy user']);

    // NOTE POSTS
    // Permission::create(['name' => 'index post']);
    // Permission::create(['name' => 'store post']);
    // Permission::create(['name' => 'update post']);
    // Permission::create(['name' => 'destroy post']);

    // NOTE FAQS
    // Permission::create(['name' => 'index faq']);
    // Permission::create(['name' => 'store faq']);
    // Permission::create(['name' => 'update faq']);
    // Permission::create(['name' => 'destroy faq']);

    // NOTE EVENTS/CALENDAR
    // Permission::create(['name' => 'index event']);
    // Permission::create(['name' => 'store event']);
    // Permission::create(['name' => 'update event']);
    // Permission::create(['name' => 'destroy event']);

    // NOTE PERSON
    // Permission::create(['name' => 'index person']);
    // Permission::create(['name' => 'store person']);
    // Permission::create(['name' => 'update person']);
    // Permission::create(['name' => 'destroy person']);

    // NOTE DASHBOARD
    // Permission::create(['name' => 'index dashboard']);
    // Permission::create(['name' => 'store dashboard']);
    // Permission::create(['name' => 'update dashboard']);
    // Permission::create(['name' => 'destroy dashboard']);

    // NOTE PROFILE
    Permission::create(['name' => 'index profile']);
    Permission::create(['name' => 'update profile']);

    $role = Role::create(['name' => 'Staff']);
    $role->givePermissionTo([
      // 'index user',     'store user',     'update user',
      // 'index post',     'store post',     'update post',
      // 'index faq',      'store faq',      'update faq',
      // 'index event',    'store event',    'update event',
      // 'index person',   'store person',   'update person',
      // 'index dashboard','store dashboard','update dashboard','destroy dashboard',
      'index profile', 'update profile'
    ]);

    $role = Role::create(['name' => 'Applicant']);
    $role->givePermissionTo([
      // 'index dashboard','store dashboard','update dashboard','destroy dashboard',
      'index profile', 'update profile'
    ]);
  }
}
