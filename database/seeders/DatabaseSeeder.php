<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $alice = User::factory()->create([
            'name'  => 'Alice Smith',
            'email' => 'alice@example.com',
            'role'  => 'admin',
        ]);

        $bob = User::factory()->create([
            'name'  => 'Bob Jones',
            'email' => 'bob@example.com',
        ]);

        $charlie = User::factory()->create([
            'name'  => 'Charlie Brown',
            'email' => 'charlie@example.com',
        ]);

        Equipment::create(['name' => 'Laptop Dell XPS',   'user_id' => $alice->id]);
        Equipment::create(['name' => 'iPhone 15',         'user_id' => $alice->id]);
        Equipment::create(['name' => 'Standing Desk',     'user_id' => $bob->id]);
        Equipment::create(['name' => 'Monitor LG 27"',    'user_id' => $bob->id]);
        Equipment::create(['name' => 'Mechanical Keyboard','user_id' => $charlie->id]);
        Equipment::create(['name' => 'Webcam Logitech',   'user_id' => null]);
    }
}
