<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Genre;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::unguard();

        $genres = [
            'Альтернативный рок',
            'Эмбиент',
            'Классическая музыка',
            'Кантри',
            'EDM',
            'Дип-хаус',
            'Дэнсхолл',
            'Диско',
            'Драм-н-бэйс',
            'Дабстеп',
            'Электро',
            'Народная музыка',
            'Хип-хоп & Рэп',
            'Хаус',
            'Инди',
            'Джаз & Блюз',
            'Латиноамериканская музыка',
            'Метал',
            'Инструментальная музыка',
            'Поп-музыка',
            'R&B & Соул',
            'Регги',
            'Реггетон',
            'Рок',
            'Саундтрек',
            'Техно',
            'Транс',
            'Трэп',
            'Трип-хоп',
            'Этническая музыка',
            'Аудиокниги',
            'Бизнес',
            'Юмор',
            'Развлечения',
            'Обучение',
            'Новости & Политика',
            'Наука',
            'Спорт',
            'Технологии'
        ];

        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'name' => $genre,
            ]);
        }

        Genre::reguard();
    }
}
