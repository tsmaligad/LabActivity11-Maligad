<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $kagawad = User::create([
            'name' => 'Trixia Maligad',
            'email' => 'kagawad.maligad@bulletin.test',
            'password' => Hash::make('bulletin2026'),
        ]);

        User::create([
            'name' => 'Lola Maligad',
            'email' => 'lola.maligad@bulletin.test',
            'password' => Hash::make('bulletin2026'),
        ]);

        Author::where('email', 'kagawad.maligad@bulletin.test')
            ->firstOrFail()
            ->update(['user_id' => $kagawad->id]);

        User::factory()->count(8)->create();
    }
}
