<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'class-list',
            'class-create',
            'class-edit',
            'class-delete',
            'section-list',
            'section-create',
            'section-edit',
            'section-delete',
            'student-list',
            'student-create',
            'student-edit',
            'student-delete',
            'vachicle-list',
            'vachicle-create',
            'vachicle-edit',
            'vachicle-delete',
            'route-list',
            'route-create',
            'route-edit',
            'route-delete',
            'route_detail-list',
            'route_detail-create',
            'route_detail-edit',
            'route_detail-delete',
            'stop-list',
            'stop-create',
            'stop-edit',
            'stop-delete',
            'schedule-list',
            'schedule-create',
            'schedule-edit',
            'schedule-delete',
            'schedule-search',
        ];

        foreach ($data as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}