<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleExample extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles') ->insert([
            ['name'  =>'admin'],
            ['name'  =>'supervisor'],
            ['name'  =>'teacher'],
            ['name'  =>'student'],
        ]);

        DB::table('users') ->insert([
            'email'  =>'bmvt@hcmut.edu.vn',
            'name' => 'BMVT',
            'password' =>  Hash::make('Bmvt@hcmut'),
            'role_id' => 1 ]);
    }
}
