@extends('layouts.app')

@section('content')
  <div id="element" class="flex font-serif relative w-5/6 h-screen overflow-y-hidden">
    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="relative top-0 left-0 right-0 z-10 bg-transparent w-2/6 min-w-[200px] border-2 border-gray-700">
      <div class="absolute top-0 left-0 right-0 p-0 px-2 py-2 font-semibold bg-transparent">
        <nav class="m-2">
          <a class="text-gray-200 hover:text-gray-400" href="#"><i class="fas fa-inbox fa-lg"></i> <span class="">MESSAGES</span> </a>
          <nav class="inline-flex float-right">
            <a class="text-gray-200 hover:text-gray-400" href="#"><i class="fas fa-cog fa-lg settings-btn"></i></a>
          </nav>
        </nav>
        <input type="text" class="text-gray-200 mx-0 my-2 bg-gray-600 py-1 px-2 outline-none w-full rounded-md" placeholder="Search" />
        <div class="my-2 text-center">
          <h1 class="text-gray-200 font-semibold text-xl"><i class="fa-solid fa-comments mr-1"></i> Диалоги</h1>
        </div>                
      </div>
      <div class="mt-36 pt-3 h-full overflow-x-hidden overflow-y-auto">
        {{-- Favorites --}}
        <div class="px-3 ">
          <h1 class="text-lg text-gray-200 font-semibold text-center">Favorites</h1>
          <div class="w-fit">
            <img class="rounded-full w-12 h-12 border-4 border-sky-700" src="{{asset('/images/default.png')}}" alt="">
            <p class="text-lg text-gray-200 text-center">test</p>
          </div>
        </div>
        {{-- Contact --}}
        <div class="px-3" style="width: 100%;height: calc(100% - 200px);position: relative;">
          <div class="w-fit">
            <img class="rounded-full w-12 h-12 border-4 border-sky-700" src="{{asset('/images/default.png')}}" alt="">
            <p class="text-lg text-gray-200 text-center">test</p>
          </div>
          <div class="w-fit">
            <img class="rounded-full w-12 h-12 border-4 border-sky-700" src="{{asset('/images/default.png')}}" alt="">
            <p class="text-lg text-gray-200 text-center">test</p>
          </div>
        </div>
      </div>
    </div>
    <div></div>
    <div></div>
  </div>
@endsection