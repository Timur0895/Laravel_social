@extends('admin.index')

@section('content')
<div class="mt-4 mb-6">
  <h4 class="text-gray-600 text-3xl font-semibold">Категории - хештеги</h4>

  <div class="mt-4">
    <div class="w-full max-w-sm overflow-hidden bg-white border rounded-md shadow-md">
      <form method="POST" action="{{route('addCategory')}}">
        @csrf
        <div class="flex items-center justify-between px-5 py-3 text-gray-700 border-b">
          <h3 class="text-sm">Добавить категорию</h3>
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
              type="text" name="title"
              class="w-full px-12 py-2 border-transparent rounded-md appearance-none focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500"
            />
          </div>
        </div>

        <div class="flex items-center justify-between px-5 py-3">
          <button type="reset" class="px-3 py-1 text-sm text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none">
            Сбросить
          </button>
          <button type="submit" class="px-3 py-1 text-sm text-white bg-green-600 rounded-md hover:bg-green-500 focus:outline-none">
            Добавить
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

@if (session()->has('success'))
  <div class="inline-flex w-full max-w-sm ml-3 overflow-hidden bg-white rounded-lg shadow-md absolute top-0 right-0">
    <div class="flex items-center justify-center w-12 bg-green-500">
      <svg
        class="w-6 h-6 text-white fill-current"
        viewBox="0 0 40 40"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"
        />
      </svg>
    </div>

    <div class="px-4 py-2 -mx-3">
      <div class="mx-3">
        <span class="font-semibold text-green-500">Добавлено!</span>
        <p class="text-sm text-gray-600">{{ session()->get('success') }}</p>
      </div>
    </div>
  </div>
@endif
@if (session()->has('delete'))
  <div class="inline-flex w-full max-w-sm ml-3 overflow-hidden bg-white rounded-lg shadow-md absolute top-0 right-0">
    <div class="flex items-center justify-center w-12 bg-red-500">
      <svg
        class="w-6 h-6 text-white fill-current"
        viewBox="0 0 40 40"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"
        />
      </svg>
    </div>

    <div class="px-4 py-2 -mx-3">
      <div class="mx-3">
        <span class="font-semibold text-red-500">Удалено!</span>
        <p class="text-sm text-gray-600">{{ session()->get('delete') }}</p>
      </div>
    </div>
  </div>
@endif


<div class="mt-4">
  <h4 class="text-gray-700 text-3xl">Список категорий</h4>

  <div class="mt-6">
    <div class="my-6 overflow-hidden bg-white rounded-md shadow">
      <table class="w-full text-center border-collapse">
        <thead class="border-b">
          <tr>
            <th class="px-5 py-3 text-sm font-medium text-gray-100 uppercase bg-indigo-800">
              Название
            </th>
            <th class="px-5 py-3 text-sm font-medium text-gray-100 uppercase bg-indigo-800">
              Slug
            </th>
            <th class="px-5 py-3 text-sm font-medium text-gray-100 uppercase bg-indigo-800">
              Число постов
            </th>
            <th class="px-5 py-3 text-sm font-medium text-gray-100 uppercase bg-indigo-800">
              Действия
            </th>
          </tr>
        </thead>
        @foreach ($categories as $item)
          <tbody>
            <tr class="hover:bg-gray-100">
              <td class="px-6 py-4 text-lg text-gray-700 border-b">
                {{$item->title}}
              </td>
              <td class="px-6 py-4 text-gray-500 border-b">
                {{$item->slug}}
              </td>
              <td class="px-6 py-4 text-gray-500 border-b">
                {{$item->posts->count()}}
              </td>
              <td class="px-6 py-4 text-sm font-medium leading-5 flex justify-center border-b border-gray-200 whitespace-nowrap">
                <a href="{{route('editCategory', ['id' => $item->id])}}" class="inline-block px-6 py-2.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out">Изменить</a>
                <form action="{{route('deleteCategory', ['slug' => $item->slug])}}" method="post">
                  @csrf
                  <button type="submit" class="mx-2 inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">Удалить</button>
                </form>
              </td>
            </tr>
          </tbody>
        @endforeach
      </table>
    </div>
  </div>
</div>
@endsection