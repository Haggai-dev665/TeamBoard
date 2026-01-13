<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = config('app.super_admin_email');
        $password = env('SUPER_ADMIN_PASSWORD', 'SuperAdmin123!');

        if (!$email) {
            $this->command->error('SUPER_ADMIN_EMAIL not set in .env file');
            return;
        }

        // Check if super admin already exists
        if (User::where('email', $email)->exists()) {
            $this->command->info('Super admin already exists');
            return;
        }

        User::create([
            'name' => 'Super Admin',
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $this->command->info('Super admin created successfully!');
        $this->command->info('Email: ' . $email);
        $this->command->info('Password: ' . $password);
    }
}
