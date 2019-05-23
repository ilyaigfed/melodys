<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\PlaylistType;

class PlaylistTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlaylistType::unguard();

        DB::table('playlist_types')->insert([
            'name' => 'Плейлист',
        ]);

        DB::table('playlist_types')->insert([
            'name' => 'Альбом',
        ]);

        DB::table('playlist_types')->insert([
            'name' => 'Подборка',
        ]);

        DB::table('playlist_types')->insert([
            'name' => 'EP',
        ]);

        DB::table('playlist_types')->insert([
            'name' => 'Сингл',
        ]);

        DB::table('playlist_types')->insert([
            'name' => 'Ремиксы',
        ]);

        DB::table('playlist_types')->insert([
            'name' => 'Демо',
        ]);

        DB::table('playlist_types')->insert([
            'name' => 'Лайв',
        ]);

        PlaylistType::reguard();
    }
}
