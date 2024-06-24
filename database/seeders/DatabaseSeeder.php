<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // DistrictsSeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            UnitySeeder::class,
            UsersSeeder::class,
            UserGroupsSeeder::class,
            ChklClassificationSeeder::class,
            SectorsSeeder::class,
            ChecklistSeeder::class,
            ChecklistItemSeeder::class
        ]);

    }
}
