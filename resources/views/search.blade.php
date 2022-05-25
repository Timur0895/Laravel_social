@extends('layouts.app')

@section('content')
  <div id="element" class="relative w-5/6 h-screen overflow-y-auto" 
      style="
          @if(!isset($user))
            {{Auth::user()->setColor}}
          @else
            {{$user->setColor}}
          @endif
  ">
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
              @if (Auth::user()->isFriendWith($user))
                <button type="button" class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Ваш Друг</button>
              @else
                <a class="text-2xl font-semibold text-gray-100 hover:bg-sky-900 bg-sky-800 py-1 px-2 hover:text-white" href="{{ route('addFriend', ['usermail' => $user->email]) }}"><i class="fa fa-user-plus fa-fw"></i></a>                  
              @endif
            </div>              
          @endif
        @endforeach
      @endif        
    </div>        
  </div>
  
@endsection