@if($child)
    <li class="dropdown"><a href="/tin-tuc/danh-muc/{{$child->slug}}">{{$child->name}}</a></li>
    @if($child->cats)
        <ul>
            @foreach($child->cats as $item)
                @include('guest.components.child_category',['child'=>$item])
            @endforeach
        </ul>
    @endif
@endif