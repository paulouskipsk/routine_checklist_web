<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DistrictsSeeder::class,
            UsersSeeder::class,
            UserGroupsSeeder::class,
            ChklClassificationSeeder::class,
            SectorsSeeder::class,
            UnitySeeder::class,
            ChecklistSeeder::class,
            ChecklistItemSeeder::class
        ]);

    }
}
