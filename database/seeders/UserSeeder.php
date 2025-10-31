<?php

namespace Database\Seeders;

use App\Models\User;
use Filament\Auth\Events\Registered;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        User::factory()->superAdmin()->create([
            'name' => __('Super administrator'),
            'email' => 'admin@admin.com',
        ]);

        $user = User::factory()->create([
            'name' => __('Team administrator'),
            'email' => 'team@admin.com',
        ]);
        event(new Registered($user));
    }
}
