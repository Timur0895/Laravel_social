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
              @endif" alt="user-pic">
        <div class="flex flex-row justify-between items-center w-5/6">
          <div class="flex flex-row ">
            <img class="border-4 border-gray-200 rounded-full w-48 h-48 -mt-10 shadow-xl object-cover"
              src="@if(Auth::user()->image_path) 
                    {{asset('/images/'.Auth::user()->image_path)}}
                  @else 
                    {{asset('/images/default.png')}} 
                  @endif"
              alt="user-pic">
            <div class="flex flex-col items-center pl-5" >
              <h1 class="font-bold text-3xl text-center my-3 capitalize" style="color: white">{{ Auth::user()->name }} {{ Auth::user()->surname }}</h1>
              <a href="{{ route('editProfile') }}" class="btn btn-sm btn-info my-2 px-5 py-2">Редактировать</a>
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
    @if (session()->has('message'))
    <div class="container flex justify-center text-center px-2">
      <p class="w-2/6 my-2 text-gray-50 bg-green-500 rounded-2xl py-2 px-4">
        {{ session()->get('message') }}
      </p>
    </div>
    @endif
    <div class="container flex justify-between w-5/6 h-full">
      <h2 class="font-bold text-3xl text-center text-white px-2">Мои публикации</h2>
      <div id="accordion-collapse" data-accordion="collapse">
        <div id="accordion-collapse-heading-1">
          <button type="button" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
            aria-controls="accordion-collapse-body-1"
            class="uppercase text-xs font-extrabold px-5 py-3 rounded-3xl bg-gray-900 dark:bg-gray-800 text-gray-100 dark:text-white">
            Create Post
          </button>
        </div>
      </div>
    </div>

  

    <div class="container flex flex-col w-full h-full">
      <div class="flex w-full h-full">
        <!-- begin profile-content -->
        <div class="profile-content w-5/6">
          <!-- begin tab-content -->
          <div class="tab-content p-0">
            <!-- begin #profile-post tab -->
            <div class="tab-pane fade active show" id="profile-post">
              <!-- begin timeline -->
              <ul class="timeline">
                <form @if (isset($post))
                    action="/profile/{{$post->slug}}"
                @else
                  action="/profile"
                @endif  class="" method="POST" enctype="multipart/form-data">
                  @csrf
                  @if (isset($post))
                    @method('PUT')
                  @else
                    @method("POST")  
                  @endif                  
                  <div id="accordion-collapse" data-accordion="collapse">                  
                    <div id="accordion-collapse-body-1" class="" aria-labelledby="accordion-collapse-heading-1">
                      <div class="timeline-body">
                        <div class="timeline-header flex justify-start items-center flex-row ">
                          <span class="mr-4">                            
                              <img class="border-4 border-gray-200 rounded-full w-16 h-16 shadow-xl object-cover" 
                              src="@if(Auth::user()->image_path) 
                                {{asset('/images/'.Auth::user()->image_path)}} 
                              @else 
                                {{asset('/images/default.png')}} 
                              @endif" alt="profile_image" >
                          </span>
                          <span class="username capitalize"><a href="javascript:;">{{ Auth::user()->name }}</a>
                            <small></small></span>
                        </div>
                        <div class="timeline-content w-full">
                          <div class="mb-1">
                            <label for="base-input" class="block ml-2 mb-2 text-sm font-medium text-gray-900">Название</label>
                            <input @if (isset($post))
                              value="{{old('title', $post->title)}}"
                            @else
                                value=""
                            @endif name="title" type="text" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-400 dark:border-gray-600 dark:placeholder-gray-600 dark:text-white">
                          </div>
                          <label for="message" class="block ml-2 mb-2 text-sm font-medium text-gray-900">Новый пост</label>
                          <textarea name="description" id="message" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300  dark:bg-gray-400 dark:border-gray-600 dark:placeholder-gray-600 dark:text-white "
                            @if (isset($post))
                              placeholder="{{old('description', $post->description)}}"
                            @else
                              placeholder="Ваш пост ... "  
                            @endif></textarea>
                        </div>
                        <div class="timeline-footer flex flex-row">
                          <a href="javascript:;" class="m-r-15 text-inverse-lighter flex mr-6">
                            <i class="fa-solid fa-image fa-fw fa-2x m-r-3"></i>
                            <label class=" text-gray-500 font-bold rounded-full mx-1 hover:text-gray-600">
                              <span class="mt-2 text-base leading-normal">
                                  Image
                              </span>
                              <input type="file" name="image" class="hidden">
                            </label>
                          </a>
                          <a href="javascript:;" class="m-r-15 text-inverse-lighter flex">
                            <i class="fa-solid fa-circle-plus fa-fw fa-2x m-r-3"></i>
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold px-4 rounded-full">
                              @if (isset($post))
                                Обновить  
                              @else
                                Создать  
                              @endif
                            </button>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>  
                @foreach ($posts as $post)
                <li>
                  <!-- begin timeline-time -->
                  <div class="timeline-time top-9">
                    <span class="time">{{ $post->updated_at->diffForHumans() }}</span>
                  </div>
                  <!-- end timeline-time -->
                  <!-- begin timeline-icon -->
                  <div class="timeline-icon">
                    <a href="javascript:;">&nbsp;</a>
                  </div>
                  <!-- end timeline-icon -->
                  <!-- begin timeline-body -->
                  <div class="timeline-body">
                    <div class="timeline-header flex justify-start items-center flex-row ">
                      <span class="mr-4">
                        @if(Auth::user()->image_path)
                          <img class="border-4 border-gray-200 rounded-full w-16 h-16 shadow-xl object-cover" src="{{asset('/images/'.Auth::user()->image_path)}}" alt="profile_image" >
                        @endif
                      </span>
                      <span class="username capitalize"><a href="javascript:;">{{ Auth::user()->name }}</a>
                        <small></small></span>
                    </div>
                    <div class="timeline-content w-full">
                      <h3 class="px-2 text-2xl border-b-2 mb-15 border-gray-200 pb-3">{{ $post->title }}</h3>
                      @if ( $post->image_path )
                      <div class="items-center mb-15 border-b-2 border-gray-200 py-3">
                        <img src="{{ asset('images/'. $post->image_path) }}" alt="">
                      </div>
                      @endif
                      <p class="mt-2 text-2xl px-2">
                        {{ $post->description }}
                      </p>
                    </div>
                    <div class="timeline-likes">
                      <div class="stats-right">
                        <span class="stats-text">21 Comments</span>
                      </div>
                    </div>
                    <div class="timeline-footer flex">
                      <a href="javascript:;" class="m-r-15 text-inverse-lighter mr-2"><i
                          class="fa fa-thumbs-up fa-fw fa-lg m-r-3 text-blue-500"></i> Likes</a>
                      <a href="javascript:;" class="m-r-15 text-inverse-lighter mr-2"><i
                          class="fa fa-comments fa-fw fa-lg m-r-3"></i> Comment</a>
                      @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                          <a href="/profile/{{ $post->slug }}/edit" class="m-r-15 text-inverse-lighter mr-2">
                            <i class="fa-solid fa-pen fa-fw fa-lg m-r-3"></i> Edit</a>                        
                          <form action="/profile/{{$post->slug}}" method="POST" class="block mr-2">
                            @csrf
                            @method("delete")
                            <button class="m-r-15 text-inverse-lighter" type="submit">
                              <i class="fa-solid fa-ban fa-fw fa-lg text-red-700"></i>  Delete
                            </button>
                          </form>
                      @endif
                    </div>
                    <div class="timeline-comment-box">
                      <div class="user"><img src="https://bootdey.com/img/Content/avatar/avatar3.png"></div>
                      <div class="input">
                        <form action="">
                          <div class="input-group">
                            <input type="text" class="form-control rounded-corner" placeholder="Write a comment...">
                            <span class="input-group-btn p-l-10">
                              <button class="btn btn-primary f-s-12 rounded-corner" type="button"> Comment</button>
                            </span>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- end timeline-body -->
                </li>
                @endforeach
                <li>
                  <!-- begin timeline-icon -->
                  <div class="timeline-icon">
                    <a href="javascript:;">&nbsp;</a>
                  </div>
                  <!-- end timeline-icon -->
                  <!-- begin timeline-body -->
                  <div class="timeline-body">
                    Loading...
                  </div>
                  <!-- begin timeline-body -->
                </li>
              </ul>
              <!-- end timeline -->
            </div>
            <!-- end #profile-post tab -->
          </div>
          <!-- end tab-content -->
        </div>
        <!-- end profile-content -->
      </div>
    </div>
  </div>
</div>
@endsection