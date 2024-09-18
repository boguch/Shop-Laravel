<?php

namespace App\Models; // Определение пространства имен для модели

use Illuminate\Database\Eloquent\Factories\HasFactory; // Импортируем трейты для работы с фабриками
use Illuminate\Database\Eloquent\Model; // Импортируем базовый класс Model для работы с моделями в Eloquent

class Order extends Model // Объявляем класс Order, который наследует от класса Model
{
    use HasFactory; // Подключаем трейт HasFactory для использования фабрик Eloquent
    
    protected $fillable = [ // Определяем массив атрибутов, которые можно массово заполнять
        'name', // Имя заказчика
        'email', // Электронная почта заказчика
        'products', // Продукты в заказе, сохраненные в формате JSON
    ];
}