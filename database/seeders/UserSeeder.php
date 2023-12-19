<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

use App\Models\User;

class UserSeeder extends Seeder
{
  public function run(): void {
    User::create(
      [
        'id' => Str::uuid()->toString(),
        'email' => 'staff@gmail.com',
        'password'=> Hash::make('12345678'),
        'avatar'   => 'https://static.vecteezy.com/system/resources/thumbnails/002/002/403/small/man-with-beard-avatar-character-isolated-icon-free-vector.jpg',
      ],
    )->assignRole('Admin');
  }
}
