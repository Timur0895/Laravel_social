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
  <!-- Style Switcher -->
  <link rel="stylesheet" href="/css/skins/color-1.css" class="alternate-style" title="color-1">
  <link rel="stylesheet" href="/css/skins/color-2.css" class="alternate-style" title="color-2" disabled="true">
  <link rel="stylesheet" href="/css/skins/color-3.css" class="alternate-style" title="color-3" disabled="true">
  <link rel="stylesheet" href="/css/skins/color-4.css" class="alternate-style" title="color-4" disabled="true">
  <link rel="stylesheet" href="/css/skins/color-5.css" class="alternate-style" title="color-5" disabled="true">
  <link rel="stylesheet" href="/css/skins/color-6.css" class="alternate-style" title="color-6" disabled="true">
  <link rel="stylesheet" href="/css/skins/color-7.css" class="alternate-style" title="color-7" disabled="true">
  <link rel="stylesheet" href="/css/skins/color-8.css" class="alternate-style" title="color-8" disabled="true">
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
            <div class="style-switcher ">
              <h2 class="capitalize pt-2 text-center">Выберете тему оформления</h2>
              <div class="colors grid grid-cols-4 gap-2 p-2">
                <span class="color-1 inline-block h-12 w-12 border-2 border-white rounded-lg" onclick="setActiveStyle('color-1')"></span>
                <span class="color-2 inline-block h-12 w-12 border-2 border-white rounded-lg" onclick="setActiveStyle('color-2')"></span>
                <span class="color-3 inline-block h-12 w-12 border-2 border-white rounded-lg" onclick="setActiveStyle('color-3')"></span>
                <span class="color-4 inline-block h-12 w-12 border-2 border-white rounded-lg" onclick="setActiveStyle('color-4')"></span>
                <span class="color-5 inline-block h-12 w-12 border-2 border-white rounded-lg" onclick="setActiveStyle('color-5')"></span>
                <span class="color-6 inline-block h-12 w-12 border-2 border-white rounded-lg" onclick="setActiveStyle('color-6')"></span>
                <span class="color-7 inline-block h-12 w-12 border-2 border-white rounded-lg" onclick="setActiveStyle('color-7')"></span>
                <span class="color-8 inline-block h-12 w-12 border-2 border-white rounded-lg" onclick="setActiveStyle('color-8')"></span>
              </div>
            </div>
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
            <li><a href="{{ route("chat") }}">Chat</a></li>
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
      <div style="background: var(--skin-color);">
        @yield('content')
      </div>
    </main>
  </div>
</body>

</html>