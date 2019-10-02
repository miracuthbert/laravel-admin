<?php

namespace App\Console\Commands\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;

class AssignRoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:assign {email : Valid user email} {slug : Valid role slug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign role to user by email and role slug';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // get input
        $email = $this->argument('email');
        $role = $this->argument('slug');

        // find user
        $user = User::where('email', $email)->first();

        // find role
        $role = Role::where('slug', $role)->where('usable', true)->first();

        if (!$user) {
            $this->error('Whoops! No user with matching email found.');

            return;
        }

        if (!$role) {
            $this->error('Sorry, you cannot assign an invalid role.');

            return;
        }

        // full role name
        $roleName = $role->parent ? $role->name . ' - ' . $role->parent->name : $role->name;

        // role assign confirmation
        if (!$this->confirm("Do you wish to assign `{$roleName}`, role to `{$user->name}`?")) {
            return;
        }

        // stop if role cannot be assigned or exists
        if (!$user->assignRole($role)) {
            $this->info("Failed assigning role.");

            return;
        }

        // success
        $this->info("Role, `{$roleName}` assigned to `{$user->name}`.");
    }
}
