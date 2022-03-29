@extends('layouts.app')

@section('content')
  <div id="element" class="relative w-5/6 h-screen overflow-y-auto">
    <div class="container mx-auto my-4 text-gray-100">
      <h1 class="mb-4 text-3xl">Результаты поиска: {{Request::input('search')}}</h1>
      @if (!$users->count())
          <p>Пользователей не найдено!</p>
      @else
        @foreach ($users as $user)
          <h3 class="my-3 text-3xl"><a href="">{{$user->getNameAndSurname()}}</a></h3>
          @if ($user->email)
            <p>{{$user->email }}</p>
          @endif
          @foreach($user->post() as $post)
            @if ($post->title)
              <h4>{{ $post->title }}</h4>
            @endif
          @endforeach
        @endforeach
      @endif        
    </div>        
  </div>
  
@endsection