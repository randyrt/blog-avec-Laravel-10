<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = collect(['fantasie', 'fantastique', 'romance', 'horreur', 'kodomo', 'shonen', 'action', 'policier']);
        $tags->each(fn($tag) => Tag::create([
            'name' => $tag,
            'slug' => Str::slug($tag)
        ]));
    }
}
