<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('members')->insert([
            'code' => "M001",
            'name' => "Angga"
        ]);
        \DB::table('members')->insert([
            'code' => "M002",
            'name' => "Ferry"
        ]);
        \DB::table('members')->insert([
            'code' => "M003",
            'name' => "Putri"
        ]);
    }
}
