<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'browse admin'],
            ['name' => 'browse users'],
            ['name' => 'view user'],
            ['name' => 'create users'],
            ['name' => 'update users'],
            ['name' => 'delete users'],
            ['name' => 'browse permissions'],
            ['name' => 'view permission'],
            ['name' => 'create permissions'],
            ['name' => 'update permissions'],
            ['name' => 'delete permissions'],
            ['name' => 'browse roles'],
            ['name' => 'view role'],
            ['name' => 'create roles'],
            ['name' => 'update roles'],
            ['name' => 'delete roles'],
            ['name' => 'assign roles'],
        ];

        foreach ($permissions as $permission) {
            \App\Models\Permission::firstOrCreate($permission, ['usable' => true]);
        }
    }
}
