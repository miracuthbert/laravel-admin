<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
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
                'name' => 'Admin',
                'children' => [
                    [
                        'name' => 'Root',
                    ]
                ]
            ]
        ];

        foreach ($roles as $role) {
            \App\Models\Role::create($role);
        }

        $root = \App\Models\Role::query()
            ->whereHas('parent', function ($query) {
                $query->where('name', 'Admin');
            })->where('name', 'Root')
            ->first();


        if ($root) {
            // add permissions to role
            $ids = \App\Models\Permission::get(['id']);

            $root->addPermissions($ids->pluck('id')->all());
        }
    }
}
