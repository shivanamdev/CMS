<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // create roles if not exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);

        // create admin user
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Super Admin', 'password' => Hash::make('password')]
        );

        if (! $user->hasRole('admin')) {
            $user->assignRole($adminRole);
        }
    }
}
