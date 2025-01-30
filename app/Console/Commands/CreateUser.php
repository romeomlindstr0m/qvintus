<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

use App\Models\User;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user {name} {email} {password} {role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user with the defined name, email, password and role';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = Hash::make($this->argument('password'));
        $role = $this->argument('role');

        $user_role = Role::where('name', $role)->firstOr(function () {
            $this->fail('The given role does not exit. Use "php artisan app:setup-roles" to ensure all required roles are set up');
        });

        $existing_user = User::where('name', $name)->where('email', $email)->first();

        if ($existing_user) {
            $this->fail('The user already exists');
        }

        $user = new User;

        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->role_id = $user_role->id;

        $user->save();
        $this->info('User has been successfully created');
    }
}
