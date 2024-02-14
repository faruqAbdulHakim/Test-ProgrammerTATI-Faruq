<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_id_kepala_dinas = DB::table('roles')
            ->where('role_name', 'Kepala Dinas')
            ->value('id');

        $role_id_kepala_bidang = DB::table('roles')
            ->where('role_name', 'Kepala Bidang')
            ->value('id');

        $role_id_staff = DB::table('roles')
            ->where('role_name', 'Staff')
            ->value('id');

        if (
            $role_id_kepala_dinas == null
            or $role_id_kepala_bidang == null
            or $role_id_staff == null
        ) {
            throw new Exception('Roles id not found');
        }

        $user_id_kepala_dinas = DB::table('users')->insertGetId(
            [
                'name' => 'kepala dinas',
                'email' => 'kepaladinas@gmail.com',
                'password' => Hash::make('123'),
            ],
        );
        $user_id_kepala_bidang_1 = DB::table('users')->insertGetId(
            [
                'name' => 'kepala bidang 1',
                'email' => 'kepalabidang1@gmail.com',
                'password' => Hash::make('123'),
                'superior_id' => $user_id_kepala_dinas,
            ],
        );
        $user_id_kepala_bidang_2 = DB::table('users')->insertGetId(
            [
                'name' => 'kepala bidang 2',
                'email' => 'kepalabidang2@gmail.com',
                'password' => Hash::make('123'),
                'superior_id' => $user_id_kepala_dinas,
            ],
        );

        DB::table('users')->insertGetId(
            [
                'name' => 'staff 1',
                'email' => 'staff1@gmail.com',
                'password' => Hash::make('123'),
                'superior_id' => $user_id_kepala_bidang_1,
            ],
        );

        DB::table('users')->insertGetId(
            [
                'name' => 'staff 2',
                'email' => 'staff2@gmail.com',
                'password' => Hash::make('123'),
                'superior_id' => $user_id_kepala_bidang_2,
            ],
        );
    }
}
