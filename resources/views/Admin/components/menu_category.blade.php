<option value="{{$child->id}}" class="text-gray ml-5">---{{$child->name}}</option>
@if($child->cats)
        @foreach ($child->cats as $item)
             <option value="{{$child->id}}" class="text-green ml-5">--------{{$item->name}}</option>
        @endforeach
@endif 
