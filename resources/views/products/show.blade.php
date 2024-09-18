@extends('layouts.app') {{-- Расширяем основной шаблон приложения --}}

@section('title', $product->name) {{-- Устанавливаем заголовок страницы на имя продукта --}}

@section('content') {{-- Начинаем секцию контента, которая будет вставлена в основной шаблон --}}
<div class="components"> {{-- Блок для компонента продукта --}}
    <h1>{{ $product->name }}</h1> {{-- Отображаем название продукта --}}
</div>

<div class="components"> {{-- Блок для ценовой информации --}}
    <div class="entry-components-link"><span class="fw-bold">{{ number_format($product->price, 2, ',', ' ') }} ₽</span></div> {{-- Форматируем цену и отображаем её --}}

    @if ($product->stock > 0) {{-- Проверяем, есть ли в наличии товар --}}
        <div class="cart-components">В наличии: {{ $product->stock }}</div> {{-- Отображаем количество товара в наличии --}}
    </div>

    <div class="components"> {{-- Блок с кнопкой добавления товара в корзину --}}
        <form action="{{ route('cart.add', $product->id) }}" method="POST"> {{-- Форма для добавления товара в корзину --}}
            @csrf {{-- Защита от CSRF-атак, добавляя токен --}}
            <button type="submit" class="btn btn-primary">Добавить в корзину</button> {{-- Кнопка для отправки формы --}}
        </form>
    </div>
    @else
        <div class="cart-components"> {{-- Блок, который отображается, если товар недоступен --}}
            <p class="text-danger">Товар недоступен</p> {{-- Выводим сообщение об отсутствии товара --}}
        </div>
    @endif

@endsection {{-- Завершаем секцию контента --}}