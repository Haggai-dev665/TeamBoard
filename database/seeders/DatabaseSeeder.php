<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employee;
use App\Models\Notice;
use App\Models\Document;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@teamboard.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create regular users
        $users = [
            User::create([
                'name' => 'Sample User',
                'email' => 'john@teamboard.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]),
            User::create([
                'name' => 'Jane Smith',
                'email' => 'jane@teamboard.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]),
            User::create([
                'name' => 'Bob Johnson',
                'email' => 'bob@teamboard.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]),
        ];

        // Create employees
        $departments = ['Engineering', 'Marketing', 'Sales', 'Human Resources', 'Finance', 'Operations'];
        $employeeNames = [
            'Alice Williams', 'Charlie Brown', 'Diana Prince', 'Edward Norton',
            'Fiona Apple', 'George Martin', 'Helen Troy', 'Ivan Petrov',
            'Julia Roberts', 'Kevin Hart', 'Laura Palmer', 'Michael Scott',
            'Nina Simone', 'Oscar Wilde', 'Patricia Moore', 'Quincy Jones',
            'Rachel Green', 'Steve Jobs', 'Tina Turner', 'Uma Thurman'
        ];

        foreach ($employeeNames as $index => $name) {
            Employee::create([
                'name' => $name,
                'email' => strtolower(str_replace(' ', '.', $name)) . '@company.com',
                'department' => $departments[array_rand($departments)],
                'phone' => '+1 (555) ' . str_pad($index + 1000, 4, '0', STR_PAD_LEFT),
                'bio' => 'Experienced professional with expertise in ' . $departments[array_rand($departments)] . '. Passionate about innovation and team collaboration.',
            ]);
        }

        // Create notices
        $noticeTitles = [
            ['title' => 'Company Holiday Schedule', 'priority' => 'high'],
            ['title' => 'New Office Opening', 'priority' => 'medium'],
            ['title' => 'Team Building Event Next Month', 'priority' => 'low'],
            ['title' => 'System Maintenance This Weekend', 'priority' => 'high'],
            ['title' => 'Updated Security Policies', 'priority' => 'high'],
            ['title' => 'Quarterly All-Hands Meeting', 'priority' => 'medium'],
            ['title' => 'New Parking Procedures', 'priority' => 'low'],
            ['title' => 'Health Insurance Enrollment', 'priority' => 'medium'],
        ];

        foreach ($noticeTitles as $noticeData) {
            Notice::create([
                'title' => $noticeData['title'],
                'content' => 'This is an important notice regarding ' . strtolower($noticeData['title']) . '. Please review the details carefully and contact HR if you have any questions. This notice will remain in effect until further communication.',
                'author_id' => $users[array_rand($users)]->id,
                'priority' => $noticeData['priority'],
            ]);
        }

        // Create sample documents
        $documentTitles = [
            'Employee Handbook 2025',
            'Quarterly Report Q4 2024',
            'Company Policies and Procedures',
            'IT Security Guidelines',
            'Vacation Request Form',
            'Benefits Overview 2025',
            'Remote Work Policy',
            'Expense Report Template',
        ];

        foreach ($documentTitles as $title) {
            Document::create([
                'title' => $title,
                'filename' => strtolower(str_replace(' ', '_', $title)) . '.pdf',
                'filepath' => 'documents/sample.pdf',
                'uploader_id' => $users[array_rand($users)]->id,
            ]);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin credentials: admin@teamboard.com / password');
        $this->command->info('User credentials: john@teamboard.com / password');
    }
}
