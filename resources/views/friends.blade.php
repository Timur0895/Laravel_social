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
    <div class="container w-full px-3 flex-row flex">
      <div class="w-3/4 py-2 px-4">
        <h1 class="text-center font-bold text-3xl px-2" style="color: {{Auth::user()->messenger_color}}">Друзья</h1>
        <div class="my-3">
          @if (!$friends->count())
            <p>
              <div class="p-2 h-full flex justify-center items-center text-white">
                <h1>У Вас нет друзей</h1>
              </div>
            </p>
          @else        
            @foreach ($friends as $friend)              
                <div class="timeline-body rounded-xl p-2 mb-3 border-2" style="background: white; border-color: {{Auth::user()->messenger_color}}">
                  <div class="timeline-header flex justify-start items-center flex-row ">
                    <span class="mr-4">
                      <a href="{{route('getProfile', ['usermail' => $friend->email])}}">
                        <img class="border-4 border-gray-200 rounded-full w-16 h-16 shadow-xl object-cover" 
                        src="@if($friend->image_path) 
                          {{asset('images/'. $friend->image_path)}} 
                        @else 
                          {{asset('/images/default.png')}} 
                        @endif" alt="profile_image" >
                      </a>                            
                    </span>
                    <h3 class="my-3 text-xl capitalize"><a href="{{route('getProfile', ['usermail' => $friend->email])}}">{{$friend->getNameAndSurname()}}</a></h3>
                      <small></small></span>
                  </div>
                  <div class="timeline-content h-48 w-full">                    
                    @if (!$friend->post()->count())
                      <div class="p-2 h-40 flex justify-center items-center border-2 border-gray-200 rounded-xl">
                        <h1>У {{$friend->getNameAndSurname()}} нет постов</h1>
                      </div>
                    @else
                      <div class="p-3 flex flex-row">
                        @foreach ($friend->lastPosts()->where('parent_id', null) as $post)
                          <div class="p-2 flex flex-col items-center border-2 border-gray-200 rounded-xl h-44">
                            <img class="h-32 w-32 rounded-xl" 
                              src="@if($post->image_path)
                                {{asset('images/'. $post->image_path)}}
                              @else
                                {{asset('/images/default.png')}}
                              @endif" alt="">
                            <h2 class="text-xl pb-2 capitalize">{{$post->title}}</h2>
                            <h4 class="italic text-base">{{$post->updated_at->diffForHumans()}}</h4>
                          </div>
                        @endforeach
                      </div>    
                    @endif
                  </div>
                </div>
            @endforeach
          @endif
        </div>
      </div>
      <div class="w-1/4 flex flex-col py-2 px-3">
        <h1 class="text-center font-bold text-3xl px-2" style="color: {{Auth::user()->messenger_color}}">Запросы</h1>
        <div class="flex flex-col rounded-xl p-2 my-3 border-2" style="background: white; border-color: {{Auth::user()->messenger_color}}">
          @if (!$requests->count()) 
            <div class="p-2 h-full flex justify-center items-center text-black">
              <h1>Запросов нет</h1>
            </div>
          @else
            @foreach ($requests as $user)
              @if (Auth::user()->hasFriendRequestPending($user))
                <p>В ожидании {{$user->getNameAndSurname()}} подтверждения запроса в друзья</p>
              @elseif (Auth::user()->hasFriendRequestReceived($user))
                <div class="p-2 h-full flex justify-between items-center text-black">
                  <h3 class="text-xl capitalize">{{$user->getNameAndSurname()}}</h3>
                  <a class="text-2xl font-semibold text-gray-100 hover:bg-green-800 bg-green-700 py-1 px-2 hover:text-white" href="{{ route('acceptFriend', ['usermail' => $user->email]) }}"><i class="fa-solid fa-plus fa-fw"></i> </a>
                </div>
              @elseif (Auth::user()->isFriendWith($user))
                <h2 class="text-2xl font-semibold hidden">{{$user->getNameAndSurname()}} у вас в друзьях</h2>
                
              @else
                <div class="flex justify-between items-center mt-2 pb-2 border-b-2 border-gray-200" >
                  <h3 class="text-xl mr-2 flex items-center"><img class="mr-2 w-12 h-12 rounded-full" 
                    src="@if($user->image_path)
                      {{asset('images/'. $user->image_path)}}
                    @else
                      {{asset('/images/default.png')}}
                    @endif" alt="">{{$user->getNameAndSurname()}}</h3>
                  <a class="text-2xl font-semibold text-gray-100 hover:bg-sky-900 bg-sky-800 py-1 px-2 hover:text-white" href="{{ route('addFriend', ['usermail' => $user->email]) }}"><i class="fa fa-user-plus fa-fw"></i></a>
                </div>
              @endif
            @endforeach              
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection