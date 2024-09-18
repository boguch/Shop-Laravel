<?php

namespace App\Http\Controllers; // Объявление пространства имен для контроллера

use App\Models\Product; // Импортируем модель Product для работы с продуктами
use App\Models\Order; // Импортируем модель Order для работы с заказами
use Illuminate\Http\Request; // Импортируем класс Request для обработки HTTP-запросов
use Illuminate\Support\Facades\Session; // Импортируем фасад Session для работы с сессиями

class CartController extends Controller // Определяем класс CartController, наследующий от базового контроллера
{
    // Метод для добавления продукта в корзину
    public function add($productId)
    {
        $product = Product::find($productId); // Находим продукт по его ID

        if (!$product) {
            return redirect()->back()->with('error', 'Товар не найден.'); // Если продукт не найден, перенаправляем с ошибкой
        }

        $cart = Session::get('cart', []); // Получаем корзину из сессии или создаем новую, если еще нет
        $quantity = isset($cart[$productId]) ? $cart[$productId] : 0; // Получаем текущее количество товара в корзине

        // Проверка доступного количества
        if ($quantity + 1 > $product->stock) { // Проверяем, достаточно ли товара на складе
            return redirect()->back()->with('error', 'Недостаточно товара на складе.'); // Если недостаточно, перенаправляем с ошибкой
        }

        $cart[$productId] = $quantity + 1; // Увеличиваем количество товара в корзине
        Session::put('cart', $cart); // Сохраняем обновленную корзину в сессии
        return redirect()->back()->with('success', 'Товар добавлен в корзину'); // Перенаправляем с сообщением об успешном добавлении
    }

    // Метод для отображения содержимого корзины
    public function show()
    {
        $cart = Session::get('cart', []); // Получаем корзину из сессии
        $products = Product::whereIn('id', array_keys($cart))->get()->keyBy('id'); // Получаем продукты, которые есть в корзине
        return view('cart.show', compact('cart', 'products')); // Отображаем представление с корзиной и продуктами
    }

    // Метод для отображения страницы оформления заказа
    public function checkout(Request $request)
    {
        // Получение массива товаров из сессии
        $cart = $request->session()->get('cart', []); // Получаем корзину из сессии
        
        // Получение всех ID продуктов из корзины
        $productIds = array_keys($cart); // Извлекаем ID продуктов из корзины

        // Получение продуктов из базы данных
        $products = Product::whereIn('id', $productIds)->get(); // Получаем продукты по их ID

        return view('cart.checkout', compact('cart', 'products')); // Отображаем представление оформления заказа
    }

    // Метод для завершения оформления заказа
    public function complete(Request $request)
    {
        // Валидация данных с формы
        $validatedData = $request->validate([
            'name' => 'required', // Имя обязательно
            'email' => 'required|email', // Email обязателен и должен быть в правильном формате
        ]);

        // Получаем данные о товарах из корзины
        $cart = Session::get('cart', []); // Получаем корзину из сессии
        $products = []; // Массив для хранения данных о продуктах в заказе

        foreach ($cart as $productId => $quantity) { // Проходим по товарам в корзине
            $product = Product::find($productId); // Находим продукт по его ID
            if ($product) {
                $products[] = [ // Собираем информацию о каждом продукте
                    'id' => $productId, // Сохраняем ID продукта для дальнейшей обработки
                    'name' => $product->name, // Сохраняем имя продукта
                    'quantity' => $quantity, // Сохраняем количество
                ];
            }
        }

        // Сохранение заказа в базе данных
        $order = Order::create([
            'name' => $validatedData['name'], // Сохраняем имя покупателя
            'email' => $validatedData['email'], // Сохраняем email покупателя
            'products' => json_encode($products), // Сохраняем товары в формате JSON
        ]);

        // Сохранение данных о заказе и продуктах в сессии для страницы подтверждения
        Session::put('order', [
            'id' => $order->id, // Сохраняем уникальный номер заказа
            'name' => $validatedData['name'], // Сохраняем имя покупателя
            'email' => $validatedData['email'], // Сохраняем email покупателя
            'products' => $products, // Сохраняем массив продукции
        ]);

        // Уменьшение количества на складе для всех товаров в заказе
        foreach ($cart as $productId => $quantity) { // Проходим по продуктам в корзине
            $product = Product::find($productId); // Находим продукт по его ID
            if ($product) {
                $product->decrement('stock', $quantity); // Уменьшаем количество на складе
            }
        }

        // Очистка корзины после оформления
        Session::forget('cart'); // Удаляем корзину из сессии

        // Перенаправление на страницу подтверждения
        return redirect()->route('checkout.confirmation'); // Перенаправляем на страницу подтверждения заказа
    }

    // Метод для отображения страницы подтверждения заказа
    public function confirmation()
    {
        return view('checkout.confirmation'); // Отображаем представление с подтверждением заказа
    }

    // Метод для обновления количества товаров в корзине
    public function update(Request $request)
    {
        $cart = session()->get('cart', []); // Получаем текущую корзину из сессии

        // Обновление количества товара
        if ($request->action == 'update') { // Если действие обновление
            $productId = $request->productId; // Получаем ID продукта
            $quantity = $request->quantities[$productId]; // Получаем новое количество

            if ($quantity <= 0) { // Если количество меньше или равно 0, удаляем товар из корзины
                unset($cart[$productId]);
            } else {
                $cart[$productId] = $quantity; // Обновляем количество товара
            }

            session()->put('cart', $cart); // Сохраняем обновленную корзину в сессии
        }

        // Расчет общей суммы
        $total = 0; // Инициализируем переменную общей суммы
        foreach ($cart as $productId => $quantity) { // Проходим по всем товарам в корзине
            $product = Product::find($productId); // Получаем информацию о товаре
            if ($product) {
                $total += $product->price * $quantity; // Считаем общую сумму
            }
        }

        // Возвращаем общую сумму в виде JSON-ответа
        return response()->json(['total' => number_format($total, 2, ',', ' ') . ' ₽']); // Форматируем сумму и возвращаем
    }

    // Метод для удаления продукта из корзины
    public function remove($productId)
    {
        $cart = session()->get('cart', []); // Получаем текущую корзину

        // Проверяем, есть ли товар в корзине
        if (isset($cart[$productId])) {
            unset($cart[$productId]); // Удаляем товар из корзины
            session()->put('cart', $cart); // Обновляем сессию
            return redirect()->route('cart.show')->with('success', 'Товар удалён из корзины.'); // Перенаправляем с сообщением об успешном удалении
        }

        return redirect()->route('cart.show')->with('error', 'Товар не найден в корзине.'); // Если товара нет, перенаправляем с ошибкой
    }

    // Метод для очистки корзины
    public function clear(Request $request)
    {
        // Очистка корзины
        $request->session()->forget('cart'); // Удаляем корзину из сессии
        return redirect()->route('cart.show')->with('success', 'Корзина очищена.'); // Перенаправляем с сообщением об успешной очистке
    }
}