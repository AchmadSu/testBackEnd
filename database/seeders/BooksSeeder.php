<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('books')->insert([
            'code' => "JK-45",
            'title' => "Harry Potter",
            'author' => "JK Rowling",
            'stock' => 1,
        ]);
        \DB::table('books')->insert([
            'code' => "SHR-1",
            'title' => "A Study in Scarlett",
            'author' => "Arthur Conan Doyle",
            'stock' => 1,
        ]);
        \DB::table('books')->insert([
            'code' => "TW-11",
            'title' => "Twilight",
            'author' => "Stephenie Meyer",
            'stock' => 1,
        ]);
        \DB::table('books')->insert([
            'code' => "HOB-83",
            'title' => "The Hobbit, or There and Back Again",
            'author' => "J.R.R. Tolkien",
            'stock' => 1,
        ]);
        \DB::table('books')->insert([
            'code' => "NRN-7",
            'title' => "The Lion, the Witch and the Wardrobe",
            'author' => "C.S. Lewis",
            'stock' => 1,
        ]);
    }
}
