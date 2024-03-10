<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->ask('Enter email for the admin user:');
        $password = $this->secret('Enter password for the admin user:');

        // Create the user
        $user = User::create([
            'name' => 'Admin',
            'email' => $email,
            'password' => bcrypt($password),
            'role'=>'admin',
        ]);

        $this->info('Admin user created successfully!');
    }
}
