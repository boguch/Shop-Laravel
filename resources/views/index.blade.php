@extends('layouts.app') {{-- Расширяем основной шаблон приложения --}}

@section('title', 'Главная') {{-- Устанавливаем заголовок страницы на "Главная" --}}

@section('content') {{-- Начинаем секцию контента, которая будет вставлена в основной шаблон --}}
<div class="page-components">
    <h1>Список товаров</h1> {{-- Заголовок страницы с названием раздела --}}
</div>
<div class="page-components">
    {{-- Заголовок для текущей страницы с информацией о страницах --}}
    <h2>Страница {{ $products->currentPage() }} из {{ $products->lastPage() }}</h2>
</div>
    
@foreach ($products as $product) {{-- Проходим по каждому продукту из коллекции $products --}}
    <div class="components"> {{-- Обертка для каждого продукта --}}
        <div class="entry-components">
            {{-- Ссылка на отдельную страницу продукта --}}
            <a class="entry-components-link" href="{{ url('/products/' . $product->id) }}">{{ $product->name }}</a>
        </div>
        <div class="info-components">
            {{-- Отображаем количество товара в наличии с изменением цвета текста в зависимости от наличия --}}
            <span class="{{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">
                в наличии: {{ $product->stock }}
            </span>
        </div>
        <div class="info-components">
            {{-- Форматируем и отображаем цену продукта --}}
            <span>{{ number_format($product->price, 2, ',', ' ') }} ₽</span>
        </div>    
    </div>
@endforeach

{{-- Пагинация --}}
@if ($products->hasPages()) {{-- Проверяем, есть ли дополнительные страницы для отображения --}}
    <nav>
        <div class="pagination">
            @for ($i = 1; $i <= $products->lastPage(); $i++) {{-- Проходим по всем страницам --}}
                {{-- Ссылка на каждую страницу с выделением текущей страницы --}}
                <a class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}" href="{{ $products->url($i) }}">
                    <span class="page-link">{{ $i }}</span> {{-- Номер страницы --}}
                </a>
            @endfor
        </div>
    </nav>
@endif

@endsection {{-- Завершаем секцию контента --}}