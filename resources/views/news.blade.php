@extends('layouts.app')

@section('content')
<div id="element" class="relative w-5/6 h-screen overflow-y-auto">
  <div class="px-2 md:px-5">
    <div>
      <!-- Last Posts -->
    </div>
    <div class="h-full">
      <div class="container mx-auto flex flex-wrap py-3">
        <div class="flex bg-gray-100 rounded-md w-full">
          <!-- Posts Section -->
          <section class="w-full md:w-2/3 flex flex-col items-center px-3">

            @foreach ($posts as $post)
            
              <article class="flex flex-col shadow my-4 w-full">
                  <!-- Article Image -->
                  <a href=" 
                      @if(!(Auth::user()->id === $post->user_id))
                        {{route('getProfile', ['usermail' => $post->user->email])}}
                      @else 
                        /profile 
                      @endif" class="hover:opacity-75">
                      <img src="
                      @if($post->image_path) 
                        {{asset('/images/'.$post->image_path)}}
                      @endif">
                  </a>
                  <div class="bg-white flex flex-col justify-start p-6">
                      <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">Technology</a>
                      <a href="
                          @if(!(Auth::user()->id === $post->user_id))
                            {{route('getProfile', ['usermail' => $post->user->email])}}
                          @else 
                            /profile 
                          @endif" class="text-3xl font-bold hover:text-gray-700 pb-4">{{$post->title}}</a>
                      <p class="text-sm pb-3">
                          By <a href="
                          @if(!(Auth::user()->id === $post->user_id))
                            {{route('getProfile', ['usermail' => $post->user->email])}}
                          @else 
                            /profile 
                          @endif" class="font-semibold capitalize hover:text-gray-800">{{$post->user->getNameAndSurname()}}</a>, Published {{$post->created_at->diffForHumans()}}
                      </p>
                      <a href="
                          @if(!(Auth::user()->id === $post->user_id))
                            {{route('getProfile', ['usermail' => $post->user->email])}}
                          @else 
                            /profile 
                          @endif" class="pb-6">{{ Str::limit($post->description, 15) }}</a>
                      <a href="
                          @if(!(Auth::user()->id === $post->user_id))
                            {{route('getProfile', ['usermail' => $post->user->email])}}
                          @else 
                            /profile 
                          @endif" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
                  </div>
              </article>                
            @endforeach
  
          </section>
          <!-- Sidebar Section -->
          <aside class="w-full md:w-1/3 flex flex-col items-center px-3">
  
              <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                  <p class="text-xl font-semibold pb-5">About Us</p>
                  <p class="pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.</p>
                  <a href="#" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
                      Get to know us
                  </a>
              </div>
  
              <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                  <p class="text-xl font-semibold pb-5">Instagram</p>
                  <div class="grid grid-cols-3 gap-3">
                      <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=1">
                      <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=2">
                      <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=3">
                      <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=4">
                      <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=5">
                      <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=6">
                      <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=7">
                      <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=8">
                      <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=9">
                  </div>
                  <a href="#" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-6">
                      <i class="fab fa-instagram mr-2"></i> Follow
                  </a>
              </div>
  
          </aside>
        </div>
    </div>
    </div>
  </div>
</div>
@endsection