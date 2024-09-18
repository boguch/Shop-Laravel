@extends('layouts.app') <!-- Подключение основного шаблона приложения -->

@section('title', 'Корзина') <!-- Установка заголовка страницы -->

@section('content') <!-- Начало секции контента -->
<div class="page-components">
    <h1>Корзина</h1> <!-- Заголовок страницы корзины -->
</div>

@if (empty($cart)) <!-- Проверка, пуста ли корзина -->
    <div class="components">
        <p>Корзина пуста.</p> <!-- Сообщение о пустой корзине -->
    </div>
@else
    <form action="{{ route('cart.update') }}" method="POST" id="cart-form"> <!-- Форма для обновления корзины -->
        @csrf <!-- Защита от CSRF-атак -->
        
        @php
            $total = 0; // Инициализация переменной для подсчета общей стоимости товаров
        @endphp

        @foreach ($cart as $productId => $quantity) <!-- Итерация по товарам в корзине -->
            @php
                $product = $products->get($productId); // Получение продукта по ID
                if ($product) {
                    $total += $product->price * $quantity; // Подсчет общей стоимости
                }
            @endphp
            
            @if ($product) <!-- Проверка, найден ли продукт -->
                <div class="components"> <!-- Контейнер для товара -->
                    <div class="entry-components-link">{{ $product->name }}</div> <!-- Название товара -->
                    <div class="cart-components">{{ number_format($product->price, 2, ',', ' ') }} ₽</div> <!-- Цена товара -->
                    <div class="cart-components">Доступно: {{ $product->stock }}</div> <!-- Количество доступного товара -->
                    
                    <div class="cart-components">
                        <div class="input-group">
                            <input type="number" name="quantities[{{ $productId }}]" value="{{ $quantity }}" min="1" max="{{ $product->stock }}" class="form-control mx-2 quantity-input" data-product-id="{{ $productId }}"> <!-- Поле ввода для количества товара -->
                            <button type="button" class="btn btn-increment">+</button> <!-- Кнопка для увеличения количества -->
                            <button type="button" class="btn btn-decrement">-</button> <!-- Кнопка для уменьшения количества -->
                        </div>
                    </div>
                    <div class="cart-components">
                        <button type="button" class="btn btn-danger remove-button" data-product-id="{{ $productId }}">Удалить</button> <!-- Кнопка для удаления товара из корзины -->
                    </div>
                </div>
            @endif
        @endforeach
        
        <div class="components">
            <h2 id="total-sum">{{ number_format($total, 2, ',', ' ') }} ₽</h2> <!-- Вывод общей суммы товаров в корзине -->
        </div>

        <div class="components">
            <form action="{{ route('cart.checkout') }}" method="POST"> <!-- Форма для оформления заказа -->
                @csrf
                @foreach ($cart as $productId => $quantity) <!-- Скрытые поля для передачи количества товаров -->
                    <input type="hidden" name="quantities[{{ $productId }}]" value="{{ $quantity }}">
                @endforeach
                <button type="submit" class="btn btn-success">Оформить заказ</button> <!-- Кнопка для подтверждения заказа -->
            </form>
        </div>

        <div class="components">
            <form action="{{ route('cart.clear') }}" method="POST" style="display:inline;"> <!-- Форма для очистки корзины -->
                @csrf
                <button type="submit" class="btn btn-danger mt-3">Очистить корзину</button> <!-- Кнопка для удаления всех товаров из корзины -->
            </form>
        </div>
    @endif

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Подключение jQuery -->
    <script>
    $(document).ready(function() {
        // Изменяем количество товара через поле ввода
        $('.quantity-input').change(function() {
            updateQuantity($(this)); // Обновляем количество на сервере при изменении значения
        });

        // Обработка клика по кнопке "Увеличить"
        $('.btn-increment').click(function() {
            const input = $(this).siblings('.quantity-input'); // Находим соседнее поле ввода
            let currentValue = parseInt(input.val());
            if (!isNaN(currentValue) && currentValue < input.attr("max")) {
                input.val(currentValue + 1); // Увеличиваем значение
                updateQuantity(input); // Обновляем количество на сервере
            }
        });

        // Обработка клика по кнопке "Уменьшить"
        $('.btn-decrement').click(function() {
            const input = $(this).siblings('.quantity-input'); // Находим соседнее поле ввода
            let currentValue = parseInt(input.val());
            if (!isNaN(currentValue) && currentValue > 1) {
                input.val(currentValue - 1); // Уменьшаем значение
                updateQuantity(input); // Обновляем количество на сервере
            }
        });
    });

    // Обработка клика по кнопке "Удалить"
    $('.remove-button').click(function() {
        var productId = $(this).data('product-id'); // Получаем ID продукта, который нужно удалить
        $.ajax({
            url: '{{ route("cart.remove", ":productId") }}'.replace(':productId', productId), // Заменяем плейсхолдер ID в URL
            type: 'POST', // Метод запроса
            data: {
                _token: '{{ csrf_token() }}', // CSRF-токен для безопасности
                productId: productId, // ID продукта для удаления
                action: 'remove' // Действие удаления
            },
            success: function(response) {
                // Обновите интерфейс после удаления товара
                location.reload(); // Перезагружаем страницу, чтобы обновить состояние корзины
                // Или обработайте удаление элемента из DOM и обновление суммы
            },
            error: function(xhr) {
                alert('Ошибка при удалении товара из корзины.'); // Уведомление об ошибке
            }
        });
    });

    // Функция обновления количества на сервере
    function updateQuantity(input) {
        var productId = input.data('product-id'); // Получаем ID продукта из атрибута input
        var quantity = input.val(); // Получаем количество товара из поля ввода
        $.ajax({
            url: '{{ route("cart.update") }}', // URL для обновления количества в корзине
            type: 'POST', // Метод запроса
            data: {
                _token: '{{ csrf_token() }}', // CSRF-токен для безопасности
                productId: productId, // ID продукта для обновления
                quantities: { [productId]: quantity }, // Передаем количество для данного продукта
                action: 'update' // Действие обновления
            },
            success: function(response) {
                $('#total-sum').text(response.total); // Обновляем отображение общей суммы на странице
            },
            error: function(xhr) {
                alert('Ошибка при обновлении количества товара.'); // Уведомление об ошибке
            }
        });
    }
    </script>
    @endsection