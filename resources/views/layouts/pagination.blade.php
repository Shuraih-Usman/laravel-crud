@if($paginator->hasPages())
    <div class="pagination">
        @if($paginator->onFirstPage())
            <a href="#" class="disabled">Next</a>
        @else
            <a href="{{$paginator->previousPageurl()}}" class="active"></a>
        @endif

        @foreach($elements as $element)

                @if(is_string($element))
                    <a href="">{{$element}}</a>

                @endif

            @if(is_array($element))

                @foreach($element as $page => $url)

                    @if($page == $paginator->currentPage())
                        <a href="#" class="active">
                            {{$page}}
                        </a>

                    @else
                                <a href="{{$url}}">
                                    {{$page}}
                                </a>
                    @endif
                @endforeach
            @endif
        @endforeach
            @if($paginator->hasMorePages())

                <a href="{{$paginator->nextPageUrl()}}">Next</a>
            @else
                <a href="{{$paginator->previousPageUrl()}}">Prev</a>
            @endif

    </div>

@endif
