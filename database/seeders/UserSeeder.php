<?php

namespace Database\Seeders;

use App\Models\Role;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void {
        $roles = [
            [
                'name' => 'Admin',
                'slug' => 'admin',
            ],
            [
                'name' => 'Editor',
                'slug' => 'editor',
            ],
            [
                'name' => 'User',
                'slug' => 'user',
            ],
        ];

        Role::insert($roles);

        $users = [
            [
                'first_name' => fake()->name(),
                'email' => 'admin@example.com',
                'phone' => fake()->phoneNumber(),
                'birthday' => fake()->date(),
                'address' => fake()->address(),
            ],
            [
                'email' => 'editor@example.com',
                'phone' => fake()->phoneNumber(),
                'birthday' => fake()->date(),
                'address' => fake()->address(),
            ],
            [
                'email' => 'user@example.com',
                'phone' => fake()->phoneNumber(),
                'birthday' => fake()->date(),
                'address' => fake()->address(),
            ],
        ];

        foreach ($users as $userItem) {
            $userItem['password'] = '1234567@';
            $user = Sentinel::registerAndActivate($userItem);
            switch ($userItem['email']) {
                case 'admin@example.com':
                    $role = Sentinel::findRoleBySlug('admin');
                    $role->users()->attach($user);
                    break;
                case 'editor@example.com':
                    $role = Sentinel::findRoleBySlug('editor');
                    $role->users()->attach($user);
                    break;
                case 'user@example.com':
                    $role = Sentinel::findRoleBySlug('user');
                    $role->users()->attach($user);
                    break;
            }
        }
    }
}
