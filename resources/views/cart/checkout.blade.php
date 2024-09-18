@extends('layouts.app') <!-- Подключение основного шаблона приложения -->

@section('title', 'Оформление заказа') <!-- Установка заголовка страницы -->

@section('content') <!-- Начало секции контента -->
<div class="components">
    <h1>Оформление заказа</h1> <!-- Заголовок оформления заказа -->
</div>

<form action="{{ route('cart.complete') }}" method="POST"> <!-- Форма для подтверждения заказа -->
    @csrf <!-- Защита от CSRF-атак -->
    <div class="components">
        <div class="entry-components-link">
            <label for="name">Имя получателя:</label> <!-- Поле ввода для имени получателя -->
        </div>
        <div class="cart-components">
            <input type="text" name="name" required class="quantity-input"> <!-- Поле ввода для имени -->
        </div>
        @error('name') <!-- Проверка на ошибки валидации для имени -->
            <div class="text-danger">{{ $message }}</div> <!-- Вывод ошибки, если есть -->
        @enderror
    </div>

    <div class="components">
        <div class="entry-components-link">
            <label for="email">Email:</label> <!-- Поле ввода для email -->
        </div>
        <div class="cart-components">
            <input type="email" name="email" required class="quantity-input"> <!-- Поле ввода для email -->
        </div>
        @error('email') <!-- Проверка на ошибки валидации для email -->
            <div class="text-danger">{{ $message }}</div> <!-- Вывод ошибки, если есть -->
        @enderror
    </div>

    <div class="components">
        <h2>Ваши товары:</h2> <!-- Заголовок для списка товаров в корзине -->
    </div>
    
    @forelse ($cart as $productId => $quantity) <!-- Итерация по товарам в корзине -->
        @php
            $product = $products->find($productId); // Используем find вместо get для получения одного продукта
        @endphp
        @if ($product) <!-- Проверка, найден ли продукт -->
            <div class="components">
                <div class="entry-components-link">{{ $product->name }}</div> <!-- Вывод названия товара -->
                <div class="cart-components"> количество: {{ $quantity }}</div> <!-- Вывод количества товара -->
            </div>
        @else
            <div class="components">Товар с ID {{ $productId }} не найден.</div> <!-- Вывод сообщения об отсутствии товара -->
        @endif
    @empty <!-- Если корзина пуста -->
        <div class="components">
            Корзина пуста
        </div>
    @endforelse
    
    <div class="components">
        <button type="submit" class="btn btn-success mt-3">Подтвердить заказ</button> <!-- Кнопка для подтверждения заказа -->
    </div>
</form>
@endsection <!-- Конец секции контента -->