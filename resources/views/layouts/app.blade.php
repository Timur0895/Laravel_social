<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(window).on('load', function () {
      var $preloader = $('#p_prldr'),
          $svg_anm   = $preloader.find('.svg_anm');
      $svg_anm.fadeOut();
      $preloader.fadeOut('slow');
    });
  </script>
  
  

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="https://cdn.jsdelivr.net/npm/@tailwindcss/custom-forms@0.2.1/dist/custom-forms.css" rel="stylesheet"/>
  <link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css'/>
  <link href="{{ asset('css/chatify/dark.mode.css') }}" rel="stylesheet" />    
    
  @auth
    <style>

      .timeline::before{
        background: {{Auth::user()->messenger_color}} !important;
      }

      .timeline .timeline-body:before{
        border-right-color: {{Auth::user()->messenger_color}} !important;
      }
      
      figure div:after{
        border-color: {{Auth::user()->messenger_color}} !important;
      }
      
      #element::-webkit-scrollbar-thumb{
        background-color: {{Auth::user()->messenger_color}};
      }

      [x-cloak] {
        display: none;
      }
      .svg-icon {
        width: 1em;
        height: 1em;
      }

      .svg-icon path,
      .svg-icon polygon,
      .svg-icon rect {
        fill: #333;
      }

      .svg-icon circle {
        stroke: #4691f6;
        stroke-width: 1;
      }


    </style>      
  @endauth
  <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script defer src="{{ asset('js/index.js') }}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css"
    integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div id="p_prldr" class="fixed w-full h-full opacity-75 z-50 flex justify-center items-center bg-black">
    <div class="contpre">
      <span class="svg_anm"></span>
      <figure>
        <div></div><div></div>
        <div></div><div></div>
        <div></div><div></div>
        <div></div><div></div>
      </figure>
    </div>
  </div>
  <div id="app">
    <nav id="navbar" class="fixed h-screen right-0 z-10 w-1/6" style="
      @guest
        background: none;
        display: none
      @else
        display: block;
        @if(!isset($user))
          @if(Auth::user()->setColor)
            {{Auth::user()->setColor}}
          @else
            background: linear-gradient(to left, #2bc0e4, #eaecc6);
          @endif
        @else
          @if(!$user->friends()->count())
            {{Auth::user()->setColor}}
          @else
            {{$user->setColor}}
          @endif
        @endif
      @endguest
      ">
      <div class="flex flex-col h-screen">
        <div class="h-16">
          @guest
          <ul class="flex flex-row justify-between items-center px-4 py-3">
            @if (Route::has('login'))
            <li class="nav-item">
              <a class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
              <a class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
          </ul>
          @else
          <div class="flex justify-between items-center px-4 py-2" style="color: {{Auth::user()->messenger_color}}">
            <img class="border-2 rounded-full w-14 h-14" style="border-color: {{Auth::user()->messenger_color}}" src="@if(Auth::user()->image_path) 
                {{asset('/images/'.Auth::user()->image_path)}} 
              @else 
                {{asset('/images/default.png')}} 
              @endif" alt="">
            <a id="navbarDropdown" class="my-2 mx-2 inline-block px-3 py-2 grow font-bold leading-tight capitalize rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" style="color: {{Auth::user()->messenger_color}};" href="/profile" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false" v-pre>
              <div class="absolute inline-block top-8 right-10 bottom-auto left-auto translate-x-2/4 -translate-y-1/2 rotate-0 skew-x-0 skew-y-0 scale-x-100 scale-y-100 py-1 px-2.5 text-xs leading-none text-center whitespace-nowrap align-baseline font-bold text-white rounded-full z-10 bg-green-500">Online</div>
              {{ Auth::user()->name }}
            </a>           
          </div>
          @endguest

        </div>
        <div class="justify-center flex items-center flex-col">
          <div class="px-3 w-full">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-3">
              <form method="GET" action="{{route('getSearch')}}">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input name="search" type="text" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full pl-8  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search ...">     
              </form>
            </div>
          </div>
          <ul class="mt-4 h-full w-full justify-center flex items-center flex-col">
            @auth
              <li class="w-full text-center my-1 px-1">
                <a href="/" class="@if(Auth::user()->messenger_color == "#535c68" || Auth::user()->messenger_color == "#3c40c6" || Auth::user()->messenger_color == "#1e272e") bg-gray-200 hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-300 @endif inline-block w-full px-6 py-2.5 bg-gray-800 font-medium text-xs leading-tight uppercase rounded-md shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out" style="color: {{Auth::user()->messenger_color}}">Home</a>
              </li>
              <li class="w-full text-center my-1 px-1">
                <a href="{{ route("friends") }}" class="relative @if(Auth::user()->messenger_color == "#535c68" || Auth::user()->messenger_color == "#3c40c6" || Auth::user()->messenger_color == "#1e272e") bg-gray-200 hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-300 @endif inline-block w-full px-6 py-2.5 bg-gray-800 font-medium text-xs leading-tight uppercase rounded-md shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out" style="color: {{Auth::user()->messenger_color}}">
                  @if (Auth::user()->friendRequests()->count() > 0)
                    <span class="absolute left-0 top-0 h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-green-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span> 
                  @endif
                  Friends
                </a>
              </li>
              <li class="w-full text-center my-1 px-1"><a href="{{ route("news") }}" class="@if(Auth::user()->messenger_color == "#535c68" || Auth::user()->messenger_color == "#3c40c6" || Auth::user()->messenger_color == "#1e272e") bg-gray-200 hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-300 @endif inline-block w-full px-6 py-2.5 bg-gray-800 font-medium text-xs leading-tight uppercase rounded-md shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out" style="color: {{Auth::user()->messenger_color}}">News</a></li>
              <li class="w-full text-center my-1 px-1">
                <a href="{{ route("chatify") }}" class="relative @if(Auth::user()->messenger_color == "#535c68" || Auth::user()->messenger_color == "#3c40c6" || Auth::user()->messenger_color == "#1e272e") bg-gray-200 hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-300 @endif inline-block w-full px-6 py-2.5 bg-gray-800 font-medium text-xs leading-tight uppercase rounded-md shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out" style="color: {{Auth::user()->messenger_color}}">
                  @if (Auth::user()->toMe()->where('seen', 0)->count() > 0)
                    <span class="absolute left-0 top-0 h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-green-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span> 
                  @endif
                   Chat
                </a>
              </li>
              <li class="w-full text-center my-1 px-1"><a href="/profile" class="@if(Auth::user()->messenger_color == "#535c68" || Auth::user()->messenger_color == "#3c40c6" || Auth::user()->messenger_color == "#1e272e") bg-gray-200 hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-300 @endif inline-block w-full px-6 py-2.5 bg-gray-800 font-medium text-xs leading-tight uppercase rounded-md shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out" style="color: {{Auth::user()->messenger_color}}">Profile</a></li>
            @endauth
            @guest
              <li class="w-full text-center my-1 px-1">
                <a href="/" class="inline-block text-gray-200 hover:text-gray-100 w-full px-6 py-2.5 bg-gray-800 font-medium text-xs leading-tight uppercase rounded-md shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">Home</a>
              </li>
              <li class="w-full text-center my-1 px-1"><a href="{{ route("friends") }}" class="inline-block text-gray-200 hover:text-gray-100 w-full px-6 py-2.5 bg-gray-800 font-medium text-xs leading-tight uppercase rounded-md shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">Friends</a></li>
              <li class="w-full text-center my-1 px-1"><a href="{{ route("news") }}" class="inline-block text-gray-200 hover:text-gray-100 w-full px-6 py-2.5 bg-gray-800 font-medium text-xs leading-tight uppercase rounded-md shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">News</a></li>
              <li class="w-full text-center my-1 px-1"><a href="{{ route("chatify") }}" class="inline-block text-gray-200 hover:text-gray-100 w-full px-6 py-2.5 bg-gray-800 font-medium text-xs leading-tight uppercase rounded-md shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">Chat</a></li>
              <li class="w-full text-center my-1 px-1"><a href="/profile" class="inline-block text-gray-200 hover:text-gray-100 w-full px-6 py-2.5 bg-gray-800 font-medium text-xs leading-tight uppercase rounded-md shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">Profile</a></li>
            @endguest
          </ul>
        </div>
        <div class="flex justify-center items-center">
          @auth
            <form id="logout-form" action="{{ route('Logout') }}" method="POST">
              @csrf
              <button type="submit" class="my-2 mx-2 inline-block px-6 py-2 border-2 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" style="border-color: {{Auth::user()->messenger_color}}; color: {{Auth::user()->messenger_color}};">{{ __('Выйти') }}</button>
            </form>
          @endauth
        </div>
        <div class="py-2 px-3">
          @auth
            @foreach (Auth::user()->notifications->where('read_at', null) as $notification)
            <form action="{{route('readNotify', ['id' => $notification->id])}}" method="post">
              @csrf
              @if ($notification->type == "App\Notifications\commentedPost")
                <button type="submit" class="bg-yellow-100 rounded-lg py-3 px-2 text-base text-yellow-700 mb-3 show">
                  <a href="{{route('getProfile', ['usermail' => $notification->data['usermail']])}}" class="capitalize font-bold text-yellow-800">{{$notification->data['user_name']}}</a> прокомментировал вашу запись <strong>"{{$notification->data['post_title']}}"</strong>
                </button>
              @else
                <button type="submit" class="bg-green-100 rounded-lg py-3 px-2 text-base text-green-700 mb-3 show">
                  <a href="{{route('getProfile', ['usermail' => $notification->data['usermail']])}}" class="capitalize font-bold text-green-800">{{$notification->data['user_name']}}</a> лайкнул вашу запись <strong>"{{$notification->data['post_title']}}"</strong>
                </button>                
              @endif
            </form>
            @endforeach              
          @endauth
        </div>
      </div>
    </nav>


    <main>
      @if (session('success'))
      <div class="container">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
      @endif
      @if (session('error'))
      <div class="container">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
      @endif
      <div class="bg-cover bg-no-repeat" style="
      @guest
        background-image: url({{asset('/images/bg-guest.jpg')}});
      @else
        @if(!isset($user))
          @if(Auth::user()->setColor)
            {{Auth::user()->setColor}}
          @else
            background-image: url({{asset('/images/bg-guest.jpg')}});
          @endif          
        @else
          @if(!$user->friends()->count())
            {{Auth::user()->setColor}}
          @else
            {{$user->setColor}}
          @endif
        @endif
      @endguest
      ">
        @yield('content')
      </div>
    </main>
    
  </div>
</body>

</html>