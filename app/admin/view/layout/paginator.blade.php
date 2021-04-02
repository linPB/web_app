@if($paginator->getNumPages() > 1)
    <ul class="pagination justify-content-center">
        @if( $paginator->getPrevUrl() )
        <li class="page-item"><a class="page-link" href="{{$paginator->getPrevUrl()}}">&laquo; 上一页</a></li>
        @endif

        @foreach( $paginator->getPages() as $page )
            @if ($page['url'])
                <li @if($page['isCurrent']) class="page-item active" @else class="page-item" @endif> <a class="page-link" href="{{$page['url']}}">{{$page['num']}}</a> </li>
            @else
                <li class="disabled"><span>{{$page['num']}}</span></li>
            @endif
        @endforeach

        @if( $paginator->getNextUrl() )
        <li class="page-item"><a class="page-link" href="{{$paginator->getNextUrl()}}">下一页 &raquo;</a></li>
        @endif
    </ul>
@endif
