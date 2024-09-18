<?php

namespace App\Http\Controllers; // Определение пространства имен для контроллера

use Illuminate\Http\Request; // Импортируем класс Request для обработки HTTP-запросов
use App\Models\Product; // Импортируем модель Product для доступа к данным о продуктах
use Illuminate\Support\Facades\Log; // Импортируем фасад Log для записи логов

class ProductController extends Controller // Определяем класс ProductController, наследующий от базового контроллера
{
    // Метод для отображения списка продуктов
    public function index(Request $request)
    {
        // Пагинация продуктов на 10 элементов
        $products = Product::paginate(10); // Получаем список продуктов с пагинацией по 10 элементов на страницу

        return view('index', compact('products')); // Возвращаем представление index с продуктами
    }

    // Метод для отображения конкретного продукта
    public function show($id)
    {
        // Попытка найти продукт
        $product = Product::find($id); // Ищем продукт в базе данных по его ID

        // Обработка случая, когда продукт не найден
        if (!$product) {
            Log::error('Product not found', ['product_id' => $id]); // Записываем ошибку в лог, если продукт не найден
            return redirect()->route('index')->with('error', 'Товар не найден.'); // Перенаправляем на главную страницу с сообщением об ошибке
        }

        return view('products.show', compact('product')); // Возвращаем представление для отображения продукта
    }
}