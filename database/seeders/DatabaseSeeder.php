<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todo_list')->insert([
            'todo_name' => 'Learn Laravel',
            'todo_status' => 0,
            'created_at' => now()
        ]);
    }
}
