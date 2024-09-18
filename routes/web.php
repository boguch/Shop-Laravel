<?php
use Illuminate\Support\Facades\Route; // Импортируем фасад Route для определения маршрутов
use App\Http\Controllers\CartController; // Импортируем контроллер CartController для работы с корзиной
use App\Http\Controllers\ProductController; // Импортируем контроллер ProductController для работы с продуктами

// Главная страница с продуктами
Route::get('/', [ProductController::class, 'index'])->name('index'); // Определяем маршрут для главной страницы, которая отображает список продуктов

// Просмотр конкретного продукта
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show'); // Определяем маршрут для отображения информации о конкретном продукте по его ID

// Маршруты для корзины
Route::prefix('cart')->group(function () { // Группируем маршруты, связанные с корзиной, под префиксом 'cart'
    
    // Показать содержимое корзины
    Route::get('/', [CartController::class, 'show'])->name('cart.show'); // Определяем маршрут для отображения содержимого корзины

    // Добавить продукт в корзину
    Route::post('/add/{productId}', [CartController::class, 'add'])->name('cart.add'); // Определяем маршрут для добавления продукта в корзину по его ID

    // Отобразить страницу оформления заказа
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout'); // Определяем маршрут для отображения формы оформления заказа

    // Обработать оформление заказа (должен быть POST)
    Route::post('/complete', [CartController::class, 'complete'])->name('cart.complete'); // Определяем маршрут для обработки подтверждения заказа

    // Подтверждение заказа
    Route::get('/confirmation', [CartController::class, 'confirmation'])->name('checkout.confirmation'); // Определяем маршрут для страницы подтверждения заказа

    // Обновление количества продуктов в корзине
    Route::post('/update', [CartController::class, 'update'])->name('cart.update'); // Определяем маршрут для обновления количества продуктов в корзине

    // Очистить корзину
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear'); // Определяем маршрут для очистки содержимого корзины

    // Удалить продукт из корзины
    Route::post('/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove'); // Определяем маршрут для удаления продукта из корзины по его ID
});
