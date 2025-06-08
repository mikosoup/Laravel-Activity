<?php

namespace Database\Seeders;

use App\Models\Students;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create();

       Students::create([
            'name' => 'Rose',
            'age' => 21,
        ]);
        Students::create([
            'name' => 'Nathan',
            'age' => 22,
        ]);
    }
}
