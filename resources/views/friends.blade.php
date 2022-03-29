@extends('layouts.app')

@section('content')
<div id="element" class="relative w-5/6 h-screen overflow-y-auto">
  <div class="flex flex-col pb-5">
    @if (session()->has('message'))
    <div class="container flex justify-center text-center px-2">
      <p class="w-2/6 my-2 text-gray-50 bg-green-500 rounded-2xl py-2 px-4">
        {{ session()->get('message') }}
      </p>
    </div>
    @endif
    <div class="container w-full px-4 my-2">
      <h1>Your Friends</h1>
      @foreach ($users as $user)

        @if (Auth::user()->hasFriendRequestPending($user))
          <p>В ожидании {{$user->getNameAndSurname()}} подтверждения запроса в друзья</p>
        @elseif (Auth::user()->hasFriendRequestReceived($user))
          <a href="#">{{$user->getNameAndSurname()}} Подтвердить дружбу</a>
        @elseif (Auth::user()->isFriendWith($user))
          {{$user->getNameAndSurname()}} у вас в друзьях
        @else
        
          <a href="{{ route('addFriend', ['usermail' => $user->email]) }}">{{$user->getNameAndSurname()}} Добавить в друзья</a>
        @endif
      @endforeach
          

      @if (!$friends->count())
        <p>
          You dont have friends
        </p>
      @else        
        @foreach ($friends as $friend)
          <h3 class="my-3 text-3xl"><a href="">{{$friend->getNameAndSurname()}}</a></h3>
          @if ($friend->email)
            <p>{{$friend->email }}</p>
          @endif
        @endforeach
      @endif
    </div>
  </div>
</div>
@endsection