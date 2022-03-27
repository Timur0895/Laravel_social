<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Chatik</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</head>
<body>
  <nav class="fixed bg-white h-screen right-0 z-10 w-1/6">
    <div class="flex flex-col h-screen">
      <div class="bg-slate-400 h-16">
        <ul class="flex flex-row justify-between items-center px-4 py-3">
          <li><a class="nav-link px-4 py-3 bg-green-600 text-white" href="{{ route('login') }}">{{ __('Login') }}</a></li>
          <li><a class="nav-link px-4 py-3 bg-green-600 text-white" href="{{ route('register') }}">{{ __('Register') }}</a></li>
        </ul>
      </div>
      <div class="bg-yellow-200 h-28">
        <img src="" alt="">
      </div>
      <div class="bg-blue-200 h-2/3 justify-center flex items-center flex-col">
        <ul class="">
          <li><a href="/">Home</a></li>
          <li><a href="{{ route("friends") }}">Friends</a></li>
          <li><a href="{{ route("news") }}">News</a></li>
          <li><a href="{{ route("chat") }}">Chat</a></li>
          <li><a href="{{ route("profile") }}">Profile</a></li>
        </ul>
      </div>
      <div class="bg-green-200 flex justify-center items-center h-20">
        <a class="px-4 py-3 bg-green-900"  href="">Logout</a>
      </div>
    </div>
  </nav>
  @yield('content')
</body>
</html>