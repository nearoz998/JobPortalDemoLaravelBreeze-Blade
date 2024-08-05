<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $roles = [
            [
                'name' => 'Admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Company',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'User',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
        }

        $users = [
            [
                'name' => 'Admin Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                'role_id' => Role::where('name', 'Admin')->value('id')
            ],
            [
                'name' => 'User',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'role_id' => Role::where('name', 'Company')->value('id')
            ]
        ];
        
        foreach ($users as $user) {
            User::factory()->create($user);
        }

        // User::factory()->create([
        //     'name' => 'Admin Admin',
        //     'email' => 'admin@admin.com',
        // ]);
    }
}
