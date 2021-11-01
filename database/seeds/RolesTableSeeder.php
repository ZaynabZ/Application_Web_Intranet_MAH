<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        $roles = [

            [
                'name' => 'SuperAdmin',
            ],
            [
                'name' => 'Admin',
            ],
            [
                'name' => 'Supervisor',
            ],
            [
                'name' => 'Agent',
            ],
        ];

        Role::insert($roles);
    }
}
