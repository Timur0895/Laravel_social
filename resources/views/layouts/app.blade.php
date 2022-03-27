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
        <div class="bg-yellow-200 h-28">
          <img src="" alt="">
        </div>
        <div class="bg-blue-200 h-2/3 justify-center flex items-center flex-col">
          <div class="w-full h-28 justify-around flex items-center flex-row">
            <div class="style-switcher">
              <div class="colors">
                <span class="color-1 inline-block h-16 w-16" onclick="setActiveStyle('color-1')"></span>
                <span class="color-2 inline-block h-16 w-16" onclick="setActiveStyle('color-2')"></span>
                <span class="color-3 inline-block h-16 w-16" onclick="setActiveStyle('color-3')"></span>
                <span class="color-4 inline-block h-16 w-16" onclick="setActiveStyle('color-4')"></span>
                <span class="color-5 inline-block h-16 w-16" onclick="setActiveStyle('color-5')"></span>
                <span class="color-6 inline-block h-16 w-16" onclick="setActiveStyle('color-6')"></span>
                <span class="color-7 inline-block h-16 w-16" onclick="setActiveStyle('color-7')"></span>
                <span class="color-8 inline-block h-16 w-16" onclick="setActiveStyle('color-8')"></span>
              </div>
            </div>
            <!--<span onclick="" class="mx-2 py-3 border-2 border-white rounded-lg flex-1 text-center" style="background: linear-gradient(to right, #e8cbc0, #636fa4)">Light</span>
                <span class="mx-2 py-3 border-2 border-white rounded-lg flex-1 text-center text-white" style="background: linear-gradient(to right, #0f2027, #203a43, #2c5364)">Dark</span>
                <span class="mx-2 py-3 border-2 border-white rounded-lg flex-1 text-center" style="background: linear-gradient(to right, #7f7fd5, #86a8e7, #91eae4)">Aqua</span>
                <span class="mx-2 py-3 border-2 border-white rounded-lg flex-1 text-center" style="background: linear-gradient(to right, #eacda3, #d6ae7b)">Coffee</span>-->
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
      @yield('content')
    </main>
  </div>
  <script>
    let elY = 0;
    let scrollY = 0;
    window.addEventListener("scroll", function() {
        const el = document.querySelector('#navbar');
        const height = el.offsetHeight;
        const pos = window.pageYOffset;
        const diff = scrollY - pos;

        elY = Math.min(0, Math.max(-height, elY + diff));
        el.style.position = pos >= height ? 'fixed' : pos === 0 ? 'absolute' : el.style.position;
        el.style.transform = `translateY(${el.style.position === 'fixed' ? elY : 0}px)`;

        scrollY = pos;
    })
  </script>
</body>

</html>