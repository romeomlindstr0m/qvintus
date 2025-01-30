<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SetupRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ensure that specific roles exist in the database, creating them if necessary.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $required_roles = [
            'Administrator', 'Editor'
        ];

        $roles = DB::table('roles')
            ->whereIn('name', $required_roles)
            ->get();

        if (count($roles) === count($required_roles)) {
            $this->warn('All required roles already exist');
            return 0;
        }

        foreach ($required_roles as $role) {
            DB::table('roles')->insert([
                'name' => $role
            ]);
        }

        $this->info('All required roles set successfully');
    }
}
