@extends('layouts.app')

@section('content')
  <div class="messenger relative w-5/6 h-screen" style="{{Auth::user()->setColor}}">   
    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="messenger-listView flex flex-col">
      {{-- Header and search bar --}}
      <div class="m-header border-b-2 border-r-2" style="border-color: {{Auth::user()->messenger_color}}">
        <nav>
          <a href="{{route('chatify')}}"><i class="fas fa-inbox" style="color: {{Auth::user()->messenger_color}}"></i> <span class="messenger-headTitle" style="color: {{Auth::user()->messenger_color}}">Сообщения</span> </a>
          {{-- header buttons --}}
            
        </nav>
        {{-- Tabs --}}
        <div class="messenger-listView-tabs">
          <a href="#"  data-view="users" style="color: {{Auth::user()->messenger_color}}"><span class="far fa-user"></span> Люди</a>
        </div>
      </div>
      {{-- tabs and lists --}}
      <div class="m-body contacts-container border-r-2" style="border-color: {{Auth::user()->messenger_color}}">
        {{-- Lists [Users/Group] --}}
        {{-- ---------------- [ User Tab ] ---------------- --}}
        <div class="messenger-tab users-tab app-scroll block" data-view="users">
          {{-- Favorites --}}
          @if (Auth::user()->favorites()->count())
            <div class="favorites-section border-b-2" style="border-color: {{Auth::user()->messenger_color}}">
              <p class="messenger-title text-center" style="color: {{Auth::user()->messenger_color}}">Favorites</p>
              <div class="mx-3 items-center flex flex-row">
                @foreach (Auth::user()->favorites() as $favorite)
                  <div class="flex items-center flex-col mx-1">
                    <form action="{{route('chatProfile', ['id' => Auth::user()->friends()->where('id', $favorite->favorite_id)->first()->id])}}" method="get">
                      @csrf
                      <button type="submit">
                        <img class="w-14 w h-14 rounded-full border-2" style="border-color: {{Auth::user()->messenger_color}}" src="
                          @if(Auth::user()->friends()->where('id', $favorite->favorite_id)->first()->image_path)
                            {{asset('/images/'.Auth::user()->friends()->where('id', $favorite->favorite_id)->first()->image_path)}}
                          @else
                            {{asset('/images/default.png')}}
                          @endif" alt="">
                        <h1 class="my-2 capitalize" style="color: {{Auth::user()->messenger_color}}">{{Auth::user()->friends()->where('id', $favorite->favorite_id)->first()->name}}</h1>      
                      </button>
                    </form>
                  </div>
                @endforeach
              </div>
            </div>
          @endif
          {{-- Contact --}}
          @foreach ($friends as $friend)
            <form action="{{route('chatProfile', ['id' => $friend->id])}}" method="get">
              @csrf
              <button type="submit" class="w-full">
                <div class="flex justify-between w-full text-gray-700 hover:text-blue-400 hover:bg-gray-500 rounded-md px-2 py-2 my-1">
                  <div class="flex">
                    <div class="
                      @if($friend->active_status == 1)
                        bg-green-500
                      @else
                        bg-gray-700
                      @endif
                      h-2 w-2 m-2 rounded-full inline-block">
                    </div>
                    <div class="block semibold text-base px-2 capitalize" style="color: {{Auth::user()->messenger_color}}">
                      {{$friend->name}}
                    </div>
                  </div>
                  <div class="relative block text-sm font-normal text-gray-700">                    
                    @if (isset($user))
                      @if ($friend->dialogs()->where('to_id', Auth::user()->id)->where('seen', 0)->count() > 0)
                        <div class="absolute inline-block top-0 -left-8 py-1 px-2.5 text-xs text-center whitespace-nowrap align-baseline font-bold bg-indigo-700 text-white rounded-full z-20">+ {{$friend->dialogs()->where('to_id', Auth::user()->id)->where('seen', 0)->count()}}</div>                          
                      @else
                        @if ($friend->dialogs()->where('to_id', Auth::user()->id)->last() !== null)
                          @if ($lastMessage->from_id == Auth::user()->id)
                            <h1 class="relative -left-3 top-0 text-base text-gray-300">You: {{$lastMessage->body}}</h1> 
                          @else
                            <h1 class="relative -left-3 top-0 text-base text-gray-300">{{$lastMessage->body}}</h1>
                          @endif
                        @endif
                      @endif
                    @else
                      @if ($friend->dialogs()->where('to_id', Auth::user()->id)->where('seen', 0)->count() > 0)
                        <div class="absolute inline-block top-0 -left-8 py-1 px-2.5 text-xs text-center whitespace-nowrap align-baseline font-bold bg-indigo-700 text-white rounded-full z-20">+ {{$friend->dialogs()->where('to_id', Auth::user()->id)->where('seen', 0)->count()}}</div>                          
                      @else                        
                        @if ($friend->dialogs()->where('to_id', Auth::user()->id)->last() !== null)
                          @if ($lastMessage->from_id == Auth::user()->id)
                            <h1 class="relative -left-3 top-0 text-base text-gray-300">You: {{$lastMessage->body}}</h1> 
                          @else
                            <h1 class="relative -left-3 top-0 text-base text-gray-300">{{$lastMessage->body}}</h1>
                          @endif
                        @endif                       
                      @endif
                    @endif                    
                  </div>
                </div>
              </button>
            </form>
          @endforeach
        </div>
      </div>
    </div>
      {{-- ----------------------Messaging side---------------------- --}}
    <div class="messenger-messagingView">
      {{-- header title [conversation name] amd buttons --}}
      <div class="m-header m-header-messaging bg-gray-700 h-[50px]">
        <nav class="flex justify-between items-center">
          {{-- header back button, avatar and user name --}}
          <div style="display: inline-flex;">
            @if (isset($user))
              <div class="flex flex-row items-center">
                <img class="w-8 h-8 mr-2 rounded-full" src="
                @if($user->image_path) 
                  {{asset('images/'. $user->image_path)}} 
                @else 
                  {{asset('/images/default.png')}} 
                @endif" alt="">
                <a href="{{route('getProfile', ['usermail' => $user->email])}}" class="capitalize user-name text-white hover:text-gray-100 transition duration-300 ease-in-out">{{$user->name}}</a>
              </div>
            @else
              <a href="" class="capitalize user-name text-white hover:text-gray-100 transition duration-300 ease-in-out">Диалоги</a>                
            @endif            
          </div>
          {{-- header buttons --}}
          @if (isset($user))
            <nav class="flex flex-row items-center">
              
              <form action="{{route('makeFavorite', ['id' => $user->id])}}" method="post">
                @csrf
                <button type="submit" class="
                  @if($favorite) 
                    @if($favorite->favorite_id == $user->id)
                    text-green-400 hover:text-gray-400
                    @else
                    text-gray-400 hover:text-green-400
                    @endif
                  @else
                    text-gray-400 hover:text-green-400
                  @endif mx-1">
                  <i class="fa-solid fa-star fa-lg"></i>
                </button>
              </form>
              <button type="button" class="mx-1" data-bs-toggle="modal" data-bs-target="#colors">
                <i class="text-red-500 hover:text-red-600 fa-solid fa-trash fa-lg"></i>
              </button>              
              <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="colors" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
                  <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-clip-padding rounded-md outline-none text-current" style="{{Auth::user()->setColor}}">
                    <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                      <h5 class="text-xl font-medium leading-normal text-gray-200" id="exampleModalScrollableLabel">
                        Хотите удалить этот диалог?
                      </h5>
                    </div>                    
                    <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"
                      class="inline-block px-6 py-2.5 bg-gray-800 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                      Отмена
                    </button>
                    <form action="{{route('deleteDialog', ['id' => $user->id])}}" method="post">
                      @csrf
                      <button type="submit"
                      class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out"
                      data-bs-dismiss="modal">
                      Удалить
                      </button>                    
                    </form>
                  </div>
                  </div>
                </div>
              </div>   
            </nav>
          @endif
        </nav>
      </div>
      {{-- Messaging area --}}
      <div class="flex flex-col m-body messages-container app-scroll h-[93%] absolute w-full">
        <div id="element" class="messages h-[84%] px-4 flex flex-col-reverse py-4 overflow-y-scroll relative">
          @if (session()->has('message'))
            <div class="container flex justify-center text-center px-2">
              <p class="w-2/6 my-2 text-gray-50 bg-green-500 rounded-2xl py-2 px-4">
                {{ session()->get('message') }}
              </p>
            </div>
          @endif
          @if (isset($messages))
            @foreach ($messages as $message)
              @if ($message->from_id == $user->id )
                <div class="flex justify-start my-1">
                  @if ($message->attachment)
                    <div class="flex flex-col px-2 py-1 w-fit bg-gray-600 rounded-md">
                      <h1 class="text-gray-200 text-base inline-block">{{$message->body}}</h1>
                      <div class="flex justify-center">
                        <img class="w-32 h-32" src="{{asset('/messageFiles/'.$message->attachment)}}" alt="">
                      </div>
                      <span class="ml-5 text-white text-xs relative top-1">
                        @if ($message->seen)
                          <i class="fa-solid fa-check-double mr-1"></i>
                        @else
                          <i class="fa-solid fa-check mr-1"></i>
                        @endif
                        {{ $message->created_at->diffForHumans() }}
                      </span>
                    </div>
                  @else
                    <div class="flex px-2 py-1 w-fit rounded-md bg-gray-600">
                      <h1 class="text-white text-base">{{$message->body}}</h1><span class="ml-4 text-white text-xs relative top-3">
                        @if ($message->seen)
                          <i class="fa-solid fa-check-double mr-1"></i>
                        @else
                          <i class="fa-solid fa-check mr-1"></i>
                        @endif{{ $message->created_at->diffForHumans() }}</span>                
                    </div>
                  @endif
                </div>
              @endif
              @if ($message->to_id == $user->id )
                <div class="flex justify-end my-1">
                  @if ($message->attachment)
                    <div class="flex flex-col px-2 py-1 w-fit rounded-md" style="background: {{Auth::user()->messenger_color}}">
                      <h1 class="text-gray-200 text-base inline-block">{{$message->body}}</h1>
                      <div class="flex justify-center">
                        <img class="w-32 h-32" src="{{asset('/messageFiles/'.$message->attachment)}}" alt="">
                      </div>
                      <span class="ml-5 text-white text-xs relative top-1">
                        @if ($message->seen)
                          <i class="fa-solid fa-check-double mr-1"></i>
                        @else
                          <i class="fa-solid fa-check mr-1"></i>
                        @endif
                        {{ $message->created_at->diffForHumans() }}
                      </span>
                    </div>
                  @else
                    <div class="flex px-2 py-1 w-fit rounded-md" style="background: {{Auth::user()->messenger_color}}">
                      <h1 class="text-white text-base">{{$message->body}}</h1><span class="ml-4 text-white text-xs relative top-3">
                        @if ($message->seen)
                          <i class="fa-solid fa-check-double mr-1"></i>
                        @else
                          <i class="fa-solid fa-check mr-1"></i>
                        @endif{{ $message->created_at->diffForHumans() }}</span>                
                    </div>
                  @endif
                </div>
              @endif
            @endforeach  
            <p class="message-hint center-el border-2 rounded-lg capitalize" style="border-color: {{Auth::user()->messenger_color}}"><span style="color: {{Auth::user()->messenger_color}}">{{$user->name}} ждет вашего сообщения</span></p>            
          @else
            <p class="message-hint center-el border-2 rounded-lg" style="border-color: {{Auth::user()->messenger_color}}"><span style="color: {{Auth::user()->messenger_color}}">Выберете друга и начните чат</span></p>
          @endif
        </div>
        
        {{-- Send Message Form --}}
        <div class="w-full h-[10%] py-4 border-t-2" style="border-color: {{Auth::user()->messenger_color}}">
          @if (isset($user))
          <form class="flex flex-row" id="message-form" method="POST" action="{{ route('sendMessage', ['id' => $user->id]) }}" enctype="multipart/form-data">
            @csrf
            <label class="mx-2 w-10 text-center"><span class="relative top-[10px] fas fa-paperclip fa-2xl" style="color: {{Auth::user()->messenger_color}}"></span><input type="file" class="hidden upload-attachment" name="file" accept="image/*, .txt, .rar, .zip" /></label>
            <textarea name="message" class="bg-gray-800 m-send app-scroll text-gray-100" placeholder="Ваше сообщение ..."></textarea>
            <button class="w-10 mx-2" type="submit"><span class="fas fa-paper-plane fa-2xl" style="color: {{Auth::user()->messenger_color}}"></span></button>
          </form> 
          @else
            <form class="flex flex-row" id="message-form" method="POST" action="" enctype="multipart/form-data">
              @csrf
              <label class="mx-2 w-10 text-center"><span class="relative top-[10px] fas fa-paperclip fa-2xl" style="color: {{Auth::user()->messenger_color}}"></span><input type="file" class="hidden upload-attachment" name="file" accept="image/*, .txt, .rar, .zip" /></label>
              <textarea name="message" class="bg-gray-800 m-send app-scroll text-gray-100" placeholder="Ваше сообщение ..."></textarea>
              <button class="w-10 mx-2" disabled><span class="fas fa-paper-plane fa-2xl" style="color: {{Auth::user()->messenger_color}}"></span></button>
            </form>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection

