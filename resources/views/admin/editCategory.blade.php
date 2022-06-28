@extends('admin.index')

@section('content')
<div class="mt-4 mb-6">
    <h4 class="text-gray-600 text-3xl font-semibold">Категории - хештеги</h4>
  
    <div class="mt-4">
      <div class="w-full max-w-sm overflow-hidden bg-white border rounded-md shadow-md">
        <form method="POST" action="{{route('updateCategory', ['id' => $category->id])}}">
          @csrf
          <div class="flex items-center justify-between px-5 py-3 text-gray-700 border-b">
            <h3 class="text-sm">Изменить категорию</h3>
          </div>
  
          <div class="px-5 py-6 text-gray-700 bg-gray-200 border-b">
            <label class="text-xs">Название</label>
  
            <div class="relative mt-2 rounded-md shadow-sm">
              <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-600">
                <svg
                  class="w-6 h-6"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"
                  />
                </svg>
              </span>
  
              <input
                type="text" name="title" value="{{$category->title}}"
                class="w-full px-12 py-2 border-transparent rounded-md appearance-none focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500"
              />
            </div>
          </div>
  
          <div class="flex items-center justify-between px-5 py-3">
            <button type="reset" class="px-3 py-1 text-sm text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none">
              Сбросить
            </button>
            <button type="submit" class="px-3 py-1 text-sm text-white bg-green-600 rounded-md hover:bg-green-500 focus:outline-none">
              Изменить
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection