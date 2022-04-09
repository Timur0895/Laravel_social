@extends('layouts.app')

@section('content')
  <div id="element" class="relative w-5/6 h-screen overflow-y-auto">
    <div class="container mx-auto my-4 text-gray-100">
      <h1 class="mb-4 text-3xl">Результаты поиска: "{{Request::input('search')}}"</h1>
      @if (!$users->count())
          <p>Пользователей не найдено!</p>
      @else
        @foreach ($users as $user)
          @if (false === (Auth::user()->id === $user->id))
            <div class="flex justify-between items-center mt-2 pb-2 border-b-2 border-gray-200" >
              <a href="{{route('getProfile', ['usermail' => $user->email])}}">
                <h3 class="text-xl px-2 mr-2 flex items-center capitalize"><img class="mr-2 w-16 h-16 rounded-full" 
                  src="@if($user->image_path)
                    {{asset('images/'. $user->image_path)}}
                  @else
                    {{asset('/images/default.png')}}
                  @endif" alt="">{{$user->getNameAndSurname()}}
                </h3>
              </a>
              <a class="text-2xl font-semibold text-gray-100 hover:bg-sky-900 bg-sky-800 py-1 px-2 hover:text-white" href="{{ route('addFriend', ['usermail' => $user->email]) }}"><i class="fa fa-user-plus fa-fw"></i></a>
            </div>              
          @endif
        @endforeach
      @endif        
    </div>        
  </div>
  
@endsection