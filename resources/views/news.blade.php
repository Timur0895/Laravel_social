@extends('layouts.app')

@section('content')
<div id="element" class="relative w-5/6 h-screen overflow-y-auto">
  <div class="px-2 md:px-5">
    <div>
      <!-- Last Posts -->
    </div>
    <div class="h-full">
      <div class="container mx-auto flex flex-wrap py-3">
        <div class="flex rounded-md w-full">
          <!-- Posts Section -->
          <section class="w-full md:w-3/4 flex flex-rows items-center px-3">
            <div class="h-full w-1/5 relative"><span class="w-1 absolute top-6 right-12 h-full" style="background: {{Auth::user()->messenger_color}};"></span></div>
            <div class="w-4/5 flex flex-col">
              @foreach ($posts as $post)
                <article class="bg-gray-100 relative flex flex-col shadow my-4 border-2" style="border-color: {{Auth::user()->messenger_color}};">
                  <span class="absolute top-1 h-4 -left-44 w-fit rounded-full text-lg" style="color: {{Auth::user()->messenger_color}};">{{$post->created_at->diffForHumans()}}</span>  
                  <span class="absolute top-3 h-4 -left-[60px] w-4 rounded-full" style="background: {{Auth::user()->messenger_color}};"></span>  
                  <!-- Article Image -->
                    <a href=" 
                        @if(!(Auth::user()->id === $post->user_id))
                          {{route('getProfile', ['usermail' => $post->user->email])}}
                        @else 
                          /profile 
                        @endif" class="hover:opacity-70 transition duration-300 ease">
                        <img src="
                        @if($post->image_path) 
                          {{asset('/images/'.$post->image_path)}}
                        @endif">
                    </a>
                    <div class="bg-white flex flex-col justify-start p-6">
                        <div class="flex flex-row items-center pb-2">
                          @foreach ($post->categories as $item)
                            <form action="{{route('getCategory', ['category' => $item->slug])}}" method="get">
                              @csrf
                              <button type="submit">
                                <span class="ml-1 px-3 py-2 rounded-full text-gray-500 bg-gray-200 font-semibold text-center text-sm flex align-center w-max cursor-pointer active:bg-gray-300 transition duration-300 ease">
                                  #{{$item->slug}}
                                </span>
                              </button>
                            </form>
                          @endforeach
                        </div>
                        <h1 class="text-3xl font-bold hover:text-gray-700 pb-4">{{$post->title}}</h1>
                        <p class="text-sm pb-3">
                            By <a href="
                            @if(!(Auth::user()->id === $post->user_id))
                              {{route('getProfile', ['usermail' => $post->user->email])}}
                            @else 
                              /profile 
                            @endif" class="font-semibold capitalize hover:text-gray-800">{{$post->user->getNameAndSurname()}}</a>, Published {{$post->created_at->diffForHumans()}}
                        </p>
                        <h3 class="font-medium text-base">{{ $post->description}}</h3>                        
                    </div>
                    <div class="timeline-likes px-4">
                      <div class="stats-right">
                        <span class="stats-text">{{$post->replies->count()}} Comments</span>
                        <span class="stats-text">{{$post->likes->count()}} Likes</span>
                      </div>
                    </div>
                    <div class="timeline-footer flex px-4 py-2">
                      @if ($post->user->id !== Auth::user()->id)
                        @if ($post->likes->count())
                          <form action="{{ route('deleteLike', ['statusId' => $post->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="m-r-15 text-inverse-lighter mr-2">                              
                              <i class="fa fa-thumbs-up fa-fw fa-xl m-r-3 text-blue-500 hover:text-gray-600" ></i>
                            </button>
                          </form>
                        @else
                          <a href="{{ route('getLike', ['statusId' => $post->id]) }}" class="m-r-15 text-inverse-lighter mr-2">                              
                            <i class="fa fa-thumbs-up fa-fw fa-xl m-r-3 text-gray-600 hover:text-blue-500" ></i>
                          </a>                             
                        @endif
                      @endif
                      <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseComments-{{$post->id}}" aria-expanded="false" aria-controls="collapseComments-{{$post->id}}"
                      class="m-r-15 text-inverse-lighter mr-2 text-gray-600 hover:text-gray-800">
                      <i class="fa fa-comments fa-fw fa-lg m-r-3"></i>
                      Comments
                      </button>                          
                    </div>
                    @foreach ($post->replies as $reply)
                    <div class="collapse" id="collapseComments-{{$post->id}}">
                      <div class="block bg-white">
                          <div class="timeline-comment-box px-3 py-2 mx-0 items-center flex">
                            <div class="user">
                              <img src="
                              @if(Auth::user()->id == $reply->user->id) 
                                @if(Auth::user()->image_path) 
                                  {{asset('/images/'.Auth::user()->image_path)}} 
                                @else 
                                  {{asset('/images/default.png')}} 
                                @endif
                              @else 
                                @if($reply->user->image_path) 
                                  {{asset('/images/'.$reply->user->image_path)}} 
                                @else 
                                  {{asset('/images/default.png')}} 
                                @endif
                              @endif" class="border-4 border-gray-200 rounded-full w-14 h-14 shadow-xl object-cover">
                            </div>
                            <div class="input flex items-center justify-between w-full">
                              <h1>{{$reply->description}}</h1>
                              <div class="flex flex-col items-center">
                                <h1 class="mb-2">{{$reply->created_at->diffForHumans()}}</h1>
                                @if (Auth::user()->id == $reply->user->id)
                                  <form action="{{route('deleteReply', ['statusId' => $reply->id])}}" method="post">
                                    @csrf
                                    <button class="m-r-15 text-inverse-lighter" type="submit">
                                      <i class="fa-solid fa-trash fa-fw fa-lg text-red-700"></i>
                                    </button>
                                  </form>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="timeline-comment-box mx-0">
                      <div class="user">
                        <img src="
                          @if(Auth::user()->image_path) 
                            {{asset('/images/'.Auth::user()->image_path)}} 
                          @else 
                            {{asset('/images/default.png')}} 
                          @endif" class="border-4 border-gray-200 rounded-full w-14 h-14 shadow-xl object-cover">
                      </div>
                      <div class="input">
                        <form action="{{ route('postReply', ['statusId' => $post->id]) }}" method="POST">
                          @csrf
                          <div class="input-group">
                            <input name="reply-{{$post->id}}" type="text" class="form-control rounded-corner" placeholder="Write a comment...">
                            <span class="input-group-btn p-l-10">
                              <button class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out" type="submit"> Comment</button>
                            </span>
                          </div>
                        </form>
                      </div>
                    </div>
                </article>                
              @endforeach
            </div>    
          </section>
          <!-- Sidebar Section -->
          <aside class="w-full md:w-1/4 flex flex-col items-center px-3">
  
              <div class="w-full bg-gray-100 shadow flex flex-col my-4 px-2 py-3 border-2" style="border-color: {{Auth::user()->messenger_color}};">
                  <p class="text-xl font-semibold px-2 pb-3">Хэштеги новостей</p>
                  <div class="grid gap-0 grid-cols-3">
                    @foreach ($categories as $item)
                      <form action="{{route('getCategory', ['category' => $item->slug])}}" method="get">
                        @csrf
                        <button type="submit">
                          <span class="mt-1 px-3 py-2 rounded-full text-gray-500 bg-gray-200 font-semibold text-center text-sm flex align-center w-max cursor-pointer active:bg-gray-300 transition duration-300 ease">
                            #{{$item->slug}}
                          </span>
                        </button>
                      </form>
                    @endforeach
                  </div>
              </div>
  
              <div class="w-full bg-gray-100 shadow flex flex-col my-4 p-6 border-2" style="border-color: {{Auth::user()->messenger_color}};">
                  <p class="text-xl font-semibold pb-5">Instagram</p>
                  <div class="grid grid-cols-3 gap-1">
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
              </div>
  
          </aside>
        </div>
    </div>
    </div>
  </div>
</div>
@endsection