<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\User;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $user = User::first();
        $user2 = User::where('email', '=', 'said@yahoo.com')->first();

        Album::firstOrCreate([
            'name' => 'story',
            'user_id' => $user->id,
        ]);
        Album::firstOrCreate([
            'name' => 'dddd',
            'user_id' => $user->id,
        ]);

        Album::firstOrCreate([
            'name' => 'hyyyyy',
            'user_id' => $user2->id,
        ]);
        Album::firstOrCreate([
            'name' => 'pppppp',
            'user_id' => $user2->id,
        ]);

    }
}
