<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(DocumentsTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
