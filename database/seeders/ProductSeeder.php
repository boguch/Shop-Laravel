<?php

namespace Database\Seeders; // Определение пространства имен для сидеров

use Illuminate\Database\Console\Seeds\WithoutModelEvents; // Импортируем класс для работы без событий моделей
use Illuminate\Database\Seeder; // Импортируем базовый класс Seeder для создания сидеров
use App\Models\Product; // Импортируем модель Product для добавления данных в таблицу продуктов
use Faker\Factory as Faker; // Импортируем библиотеку Faker для генерации фейковых данных

class ProductSeeder extends Seeder // Объявляем класс ProductSeeder, который наследует от класса Seeder
{
    /**
     * Запускаем сиды базы данных.
     */
    public function run() { // Метод, который будет выполнен при запуске сидера
        $faker = Faker::create(); // Создаем экземпляр Faker для генерации фейковых данных

        for ($i = 0; $i < 50; $i++) { // Цикл для создания 50 поддельных продуктов
            Product::create([ // Используем метод create для добавления нового продукта в базу данных
                'name' => $faker->word, // Генерируем случайное слово для названия продукта
                'price' => $faker->randomFloat(2, 1, 100), // Генерируем случайную цену продукта от 1 до 100 с 2 знаками после запятой
                'stock' => $faker->numberBetween(0, 20), // Генерируем случайное количество на складе от 0 до 20
            ]);
        }
    }
}