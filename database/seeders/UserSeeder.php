<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create SuperAdmin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@lumago.com',
            'password' => Hash::make('password123'),
            'phone' => '081234567890',
            'role' => 'superadmin',
            'otp_verified' => true,
            'email_verified_at' => now(),
        ]);

        // Create Admin Wisata
        User::create([
            'name' => 'Admin Wisata Tumpak Sewu',
            'email' => 'admin.tumpaksewu@lumago.com',
            'password' => Hash::make('password123'),
            'phone' => '081234567891',
            'role' => 'adminwisata',
            'otp_verified' => true,
            'email_verified_at' => now(),
        ]);

        // Create Sample Visitors
        $visitors = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '081234567892',
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'phone' => '081234567893',
            ],
            [
                'name' => 'Bob Smith',
                'email' => 'bob@example.com',
                'phone' => '081234567894',
            ]
        ];

        foreach ($visitors as $visitor) {
            User::create([
                'name' => $visitor['name'],
                'email' => $visitor['email'],
                'password' => Hash::make('password123'),
                'phone' => $visitor['phone'],
                'role' => 'pengunjung',
                'otp_verified' => true,
                'email_verified_at' => now(),
            ]);
        }
    }
}
