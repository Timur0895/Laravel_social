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

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
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

      #element::-webkit-scrollbar-thumb{
        background-color: {{Auth::user()->messenger_color}} !important;
      }

    </style>      
  @endauth
  <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script defer src="{{ asset('js/index.js') }}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css"
    integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div id="app">
    <nav id="navbar" class="fixed bg-white h-screen right-0 z-10 w-1/6">
      <div class="flex flex-col h-screen">
        <div class="bg-slate-400 h-16">

          @guest
          <ul class="flex flex-row justify-between items-center px-4 py-3">
            @if (Route::has('login'))
            <li class="nav-item">
              <a class="nav-link bg-green-600 text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link bg-green-600 text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
          </ul>
          @else
          <div class="flex justify-center items-center px4 py-3">
            <a id="navbarDropdown" class="nav-item capitalize" href="/profile" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }}
            </a>
          </div>
          @endguest

        </div>
        <div class="bg-yellow-200 h-36">
          <div class="w-full justify-around flex items-center flex-row">
          </div>
        </div>
        <div class="bg-blue-200 h-2/3 justify-center flex items-center flex-col">
          <div class="p-3 w-full">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
              <form method="GET" action="{{route('getSearch')}}">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input name="search" type="text" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full pl-8  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search ...">     
              </form>
            </div>
          </div>
          <ul class="h-full justify-center flex items-center flex-col">
            <li><a href="/">Home</a></li>
            <li><a href="{{ route("friends") }}">Friends</a></li>
            <li><a href="{{ route("news") }}">News</a></li>
            <li><a href="{{ route("chatify") }}">Chat</a></li>
            <li><a href="/profile">Profile</a></li>
          </ul>
        </div>
        <div class="bg-green-200 flex justify-center items-center h-28">
          @auth
          <a class="px-4 py-3 bg-green-400" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
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
      <div style="
      @guest
        background: gray;
      @else
        @if(!isset($user))
          {{Auth::user()->setColor}}
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