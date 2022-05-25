@extends('layouts.app')

@section('content')
<div class="h-screen">
  <div class="w-full flex flex-wrap">
    <!-- Image Section -->
    <div class="w-1/2 shadow-2xl">
      <div class="object-cover w-full h-screen hidden md:block"></div>
    </div>

    <!-- Register Section -->
    <div class="w-full md:w-1/2 flex flex-col" style="background: linear-gradient(to left, #2bc0e4, #eaecc6);">

      <div class="flex justify-center md:justify-end pt-12 md:pr-12 md:-mb-12">
        <img class="border-2 border-gray-700 w-24 h-24" src="{{asset('/images/logo.jpg')}}" alt="">
      </div>

      <div class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32">
        <p class="text-center text-3xl">{{ __('Регистрация') }}</p>
        <form class="flex flex-col pt-3 md:pt-8" method="POST" action="{{ route('register') }}">
          @csrf
            <div class="flex flex-col pt-4">
              <label for="name" class="text-lg">{{ __('Имя') }}</label>
              <div>
                <input id="name" type="text" placeholder="Ваше имя" class="form-control @error('name') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="flex flex-col pt-4">
              <label for="surname" class="text-lg">{{ __('Фамилия') }}</label>
              <div>
                <input id="surname" type="text" placeholder="Ваша фамилия" class="form-control @error('surname') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                @error('surname')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="flex flex-col pt-4">
              <label for="email" class="text-lg">{{ __('Почта') }}</label>
              <div>
                <input id="email" type="email" placeholder="Ваша почта" class="form-control @error('email') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="flex flex-col pt-4">
              <label for="password" class="text-lg">{{ __('Пароль') }}</label>
              <div>
                <input id="password" type="password" placeholder="Придумайте пароль" class="form-control @error('password') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" name="password" required autocomplete="new-password">

                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="flex flex-col pt-4">
              <label for="password-confirm" class="text-lg">{{ __('Подтвердите') }}</label>
              <input type="password" id="password-confirm" placeholder="Подтвердите" name="password_confirmation" required autocomplete="new-password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
            </div>

            <button type="submit" class="bg-gray-800 hover:bg-gray-900 hover:shadow-lg text-white font-bold text-lg rounded-full p-2 mt-8 transition duration-150 ease-in-out">
              {{ __('Присоединиться') }}
            </button>
        </form>
        <div class="text-center pt-12 pb-12">
          <p>Уже есть аккаунт? <a href="/" class="underline font-semibold">Войдите.</a></p>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
