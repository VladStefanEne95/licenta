<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GanttTasksTableSeeder::class);
        $this->call(LinksTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
