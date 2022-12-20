<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Candidate;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'NISN' => '1234567890',
        // ]);

        Candidate::create([
            'name' => 'Angela Merkel',
            'photo' => 'angela-merkel.jpg',
            'votes' => 0,
        ]);
        Candidate::create([
            'name' => 'Recep Tayyip Erdoğan',
            'photo' => 'erdogan.jpg',
            'votes' => 0,
        ]);
        Candidate::create([
            'name' => 'Xi Jinping',
            'photo' => 'xi-jinping.jpg',
            'votes' => 0,
        ]);
    }
}
