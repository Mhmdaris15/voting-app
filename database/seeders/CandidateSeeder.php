<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 5 candidates
        Candidate::create([
            'name' => 'Angela Merkel',
            'photo' => 'angela-merkel.jpg',
            'votes' => 0,
            'vision' => 'Mengembangkan ekonomi negara',
            'missions' => json_encode([
                'Mengembangkan ekonomi negara',
                'Mengembangkan ekonomi negara',
                'Mengembangkan ekonomi negara',
                'Mengembangkan ekonomi negara',
                'Mengembangkan ekonomi negara',
            ]),
        ]);
        Candidate::create([
            'name' => 'Recep Tayyip Erdoğan',
            'photo' => 'erdogan.jpg',
            'votes' => 0,
            'vision' => 'Mengembangkan ekonomi negara',
            'missions' => json_encode([
                'Mengembangkan ekonomi negara',
                'Mengembangkan ekonomi negara',
                'Mengembangkan ekonomi negara',
                'Mengembangkan ekonomi negara',
                'Mengembangkan ekonomi negara',
            ]),
        ]);
        Candidate::create([
            'name' => 'Xi Jinping',
            'photo' => 'xi-jinping.jpg',
            'votes' => 0,
            'vision' => 'Mengembangkan ekonomi negara',
            'missions' => json_encode([
                'Mengembangkan ekonomi negara',
                'Mengembangkan ekonomi negara',
                'Mengembangkan ekonomi negara',
                'Mengembangkan ekonomi negara',
                'Mengembangkan ekonomi negara',
            ]),
        ]);
        Candidate::create([
            'name' => 'Vladimir Putin',
            'photo' => 'vladimir-putin.jpg',
            'votes' => 0,
            'vision' => 'Mengembangkan ekonomi negara',
            'missions' => json_encode([
                'Mengembangkan ekonomi negara',
                'Mengembangkan ekonomi negara',
                'Mengembangkan ekonomi negara',
                'Mengembangkan ekonomi negara',
                'Mengembangkan ekonomi negara',
            ]),
        ]);
    }
}
