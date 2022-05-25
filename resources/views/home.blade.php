@extends('layouts.app')

@section('content')
  @guest
    <div class="h-screen">
      <div class="w-full flex flex-wrap">

        <!-- Login Section -->
        <div class="w-full md:w-1/2 flex flex-col" style="background: linear-gradient(to right, #2bc0e4, #eaecc6);">

          <div class="flex justify-center md:justify-start pt-12 md:pl-12 md:-mb-24">
            <img class="border-2 border-gray-700 w-24 h-24" src="{{asset('/images/logo.jpg')}}" alt="">
          </div>

          <div class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32">
            <p class="text-center text-3xl">Вход</p>
            <form class="flex flex-col pt-3 md:pt-8" method="POST" action="{{ route('login') }}">
              @csrf
              <div class="flex flex-col pt-4">
                <label for="email" class="text-lg">Почта</label>
                <div>
                  <input id="email" placeholder="Ваша почта" type="email" class="form-control @error('email') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="flex flex-col pt-4">
                <label for="password" class="text-lg">Пароль</label>
                <div>
                  <input id="password" type="password" placeholder="Ваш пароль" class="form-control @error('password') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" name="password" required autocomplete="current-password">

                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <button type="submit" class="bg-gray-800 hover:bg-gray-900 hover:shadow-lg text-white font-bold text-lg rounded-full p-2 mt-8 transition duration-150 ease-in-out">
                {{ __('Войти') }}
              </button>
            </form>
            <div class="text-center pt-12 pb-12">
              @if (Route::has('password.request'))
                <a class="underline font-semibold" href="{{ route('password.request') }}">
                  {{ __('Забыли пароль?') }}
                </a>
              @endif
              <p>Все еще нет аккаунта? <a href="{{ route('register') }}" class="underline font-semibold">Зарегистрируйтесь!</a></p>
            </div>
          </div>

        </div>

        <!-- Image Section -->
        <div class="w-1/2 shadow-2xl">
          <div class="object-cover w-full h-screen hidden md:block"></div>
        </div>
      </div>
    </div>
  @endguest
  @auth
    <div id="element" class="relative w-5/6 h-screen overflow-y-auto">
      <div class="bg-gradient-to-br from-gray-900 to-black">
        <div class="text-gray-300 container mx-auto p-8 overflow-hidden md:rounded-lg md:p-10 lg:p-12">
    
          <p class="font-sans text-4xl font-bold text-gray-200 max-w-5xl lg:text-7xl lg:pr-24 md:text-6xl">
            Добро пожаловать в небольшую социальную сеть!
          </p>
          <div class="h-10"></div>
          <p class="max-w-2xl font-serif text-xl text-gray-400 md:text-2xl">
            Социальная сеть предназначена для открытого использования и демонстрации возможности программировать интересные вещи 
          </p>
    
          <div class="h-32 md:h-40"></div>
    
          <div class="grid gap-8 md:grid-cols-2">
            <div class="flex flex-col justify-center">
              <p class="mb-2 self-start inline font-sans text-xl font-medium text-transparent" style="color: {{Auth::user()->messenger_color}}">
                Немного Статистики
              </p>
              <h2 class="text-4xl font-bold">FullStack разработка</h2>
              <div class="h-6"></div>
              <p class="font-serif text-xl text-gray-400 md:pr-10">
                Социальная сеть лишь отображение небольшого количества возможностей и тонкостей программирования Fullstack. 
              </p>
              <div class="h-8"></div>
              <div class="grid grid-cols-2 gap-4 pt-8 border-t border-gray-800">
                <div>
                  <p class="font-semibold" style="color: {{Auth::user()->messenger_color}}">Пользователей - {{$users->count()}} </p>
                  <div class="h-4"></div>
                  <p class="font-serif text-gray-400">
                    Краткая информация о зарегистрированных пользователях из базе данных
                  </p>
                </div>
                <div>
                  <p class="font-semibold" style="color: {{Auth::user()->messenger_color}}">Постов - {{$posts->count()}}</p>
                  <div class="h-4"></div>
                  <p class="font-serif text-gray-400">
                    Краткая информация о постах пользователей из базе данных
                  </p>
                </div>
              </div>
            </div>
            <div>
              <div class="-mr-24 rounded-lg md:rounded-l-full relative -top-64 left-0">
                <div class="animatebg flex justify-center">
                  <svg class="BgAnimation h-96" viewBox="0 0 602 602" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g opacity="0.15">
                          <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M201.337 87.437C193.474 79.5738 180.725 79.5738 172.862 87.437L87.437 172.862C79.5739 180.725 79.5739 193.474 87.437 201.337L400.663 514.563C408.526 522.426 421.275 522.426 429.138 514.563L514.563 429.138C522.426 421.275 522.426 408.526 514.563 400.663L201.337 87.437ZM30.4869 115.912C-8.82897 155.228 -8.82897 218.972 30.4869 258.287L343.713 571.513C383.028 610.829 446.772 610.829 486.088 571.513L571.513 486.088C610.829 446.772 610.829 383.028 571.513 343.713L258.287 30.4869C218.972 -8.82896 155.228 -8.82896 115.912 30.4869L30.4869 115.912Z"
                                stroke="url(#paint0_radial)" id="path_0"></path>
                          <path
                              d="M514.563 201.337C522.426 193.474 522.426 180.725 514.563 172.862L429.138 87.437C421.275 79.5738 408.526 79.5739 400.663 87.437L358.098 130.002L301.148 73.0516L343.713 30.4869C383.028 -8.82896 446.772 -8.82896 486.088 30.4869L571.513 115.912C610.829 155.228 610.829 218.972 571.513 258.287L357.802 471.999L300.852 415.049L514.563 201.337Z"
                              stroke="url(#paint1_radial)" id="path_1"></path>
                          <path
                              d="M243.901 471.999L201.337 514.563C193.474 522.426 180.725 522.426 172.862 514.563L87.437 429.138C79.5739 421.275 79.5739 408.526 87.437 400.663L301.148 186.952L244.198 130.002L30.4869 343.713C-8.82897 383.028 -8.82897 446.772 30.4869 486.088L115.912 571.513C155.228 610.829 218.972 610.829 258.287 571.513L300.852 528.949L243.901 471.999Z"
                              stroke="url(#paint2_radial)" id="path_2"></path>
                      </g>
                      <ellipse cx="295.027" cy="193.118" transform="translate(-295.027 -193.118)" rx="1.07306"
                               ry="1.07433" fill="#945DD6">
                          <animateMotion dur="10s" repeatCount="indefinite" rotate="auto">
                              <mpath xlink:href="#path_2"></mpath>
                          </animateMotion>
                      </ellipse>
                      <path d="M294.685 193.474L268.932 219.258"
                            transform="translate(-294.685 -193.474) rotate(45 294.685 193.474)"
                            stroke="url(#paint3_linear)">
                          <animateMotion dur="10s" repeatCount="indefinite" rotate="auto">
                              <mpath xlink:href="#path_2"></mpath>
                          </animateMotion>
                      </path>
                      <ellipse cx="295.027" cy="193.118" transform="translate(-295.027 -193.118)" rx="1.07306"
                               ry="1.07433" fill="#46737">
                          <animateMotion dur="5s" begin="1" repeatCount="indefinite" rotate="auto">
                              <mpath xlink:href="#path_2"></mpath>
                          </animateMotion>
                      </ellipse>
                      <path d="M294.685 193.474L268.932 219.258"
                            transform="translate(-294.685 -193.474) rotate(45 294.685 193.474)"
                            stroke="url(#paint7_linear)">
                          <animateMotion dur="5s" begin="1" repeatCount="indefinite" rotate="auto">
                              <mpath xlink:href="#path_2"></mpath>
                          </animateMotion>
                      </path>
                      <ellipse cx="476.525" cy="363.313" rx="1.07433" ry="1.07306"
                               transform="translate(-476.525 -363.313) rotate(90 476.525 363.313)" fill="#945DD6">
                          <animateMotion dur="10s" repeatCount="indefinite" rotate="auto">
                              <mpath xlink:href="#path_0"></mpath>
                          </animateMotion>
                      </ellipse>
                      <path d="M476.171 362.952L450.417 337.168"
                            transform="translate(-476.525 -363.313) rotate(-45 476.171 362.952)"
                            stroke="url(#paint4_linear)">
                          <animateMotion dur="10s" repeatCount="indefinite" rotate="auto">
                              <mpath xlink:href="#path_0"></mpath>
                          </animateMotion>
                      </path>
                      <ellipse cx="382.164" cy="155.029" rx="1.07433" ry="1.07306"
                               transform="translate(-382.164 -155.029) rotate(90 382.164 155.029)" fill="#F46737">
                          <animateMotion dur="10s" begin="1" repeatCount="indefinite" rotate="auto">
                              <mpath xlink:href="#path_0"></mpath>
                          </animateMotion>
                      </ellipse>
                      <path d="M381.81 154.669L356.057 128.885"
                            transform="translate(-381.81 -154.669) rotate(-45 381.81 154.669)"
                            stroke="url(#paint5_linear)">
                          <animateMotion dur="10s" begin="1" repeatCount="indefinite" rotate="auto">
                              <mpath xlink:href="#path_0"></mpath>
                          </animateMotion>
                      </path>
                      <ellipse cx="333.324" cy="382.691" rx="1.07306" ry="1.07433"
                               transform="translate(-333.324 -382.691) rotate(-180 333.324 382.691)" fill="#F46737">
                          <animateMotion dur="5s" begin="0" repeatCount="indefinite" rotate="auto">
                              <mpath xlink:href="#path_1"></mpath>
                          </animateMotion>
                      </ellipse>
                      <path d="M333.667 382.335L359.42 356.551"
                            transform="scale(-1 1) translate(-333.667 -382.335) rotate(45 333.667 382.335)"
                            stroke="url(#paint6_linear)">
                          <animateMotion dur="5s" begin="0" repeatCount="indefinite" rotate="auto">
                              <mpath xlink:href="#path_1"></mpath>
                          </animateMotion>
                      </path>
                      <ellipse cx="165.524" cy="93.9596" rx="1.07306" ry="1.07433"
                               transform="translate(-165.524 -93.9596)" fill="#F46737">
                          <animateMotion dur="10s" begin="3" repeatCount="indefinite" rotate="auto">
                              <mpath xlink:href="#path_0"></mpath>
                          </animateMotion>
                      </ellipse>
                      <path d="M165.182 94.3159L139.429 120.1"
                            transform="translate(-165.182 -94.3159) rotate(45 165.182 94.3159)"
                            stroke="url(#paint7_linear)">
                          <animateMotion dur="10s" begin="3" repeatCount="indefinite" rotate="auto">
                              <mpath xlink:href="#path_0"></mpath>
                          </animateMotion>
                      </path>
                      <ellipse cx="476.525" cy="363.313" rx="1.07433" ry="1.07306"
                               transform="translate(-476.525 -363.313) rotate(90 476.525 363.313)" fill="#13ADC7">
                          <animateMotion dur="12s" begin="4" repeatCount="indefinite" rotate="auto">
                              <mpath xlink:href="#path_0"></mpath>
                          </animateMotion>
                      </ellipse>
                      <path d="M476.171 362.952L450.417 337.168"
                            transform="translate(-476.525 -363.313) rotate(-45 476.171 362.952)"
                            stroke="url(#paint11_linear)">
                          <animateMotion dur="12s" begin="4" repeatCount="indefinite" rotate="auto">
                              <mpath xlink:href="#path_0"></mpath>
                          </animateMotion>
                      </path>
                      <defs>
                          <radialGradient id="paint0_radial" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse"
                                          gradientTransform="translate(301 301) rotate(90) scale(300)">
                              <stop offset="0.333333" stop-color="#FBFBFB"></stop>
                              <stop offset="1" stop-color="white" stop-opacity="0"></stop>
                          </radialGradient>
                          <radialGradient id="paint1_radial" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse"
                                          gradientTransform="translate(301 301) rotate(90) scale(300)">
                              <stop offset="0.333333" stop-color="#FBFBFB"></stop>
                              <stop offset="1" stop-color="white" stop-opacity="0"></stop>
                          </radialGradient>
                          <radialGradient id="paint2_radial" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse"
                                          gradientTransform="translate(301 301) rotate(90) scale(300)">
                              <stop offset="0.333333" stop-color="#FBFBFB"></stop>
                              <stop offset="1" stop-color="white" stop-opacity="0"></stop>
                          </radialGradient>
                          <linearGradient id="paint3_linear" x1="295.043" y1="193.116" x2="269.975" y2="218.154"
                                          gradientUnits="userSpaceOnUse">
                              <stop stop-color="#945DD6"></stop>
                              <stop offset="1" stop-color="#945DD6" stop-opacity="0"></stop>
                          </linearGradient>
                          <linearGradient id="paint4_linear" x1="476.529" y1="363.31" x2="451.461" y2="338.272"
                                          gradientUnits="userSpaceOnUse">
                              <stop stop-color="#945DD6"></stop>
                              <stop offset="1" stop-color="#945DD6" stop-opacity="0"></stop>
                          </linearGradient>
                          <linearGradient id="paint5_linear" x1="382.168" y1="155.027" x2="357.1" y2="129.989"
                                          gradientUnits="userSpaceOnUse">
                              <stop stop-color="#F46737"></stop>
                              <stop offset="1" stop-color="#F46737" stop-opacity="0"></stop>
                          </linearGradient>
                          <linearGradient id="paint6_linear" x1="333.309" y1="382.693" x2="358.376" y2="357.655"
                                          gradientUnits="userSpaceOnUse">
                              <stop stop-color="#F46737"></stop>
                              <stop offset="1" stop-color="#F46737" stop-opacity="0"></stop>
                          </linearGradient>
                          <linearGradient id="paint7_linear" x1="165.54" y1="93.9578" x2="140.472" y2="118.996"
                                          gradientUnits="userSpaceOnUse">
                              <stop stop-color="#F46737"></stop>
                              <stop offset="1" stop-color="#F46737" stop-opacity="0"></stop>
                          </linearGradient>
                          <linearGradient id="paint8_linear" x1="414.367" y1="301.156" x2="439.435" y2="276.118"
                                          gradientUnits="userSpaceOnUse">
                              <stop stop-color="#13ADC7"></stop>
                              <stop offset="1" stop-color="#13ADC7" stop-opacity="0"></stop>
                          </linearGradient>
                          <linearGradient id="paint9_linear" x1="515.943" y1="288.238" x2="541.339" y2="291.454"
                                          gradientUnits="userSpaceOnUse">
                              <stop stop-color="#13ADC7"></stop>
                              <stop offset="1" stop-color="#13ADC7" stop-opacity="0"></stop>
                          </linearGradient>
                          <linearGradient id="paint10_linear" x1="117.001" y1="230.619" x2="117.36" y2="258.193"
                                          gradientUnits="userSpaceOnUse">
                              <stop stop-color="#945DD6"></stop>
                              <stop offset="1" stop-color="#945DD6" stop-opacity="0"></stop>
                          </linearGradient>
                          <linearGradient id="paint11_linear" x1="476.529" y1="363.31" x2="451.461" y2="338.272"
                                          gradientUnits="userSpaceOnUse">
                              <stop stop-color="#13ADC7"></stop>
                              <stop offset="1" stop-color="#13ADC7" stop-opacity="0"></stop>
                          </linearGradient>
                      </defs>
                  </svg>
                </div>
              </div>
            </div>
          </div>
    
          <div class="h-32 md:h-40"></div>
    
          <p class="font-serif text-4xl">
            <span style="color: {{Auth::user()->messenger_color}}">Данный проект</span>
    
            <span class="text-gray-600">включает в себя использование различных технологий <br> Web-разработки</span>
          </p>
    
          <div class="h-32 md:h-40"></div>
    
          <div class="grid gap-4 md:grid-cols-3">
            
            <div class="flex-col p-8 py-16 rounded-lg shadow-2xl hover:shadow-cyan-500/40 transition duration-500 ease-in-out md:p-12 bg-gradient-to-b from-gray-900 to-black">
              <p class="flex items-center justify-center text-4xl font-semibold text-indigo-400 bg-indigo-800 rounded-full shadow-lg w-14 h-14">
                1
              </p>
              <div class="h-6"></div>
              <p class="font-serif text-3xl">
                Frontend-разработка. Включает в себя HTML, CSS, Tailwind, Javascript
              </p>
            </div>
            <div class="flex-col p-8 py-16 rounded-lg shadow-2xl hover:shadow-cyan-500/40 transition duration-500 ease-in-out md:p-12 bg-gradient-to-bl from-gray-900 to-black">
              <p class="flex items-center justify-center text-4xl font-semibold text-teal-400 bg-teal-800 rounded-full shadow-lg w-14 h-14">
                2
              </p>
              <div class="h-6"></div>
              <p class="font-serif text-3xl">Backend-разработка. Состоит из Laravel, MySQL</p>
            </div>
          </div>
    
          <div class="h-40"></div>
    
          <div class="grid gap-8 md:grid-cols-3">
            <div class="flex flex-col justify-center md:col-span-2">
              <p class="mb-2 self-start inline font-sans text-xl font-medium" style="color: {{Auth::user()->messenger_color}}">
                Детали разработки проекта
              </p>
              <h2 class="text-4xl font-bold">SCRUM - спринты</h2>
              <div class="h-6"></div>
              <p class="font-serif text-xl text-gray-400 md:pr-10">
                Проект разрабатывался путем разбиения задач на раздельные спринты. Каждый спринт имеет основную цель разработки
              </p>
              <div class="h-8"></div>
              <div class="pt-8 border-t border-gray-800">
                <h3 class="text-2xl text-gray-300 font-bold mb-6 text-center">Спринты проекта</h3>

                <ol class="border-l-2 border-gray-500">
                  <li>
                    <div class="md:flex flex-start">
                      <div class="-ml-3 w-6 h-6 flex items-center justify-center rounded-full bg-slate-800">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3" style="color: {{Auth::user()->messenger_color}}" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                          <path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm64-192c0-8.8 7.2-16 16-16h288c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16v-64zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path>
                        </svg>
                      </div>
                      <div class="block p-6 rounded-lg shadow-xl hover:shadow-cyan-500/40 transition duration-500 ease-in-out bg-gradient-to-bl from-gray-900 to-black w-[50rem] ml-6 mb-10 ">
                        <div class="flex justify-between mb-4">
                          <a href="#!" class="font-medium duration-300 transition ease-in-out text-sm" style="color: {{Auth::user()->messenger_color}}">Авторизация, Страница пользователя</a>
                          <a href="#!" class="font-medium duration-300 transition ease-in-out text-sm" style="color: {{Auth::user()->messenger_color}}">1 неделя</a>
                        </div>
                        <p class="text-gray-200 mb-6">
                          На даннном этапе я сделал авторизацию, логин и регистрация, страницу профиля. На странице профиля авторизованный пользователь может редактировать свои личные данные, добавить аватар и баннер все сохраняетсяв БД и выводится на странице профиля. Также добавил функционал CRUD для постов пользователя на той же странице, также ввиде визуальной фичи добавил возможность выбора заднего фона из ряда цветов для удобства. И фронт и бек делал по документациям.
                        </p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="md:flex flex-start">
                      <div class="-ml-3 w-6 h-6 flex items-center justify-center rounded-full bg-slate-800">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3" style="color: {{Auth::user()->messenger_color}}" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                          <path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm64-192c0-8.8 7.2-16 16-16h288c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16v-64zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path>
                        </svg>
                      </div>
                      <div class="block p-6 rounded-lg shadow-xl hover:shadow-cyan-500/40 transition duration-500 ease-in-out bg-gradient-to-bl from-gray-900 to-black w-[50rem] ml-6 mb-10">
                        <div class="flex justify-between mb-4">
                          <a href="#!" class="font-medium duration-300 transition ease-in-out text-sm" style="color: {{Auth::user()->messenger_color}}">Страница Поиска и Друзей</a>
                          <a href="#!" class="font-medium duration-300 transition ease-in-out text-sm" style="color: {{Auth::user()->messenger_color}}">2 неделя</a>
                        </div>
                        <p class="text-gray-200 mb-6">
                          Создал контроллер для поиска по сайту, поиск по имени, создал страницу друзья. Используя документацию Laravel сделать возможность добавить в друзья, отправление запроса, подтверждение запроса, отображение странцы друга включая его цветовую схему.
                        </p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="md:flex flex-start">
                      <div class="-ml-3 w-6 h-6 flex items-center justify-center rounded-full bg-slate-800">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3" style="color: {{Auth::user()->messenger_color}}" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                          <path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm64-192c0-8.8 7.2-16 16-16h288c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16v-64zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path>
                        </svg>
                      </div>
                      <div class="block p-6 rounded-lg shadow-xl hover:shadow-cyan-500/40 transition duration-500 ease-in-out bg-gradient-to-bl from-gray-900 to-black w-[50rem] ml-6 mb-10">
                        <div class="flex justify-between mb-4">
                          <a href="#!" class="font-medium duration-300 transition ease-in-out text-sm" style="color: {{Auth::user()->messenger_color}}">Страница Новостей, Лайки, Комментарии и доработки Frontend</a>
                          <a href="#!" class="font-medium duration-300 transition ease-in-out text-sm" style="color: {{Auth::user()->messenger_color}}">3 неделя</a>
                        </div>
                        <p class="text-gray-200 mb-6">
                          Итак по порядку сначала поработал на страницей News там отобразил все посты которые существуют. Далее отображение статуса друг или добавить в друзья на странице другого пользователя. Добавил фунцкию удалить из друзей. Следующим шагом было лайки и комменты, создал связи, контроллеры таблицы в бд для этого. Пришлось изрядно повозиться с Relations из документации Laravel, комментировать можно только пользователей в друзьях, лайкать можно любых пользователей, самолайканье тоже убрал. Так по мелочи дорабатывал визулку, дропдаун для коменнтов, счетчики лайков и комментов.
                        </p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="md:flex flex-start">
                      <div class="-ml-3 w-6 h-6 flex items-center justify-center rounded-full bg-slate-800">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3" style="color: {{Auth::user()->messenger_color}}" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                          <path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm64-192c0-8.8 7.2-16 16-16h288c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16v-64zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path>
                        </svg>
                      </div>
                      <div class="block p-6 rounded-lg shadow-xl hover:shadow-cyan-500/40 transition duration-500 ease-in-out bg-gradient-to-bl from-gray-900 to-black w-[50rem] ml-6 mb-10">
                        <div class="flex justify-between mb-4">
                          <a href="#!" class="font-medium duration-300 transition ease-in-out text-sm" style="color: {{Auth::user()->messenger_color}}">Страница Чата</a>
                          <a href="#!" class="font-medium duration-300 transition ease-in-out text-sm" style="color: {{Auth::user()->messenger_color}}">4 неделя</a>
                        </div>
                        <p class="text-gray-200 mb-6">
                          Изначально хотел воспользоваться инструментом Chatify. Система чата на Laravel в режиме реального времени использующая JQuery. Однако этот подход мне не поравился и решил самостоятельно переписать код данной системы без JQuery. Пришлось переделать все от Фронтэнда до Бэкэнда. Сейчас можно отправлять сообщения друзьям, видеть их список, онлайн или нет. В сообщениях можно увидеть прочитали ли собеседник ваше сообщение или нет, время отправки сообщения. В списке собеседников также отображается последнее сообщение либо от себя, либо от пользователя. Добавил функционал уведомлений о непрочитаных сообщений для каждого пользователя и отображения ввиде счетчика. Можно отправлять собеседнику картинки, архивы, видео. У пользователя есть возможность добавить диалог в избранное и возможность удалить диалог с собеседником.
                        </p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="md:flex flex-start">
                      <div class="-ml-3 w-6 h-6 flex items-center justify-center rounded-full bg-slate-800">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3" style="color: {{Auth::user()->messenger_color}}" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                          <path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm64-192c0-8.8 7.2-16 16-16h288c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16v-64zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path>
                        </svg>
                      </div>
                      <div class="block p-6 rounded-lg shadow-xl hover:shadow-cyan-500/40 transition duration-500 ease-in-out bg-gradient-to-bl from-gray-900 to-black w-[50rem] ml-6 mb-10">
                        <div class="flex justify-between mb-4">
                          <a href="#!" class="font-medium duration-300 transition ease-in-out text-sm" style="color: {{Auth::user()->messenger_color}}">Меню на сайте. Доработка Frontend</a>
                          <a href="#!" class="font-medium duration-300 transition ease-in-out text-sm" style="color: {{Auth::user()->messenger_color}}">5 неделя</a>
                        </div>
                        <p class="text-gray-200 mb-6">
                          Оформление Меню для сайта. Пофиксил на странице пользователя возможность выбора цвета фона и текста. Данный выбор сохраняется в БД. Задал цвет по умолчанию. Отображение и вывод error сообщений в чате, профиле, друзьях. Доработал Фронт на страницах Входа и Регистрации.
                        </p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="md:flex flex-start">
                      <div class="-ml-3 w-6 h-6 flex items-center justify-center rounded-full bg-slate-800">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3" style="color: {{Auth::user()->messenger_color}}" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                          <path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm64-192c0-8.8 7.2-16 16-16h288c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16v-64zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path>
                        </svg>
                      </div>
                      <div class="block p-6 rounded-lg shadow-xl hover:shadow-cyan-500/40 transition duration-500 ease-in-out bg-gradient-to-bl from-gray-900 to-black w-[50rem] ml-6 mb-10">
                        <div class="flex justify-between mb-4">
                          <a href="#!" class="font-medium duration-300 transition ease-in-out text-sm" style="color: {{Auth::user()->messenger_color}}">Домашняя страница, Уведомления о лайках и комментах.</a>
                          <a href="#!" class="font-medium duration-300 transition ease-in-out text-sm" style="color: {{Auth::user()->messenger_color}}">6 неделя</a>
                        </div>
                        <p class="text-gray-200 mb-6">На данном этапе было выполнено несколько разнообразных задач. Первым делом оформление и наполнение контентом домашней страницы. Далее на страница профиля добавил анимацию  для Loading(preloader). На странице поиска добавил проверку и отображение нужных кнопок. Если пользователь уже в друзьях, то запись что в друзьях, если не в друзьях - то добавить в друзья. Добавил статус онлайн. В меню добавил отображение уведомлений о запросе в друзья и новоых сообщениях. Пожалуй сам трудным иодновременно интересным было добавление функционала оповещении о действиях в режиме реального времени. Как оказалось, разобравшись с документацией, все довольно просто. При помощи Laravel Database Notifications мы можем видеть кто прокомменторовал и пролайкал наши посты, с ссылкой на профиль</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="md:flex flex-start">
                      <div class="-ml-3 w-6 h-6 flex items-center justify-center rounded-full bg-slate-800">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3" style="color: {{Auth::user()->messenger_color}}" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                          <path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm64-192c0-8.8 7.2-16 16-16h288c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16v-64zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path>
                        </svg>
                      </div>
                      <div class="block p-6 rounded-lg shadow-xl hover:shadow-cyan-500/40 transition duration-500 ease-in-out bg-gradient-to-bl from-gray-900 to-black w-[50rem] ml-6 mb-10">
                        <div class="flex justify-between mb-4">
                          <a href="#!" class="font-medium duration-300 transition ease-in-out text-sm" style="color: {{Auth::user()->messenger_color}}">Категории, лайки и комментарии, страница News</a>
                          <a href="#!" class="font-medium duration-300 transition ease-in-out text-sm" style="color: {{Auth::user()->messenger_color}}">7 неделя</a>
                        </div>
                        <p class="text-gray-200 mb-6">Отображение лайков и комментариев на странице Новостей - фронт доработки. Добавил Preloader с небольшим использованием Javascript. Добавил функционал категории. Пришлось изрядно повозиться с Relations "Многие ко многим". На текущий момент можно добавлять несколько категории одной записи поста, при редактировании поста также можно изменить и категории. При нажатии на категорию отображается спикос всех постов по данной тематике в обратном порядке. Все отображается на странцие News. Переделал section About Us под существующи категории и возможности выбора постов по ним.</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="md:flex flex-start">
                      <div class="-ml-3 w-6 h-6 flex items-center justify-center rounded-full bg-slate-800">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3" style="color: {{Auth::user()->messenger_color}}" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                          <path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm64-192c0-8.8 7.2-16 16-16h288c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16v-64zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path>
                        </svg>
                      </div>
                      <div class="block p-6 rounded-lg shadow-xl hover:shadow-cyan-500/40 transition duration-500 ease-in-out bg-gradient-to-bl from-gray-900 to-black w-[50rem] ml-6 mb-10">
                        <div class="flex justify-between mb-4">
                          <a href="#!" class="font-medium duration-300 transition ease-in-out text-sm" style="color: {{Auth::user()->messenger_color}}">New Web Design</a>
                          <a href="#!" class="font-medium duration-300 transition ease-in-out text-sm" style="color: {{Auth::user()->messenger_color}}">8 неделя</a>
                        </div>
                        <p class="text-gray-200 mb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas placerat facilisis mollis. Duis sagittis ligula in sodales vehicula.</p>
                      </div>
                    </div>
                  </li>
                </ol>
              </div>
            </div>
            <div>
              <div class="-mr-24 rounded-lg md:rounded-l-full shadow-xl shadow-cyan-500/50 h-96 bg-gradient-to-br from-gray-900 to-black">
                
              </div>
            </div>
          </div>
    
          <div class="h-10 md:h-30"></div>
        </div>
      </div>
    </div>
  @endauth
@endsection