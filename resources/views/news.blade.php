@extends('layouts.app')

@section('content')
<div class="relative bg-gray-900 w-5/6 h-screen overflow-y-auto">
  <div class="px-2 md:px-5">
    <div class="container mx-auto flex flex-wrap py-3">
      <div class="flex md:gap-5 w-full py-4 px-4 bg-gray-100 rounded-md">
        <div
          class="flex justify-start items-center w-full px-2 rounded-md bg-white border-none outline-none focus-within:shadow-sm">
          <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" font-size="21"
            class="ml-1" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M337.509 305.372h-17.501l-6.571-5.486c20.791-25.232 33.922-57.054 33.922-93.257C347.358 127.632 283.896 64 205.135 64 127.452 64 64 127.632 64 206.629s63.452 142.628 142.225 142.628c35.011 0 67.831-13.167 92.991-34.008l6.561 5.487v17.551L415.18 448 448 415.086 337.509 305.372zm-131.284 0c-54.702 0-98.463-43.887-98.463-98.743 0-54.858 43.761-98.742 98.463-98.742 54.7 0 98.462 43.884 98.462 98.742 0 54.856-43.762 98.743-98.462 98.743z">
            </path>
          </svg>
          <input type="text" placeholder="Search" class="p-2 w-full bg-white outline-none" value="">
        </div>
      </div>
    </div>
    <div class="h-full">
      <div class="container mx-auto flex flex-wrap py-3">
        <div class="flex bg-gray-100 rounded-md w-full">
          <!-- Posts Section -->
          <section class="w-full md:w-2/3 flex flex-col items-center px-3">
  
              <article class="flex flex-col shadow my-4">
                  <!-- Article Image -->
                  <a href="#" class="hover:opacity-75">
                      <img src="https://source.unsplash.com/collection/1346951/1000x500?sig=1">
                  </a>
                  <div class="bg-white flex flex-col justify-start p-6">
                      <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">Technology</a>
                      <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">Lorem Ipsum Dolor Sit Amet Dolor Sit Amet</a>
                      <p href="#" class="text-sm pb-3">
                          By <a href="#" class="font-semibold hover:text-gray-800">David Grzyb</a>, Published on April 25th, 2020
                      </p>
                      <a href="#" class="pb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis porta dui. Ut eu iaculis massa. Sed ornare ligula lacus, quis iaculis dui porta volutpat. In sit amet posuere magna..</a>
                      <a href="#" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
                  </div>
              </article>
  
              <article class="flex flex-col shadow my-4">
                  <!-- Article Image -->
                  <a href="#" class="hover:opacity-75">
                      <img src="https://source.unsplash.com/collection/1346951/1000x500?sig=2">
                  </a>
                  <div class="bg-white flex flex-col justify-start p-6">
                      <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">Automotive, Finance</a>
                      <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">Lorem Ipsum Dolor Sit Amet Dolor Sit Amet</a>
                      <p href="#" class="text-sm pb-3">
                          By <a href="#" class="font-semibold hover:text-gray-800">David Grzyb</a>, Published on January 12th, 2020
                      </p>
                      <a href="#" class="pb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis porta dui. Ut eu iaculis massa. Sed ornare ligula lacus, quis iaculis dui porta volutpat. In sit amet posuere magna..</a>
                      <a href="#" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
                  </div>
              </article>
  
              <article class="flex flex-col shadow my-4">
                  <!-- Article Image -->
                  <a href="#" class="hover:opacity-75">
                      <img src="https://source.unsplash.com/collection/1346951/1000x500?sig=3">
                  </a>
                  <div class="bg-white flex flex-col justify-start p-6">
                      <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">Sports</a>
                      <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">Lorem Ipsum Dolor Sit Amet Dolor Sit Amet</a>
                      <p href="#" class="text-sm pb-3">
                          By <a href="#" class="font-semibold hover:text-gray-800">David Grzyb</a>, Published on October 22nd, 2019
                      </p>
                      <a href="#" class="pb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis porta dui. Ut eu iaculis massa. Sed ornare ligula lacus, quis iaculis dui porta volutpat. In sit amet posuere magna..</a>
                      <a href="#" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
                  </div>
              </article>
  
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
                      <i class="fab fa-instagram mr-2"></i> Follow @dgrzyb
                  </a>
              </div>
  
          </aside>
        </div>
    </div>
    </div>
  </div>
</div>
@endsection