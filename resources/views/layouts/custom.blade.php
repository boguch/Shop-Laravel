@if ($paginator->hasPages()) {{-- Проверяем, есть ли страницы для отображения --}}
    <nav>
        <ul class="pagination justify-content-center">
            {{-- Линк на первую страницу --}}
            @if ($paginator->onFirstPage()) {{-- Проверяем, находимся ли мы на первой странице --}}
                <li class="page-item disabled"><span class="page-link">&laquo;</span></li> {{-- Если да, ссылка отключена --}}
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}">&laquo;</a></li> {{-- Если нет, выводим ссылку на первую страницу --}}
            @endif

            {{-- Линк на предыдущую страницу --}}
            @if ($paginator->currentPage() > 1) {{-- Проверяем, не на первой ли странице мы сейчас --}}
                <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->currentPage() - 1) }}">&lsaquo;</a></li> {{-- Если нет, выводим ссылку на предыдущую страницу --}}
            @else
                <li class="page-item disabled"><span class="page-link">&lsaquo;</span></li> {{-- Если да, ссылка отключена --}}
            @endif

            {{-- Номера страниц --}}
            @foreach ($elements as $element) {{-- Проходим по всем элементам пагинации --}}
                {{-- Если это строка (например, "..." для разделения) --}}
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li> {{-- Просто выводим её как отключённый элемент --}}
                @endif

                {{-- Если это массив (номера страниц) --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url) {{-- Проходим по каждому номеру страницы в массиве --}}
                        @if ($page == $paginator->currentPage()) {{-- Проверяем, является ли текущая страница активной --}}
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li> {{-- Если да, отмечаем её как активную --}}
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li> {{-- Если нет, просто выводим ссылку на номер страницы --}}
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Линк на следующую страницу --}}
            @if ($paginator->hasMorePages()) {{-- Проверяем, есть ли следующая страница --}}
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">&rsaquo;</a></li> {{-- Если да, выводим ссылку на следующую страницу --}}
            @else
                <li class="page-item disabled"><span class="page-link">&rsaquo;</span></li> {{-- Если нет, ссылка отключена --}}
            @endif

            {{-- Линк на последнюю страницу --}}
            @if (!$paginator->onLastPage()) {{-- Проверяем, не на последней ли странице мы сейчас --}}
                <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">&raquo;</a></li> {{-- Если нет, выводим ссылку на последнюю страницу --}}
            @else
                <li class="page-item disabled"><span class="page-link">&raquo;</span></li> {{-- Если да, ссылка отключена --}}
            @endif
        </ul>
    </nav>
@endif