@extends('layouts.app') <!-- Подключение основного шаблона приложения -->

@section('title', 'Подтверждение заказа') <!-- Установка заголовка страницы -->

@section('content') <!-- Начало секции контента -->
<div class="components">
    <h1>Подтверждение заказа</h1> <!-- Заголовок страницы подтверждения заказа -->
</div>
@if (session('order')) <!-- Проверка, есть ли данные заказа в сессии -->
    @php
        $order = session('order'); // Получение данных заказа из сессии
        $products = $order['products'] ?? []; // Получение списка продуктов из заказа, если они есть
    @endphp
    <div class="components">
        <h2>Ваш заказ #{{ $order['id'] }}</h2> <!-- Заголовок с номером заказа -->
    </div>
    <div class="components">
        <div class="entry-components-link">Имя:</div>
        <div class="cart-components">{{ $order['name'] }}</div> <!-- Вывод имени заказчика -->
    </div>
    <div class="components">
        <div class="entry-components-link">Email:</div>
        <div class="cart-components">{{ $order['email'] }}</div> <!-- Вывод email заказчика -->
    </div>

    @if ($products && count($products) > 0) <!-- Проверка, есть ли продукты в заказе -->
        <div class="components">
            <h2>Вы заказали:</h2> <!-- Заголовок списка заказанных товаров -->
        </div>
            
        @foreach ($products as $item) <!-- Итерация по продуктам в заказе -->
            <div class="components">
                <div class="entry-components-link">{{ $item['name'] }}</div>
                <div class="cart-components">{{ $item['quantity'] }} шт.</div> <!-- Вывод названия и количества товара -->
            </div>
        @endforeach
            
    @else
        <div class="components">Нет продуктов в вашем заказе.</div> <!-- Сообщение, если заказа нет -->
    @endif
@else
    <div class="components">Заказ не найден.</div> <!-- Сообщение, если заказ не найден -->
@endif
@endsection <!-- Конец секции контента -->