<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')
            ->insert(['role_name' => 'Kepala Dinas']);

        DB::table('roles')
            ->insert(['role_name' => 'Kepala Bidang']);

        DB::table('roles')
            ->insert(['role_name' => 'Staff']);
    }
}
