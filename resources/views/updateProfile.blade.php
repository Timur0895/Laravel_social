@extends('layouts.app')


@section('content')
<div id="element" class="relative w-5/6 h-screen overflow-y-auto">
  <div class="flex flex-col pb-5">
    <div class="relative flex flex-col mb-7">
      <div class="flex flex-col justify-center items-center">
        <img class="w-full 2xl:h-64 h-64 shadow-lg object-cover"
          src="@if(Auth::user()->banner_path) 
                {{asset('/banners/'.Auth::user()->banner_path)}} 
              @else 
                {{asset('/banners/default.jpg')}} 
              @endif
          " alt="user-pic">
        <div class="flex flex-row justify-between items-center w-5/6">
          <div class="flex flex-row ">
            <img class="border-4 border-gray-200 rounded-full w-48 h-48 -mt-10 shadow-xl object-cover"
              src="@if(Auth::user()->image_path) 
                    {{asset('/images/'.Auth::user()->image_path)}} 
                  @else 
                    {{asset('/images/default.png')}} 
                  @endif"
              alt="user-pic">
            <div class="flex flex-col justify-center items-center pl-5">
              <h1 class="font-bold text-3xl text-center my-3 text-white capitalize">{{ Auth::user()->name }} {{ Auth::user()->surname }}</h1>              
            </div>
          </div>
          <div class="p-4 flex flex-row text-center h-full">
            <ul class="flex flex-row justify-around">
              <li class="flex flex-col px-2">
                <a class="hover:text-white font-semibold block text-gray-200 text-2xl mb-1">215</a>
                <h3 class="text-gray-300 text-lg">Posts</h3>
              </li>
              <li class="flex flex-col px-2">
                <a class="hover:text-white font-semibold mb-1 block text-gray-200 text-2xl">745</a>
                <h3 class="text-gray-300 text-lg">Followers</h3>
              </li>
              <li class="flex flex-col px-2">
                <a class="hover:text-white font-semibold mb-1 block text-gray-200 text-2xl">340</a>
                <h3 class="text-gray-300 text-lg">Following</h3>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container flex flex-col w-full h-full">
      <form class="container p-5 bg-slate-200 rounded-3xl" method="POST" action="/update" enctype="multipart/form-data">
        @csrf
        <div class="relative z-0 mb-4 w-full group border-b-2 border-gray-600">
            <input id="email" type="email" name="email" class="block py-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-700 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" autocomplete="email" required value="{{ $user->email }}" />
            <label for="floating_email" class="absolute text-base text-gray-900 dark:text-gray-900 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-gray-700 peer-focus:dark:text-gray-700 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
        </div>
        <div class="relative z-0 mb-4 w-full group border-b-2 border-gray-600">
            <input type="password" name="password" id="password" class="block py-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-700 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required autocomplete="new-password" />
            <label for="password" class="absolute text-base text-gray-900 dark:text-gray-900 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-gray-700 peer-focus:dark:text-gray-700 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Текущий пароль</label>
        </div>
        <div class="relative z-0 mb-4 w-full group border-b-2 border-gray-600">
            <input id="password-confirm" type="password" name="newPassword" class="block py-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-700 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" autocomplete="new-password" required />
            <label for="password-confirm" class="absolute text-base text-gray-900 dark:text-gray-900 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-gray-700 peer-focus:dark:text-gray-700 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Новый Пароль</label>
        </div>
        <div class="relative z-0 mb-4 w-full group border-b-2 border-gray-600">
            <input id="password-confirm" type="password" name="newPassword_confirmation" class="block py-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-700 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required autocomplete="new-password" />
            <label for="password-confirm" class="absolute text-base text-gray-900 dark:text-gray-900 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-gray-700 peer-focus:dark:text-gray-700 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Подтвердите пароль</label>
        </div>
        <div class="grid xl:grid-cols-2 xl:gap-6">
          <div class="relative z-0 mb-4 w-full group border-b-2 border-gray-600">
              <input type="text" name="name" id="name" class="block py-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-700 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer capitalize" placeholder=" " required value="{{ $user->name }}" autocomplete="name"/>
              <label for="name" class="absolute text-base text-gray-900 dark:text-gray-900 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-gray-700 peer-focus:dark:text-gray-700 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Имя</label>
          </div>
          <div class="relative z-0 mb-4 w-full group border-b-2 border-gray-600">
              <input type="text" name="surname" id="surname" class="block py-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-700 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  autocomplete="surname" value="{{ $user->surname }}"/>
              <label for="surname" class="absolute text-base text-gray-900 dark:text-gray-900 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-gray-700 peer-focus:dark:text-gray-700 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Фамилия</label>
          </div>
        </div>
        <div class="grid xl:grid-cols-2 xl:gap-6">
          <label class=" text-gray-500 font-bold rounded-full mx-1 hover:text-gray-600 flex justify-center items-center">
            <i class="fa-solid fa-image fa-fw fa-3x m-r-3"></i>
            <span class="text-2xl leading-normal">
                Загрузить Аватар
            </span>
            <input type="file" name="image" class="hidden">
          </label>
          <label class=" text-gray-500 font-bold rounded-full mx-1 hover:text-gray-600 flex justify-center items-center">
            <i class="fa-solid fa-image fa-fw fa-3x m-r-3"></i>
            <span class="text-2xl leading-normal">
                Загрузить Фон
            </span>
            <input type="file" name="banner" class="hidden">
          </label>
        </div>
        <button type="submit" class="btn btn-base btn-info my-2 px-5 py-2">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection