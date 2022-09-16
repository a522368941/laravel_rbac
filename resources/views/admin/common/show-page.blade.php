@if ($paginator->hasPages())
    <ul class="pagination" style="float: left;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="paginate_button previous disabled" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_previous"><a href="#">上一页</a></li>
        @else
            <li class="paginate_button previous" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_previous"><a href="{{ $paginator->previousPageUrl() }}" >上一页</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="paginate_button disabled"><a href="#">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="paginate_button active" aria-controls="dynamic-table" tabindex="0"><a href="#">{{ $page }}</a></li>
                    @else
                        <li class="paginate_button" aria-controls="dynamic-table" tabindex="0"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="paginate_button next"><a href="{{ $paginator->nextPageUrl() }}" rel="next">下一页</a></li>
        @else
            <li class="paginate_button next disabled"><a href="#">下一页</a></li>
        @endif
    </ul>

    <!--<ul class="clearfix"></ul>-->

    {{-- 增加输入框，跳转任意页码和显示任意条数 --}}
    <ul style="float: right;" class="pagination pagination-sm no-margin no-padding pull-right">
        <li>
        <span data-toggle="tooltip" data-placement="bottom" title="输入页码，按回车快速跳转">
            第 <input type="text" class="text-center no-padding" value="{{ $paginator->currentPage() }}" id="customPage" data-total-page="{{ $paginator->lastPage() }}" style="width: 50px;"> 页 / 总计 {{ $paginator->lastPage() }} 页
        </span>
        </li>
    </ul>
    <script>
        $("#customPage").keyup(function (event) {
            if(event.keyCode ==13){
                var page = $('#customPage').val();
                var url = "{{ $paginator->url(666699996666) . '&limit=' . $paginator->perPage() }}";
                window.location.href = url.replace('666699996666',page).replace(/&amp;/g,'\&');
            }

        });
    </script>

@endif