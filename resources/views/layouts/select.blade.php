<select name="categories[]" class="select w-full rounded-xl border-gray-200" multiple data-mdb-clear-button="true">
  @if (isset($categories))
    @foreach ($categories as $item)
      <option class="w-fit my-1 px-3 py-2 rounded-full text-gray-500 bg-gray-200 font-semibold text-sm flex align-center cursor-pointer active:bg-gray-300 transition duration-300 ease" value="{{$item->id}}">
        {{$item->title}}     
      </option>  
    @endforeach      
  @endif
</select>

