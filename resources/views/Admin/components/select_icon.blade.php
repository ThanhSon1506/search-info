@foreach(fetchIcons() as $item)
    <option value="{{$item->icon}}">
        {{$item->icon}}
    </option>
@endforeach