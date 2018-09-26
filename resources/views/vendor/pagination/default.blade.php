@if ($paginator->hasPages())

    <ul class="pagination mdui-color-purple-300" style="border-radius: 8px">
        {{-- 前翻页 --}}
        @if ($paginator->onFirstPage())
            <li class="pagination__item"><span class="pagination__number pagination__control pagination__control_prev">{{__('index.firstPage')}}</span></li>
        @else
            <li class="pagination__item"><a href="{{ $paginator->previousPageUrl() }}" class="pagination__number"><i class="mdui-icon material-icons">chevron_left</i><span class="pagination__control pagination__control_prev">{{__('index.previousPage')}}</span></a></li>
        @endif
        {{-- 页码 --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled mdui-hidden-sm-down"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="pagination__item mdui-hidden-sm-down"><span class="pagination__number pagination__number_active mdui-color-theme-200">{{ $page }}</span></li>
                    @else
                        <li class="pagination__item mdui-hidden-sm-down"><a href="{{ $url }}" class="pagination__number">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        {{-- 下一页 --}}
        @if ($paginator->hasMorePages())
            <li class="pagination__item"><a href="{{ $paginator->nextPageUrl()}}" class="pagination__number"><i class="mdui-icon material-icons">chevron_right</i><span class="pagination__control pagination__control_next">{{__('index.nextPage')}}</span></a></li>
        @else
            <li class="pagination__item"><span class="pagination__number pagination__control pagination__control_next">{{__('index.lastPage')}}</span></li>
        @endif

    </ul>

@endif
