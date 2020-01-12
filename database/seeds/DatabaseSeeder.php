<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(ConfigurationTableSeeder::class);
        $this->call(DocumentsTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
