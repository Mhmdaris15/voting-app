<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 7 users
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'class' => 'XII SIJA 1',
            'NISN' => fake()->unique()->numberBetween(1000000000, 9999999999),
            'password' => '5tgb6yhn',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        User::factory(30)->create();
        $open = fopen(storage_path("app\users.csv"), "r");
        while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
            User::create([
                'name' => $data[1],
                'email' => $data[4],
                'class' => $data[2],
                'NISN' => $data[3],
                'password' => $data[5],
                // 'candidate_id' => random_int(1, Candidate::count())
            ]);
        }
        $open2 = fopen(storage_path('app\teachers.csv'), "r");
        while (($data = fgetcsv($open2, 1000, ",")) !== FALSE) {
            User::create([
                'name' => $data[1],
                'email' => $data[4],
                'class' => $data[2],
                'NISN' => $data[3],
                'password' => $data[5],
                // 'candidate_id' => random_int(1, Candidate::count())
            ]);
        }
    }
}