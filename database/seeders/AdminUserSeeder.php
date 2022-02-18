<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
           $user= User::create([
                'first_name' => 'mahdiye',
                'last_name' => 'moosaei',
                'mobile' => '09132908191',
                'password' => Hash::make('11223344'),
                'verification' => 1,
                'user_name' => 'mahdiye',

              ]);
              $user ->roles()->attach(3);
        });

    }
}
