<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::findOrCreate('super_admin');
        $mentor = Role::findOrCreate('mentor');
        $student = Role::findOrCreate('student');

        // $mentor->givePermissionTo([
        //     // Kursus
        //     'view_any_kursus',
        //     'view_kursus',
        //     'create_kursus',
        //     'update_kursus',
        //     'delete_kursus',
        //     'delete_any_kursus',
        //     'force_delete_kursus',
        //     'force_delete_any_kursus',
        //     'restore_kursus',
        //     'restore_any_kursus',
        //     'replicate_kursus',
        //     'reorder_kursus',

        //     // Transaksi
        //     'view_any_transaksi',
        //     'view_transaksi',
        // ]);
    }
}
