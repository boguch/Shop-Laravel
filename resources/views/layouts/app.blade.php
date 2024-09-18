<!DOCTYPE html> <!-- Указание типа документа HTML5 -->
<html lang="en"> <!-- Открытие элемента html с указанием языка страницы -->
<head>
    <meta charset="UTF-8"> <!-- Задание кодировки документа -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Настройки для адаптивного дизайна -->
    <title>@yield('title', 'Мой сайт')</title> <!-- Заголовок страницы, с возможностью подстановки имени страницы -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Подключение CSS-стилей, если необходимо -->
</head>
<body>
    <div class="wrapper"> <!-- Обертка для всего контента на странице -->
        <!-- Шапка -->
        <header> <!-- Заголовок страницы -->
            <div class="menu"> <!-- Контейнер для меню навигации -->
                <div class="entry-menu"> <!-- Элемент меню -->
                    <a class="entry-menu-link" href="{{ route('index') }}">Главная</a> <!-- Ссылка на главную страницу -->
                </div>
                <div class="entry-menu"> <!-- Элемент меню -->
                    <a class="entry-menu-link" href="{{ route('cart.show') }}">Корзина</a> <!-- Ссылка на корзину -->
                </div>
            </div>
        </header>
        
        <div class="container"> <!-- Контейнер для основного контента на странице -->
            <!-- Основной контент -->
            <main>
                @yield('content') <!-- Здесь будет отображаться контент, подставленный из других шаблонов -->
            </main>
        </div>
        
        <!-- Подвал -->
        <footer> <!-- Нижняя часть страницы -->
            <p>© {{ date('Y') }} Мой сайт. Все права защищены.</p> <!-- Текст с авторскими правами -->
        </footer>
    </div>
</body>
</html>