<?php

namespace Database\Seeders;

use App\Models\Role as ModelsRole;
use Illuminate\Database\Seeder;

class role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

           $roles = [
            [
              'name' => 'خدمت دهنده',
              'status' => 1,

            ],
            [
                'name' => 'خدمت گیرنده',
                'status' => 1,
            ],
             [
                'name' => 'admin',
                'status' => 1,
            ]
          ];

          foreach($roles as $role)
          {

            ModelsRole::create([
               'name' => $role['name'],
               'status' => $role['status'],
             ]);
           }
    }
}
