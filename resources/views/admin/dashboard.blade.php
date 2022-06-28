@extends('admin.index')

@section('content')
  <div>
    <div class="mt-4">
      <div class="flex flex-wrap -mx-6">
        <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
          <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
            <div class="p-3 bg-indigo-600 bg-opacity-75 rounded-full">
              <svg
                class="w-8 h-8 text-white"
                viewBox="0 0 28 30"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M18.2 9.08889C18.2 11.5373 16.3196 13.5222 14 13.5222C11.6804 13.5222 9.79999 11.5373 9.79999 9.08889C9.79999 6.64043 11.6804 4.65556 14 4.65556C16.3196 4.65556 18.2 6.64043 18.2 9.08889Z"
                  fill="currentColor"
                />
                <path
                  d="M25.2 12.0444C25.2 13.6768 23.9464 15 22.4 15C20.8536 15 19.6 13.6768 19.6 12.0444C19.6 10.4121 20.8536 9.08889 22.4 9.08889C23.9464 9.08889 25.2 10.4121 25.2 12.0444Z"
                  fill="currentColor"
                />
                <path
                  d="M19.6 22.3889C19.6 19.1243 17.0927 16.4778 14 16.4778C10.9072 16.4778 8.39999 19.1243 8.39999 22.3889V26.8222H19.6V22.3889Z"
                  fill="currentColor"
                />
                <path
                  d="M8.39999 12.0444C8.39999 13.6768 7.14639 15 5.59999 15C4.05359 15 2.79999 13.6768 2.79999 12.0444C2.79999 10.4121 4.05359 9.08889 5.59999 9.08889C7.14639 9.08889 8.39999 10.4121 8.39999 12.0444Z"
                  fill="currentColor"
                />
                <path
                  d="M22.4 26.8222V22.3889C22.4 20.8312 22.0195 19.3671 21.351 18.0949C21.6863 18.0039 22.0378 17.9556 22.4 17.9556C24.7197 17.9556 26.6 19.9404 26.6 22.3889V26.8222H22.4Z"
                  fill="currentColor"
                />
                <path
                  d="M6.64896 18.0949C5.98058 19.3671 5.59999 20.8312 5.59999 22.3889V26.8222H1.39999V22.3889C1.39999 19.9404 3.2804 17.9556 5.59999 17.9556C5.96219 17.9556 6.31367 18.0039 6.64896 18.0949Z"
                  fill="currentColor"
                />
              </svg>
            </div>

            <div class="mx-5">
              <h4 class="text-2xl font-semibold text-gray-700">{{$users->count()}}</h4>
              <div class="text-gray-500">Пользователей</div>
            </div>
          </div>
        </div>

        <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
          <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
            <div class="p-3 bg-blue-600 bg-opacity-75 rounded-full">
              <svg
                class="w-8 h-8 text-white"
                viewBox="0 0 28 28"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M4.19999 1.4C3.4268 1.4 2.79999 2.02681 2.79999 2.8C2.79999 3.57319 3.4268 4.2 4.19999 4.2H5.9069L6.33468 5.91114C6.33917 5.93092 6.34409 5.95055 6.34941 5.97001L8.24953 13.5705L6.99992 14.8201C5.23602 16.584 6.48528 19.6 8.97981 19.6H21C21.7731 19.6 22.4 18.9732 22.4 18.2C22.4 17.4268 21.7731 16.8 21 16.8H8.97983L10.3798 15.4H19.6C20.1303 15.4 20.615 15.1004 20.8521 14.6261L25.0521 6.22609C25.2691 5.79212 25.246 5.27673 24.991 4.86398C24.7357 4.45123 24.2852 4.2 23.8 4.2H8.79308L8.35818 2.46044C8.20238 1.83722 7.64241 1.4 6.99999 1.4H4.19999Z"
                  fill="currentColor"
                />
                <path
                  d="M22.4 23.1C22.4 24.2598 21.4598 25.2 20.3 25.2C19.1403 25.2 18.2 24.2598 18.2 23.1C18.2 21.9402 19.1403 21 20.3 21C21.4598 21 22.4 21.9402 22.4 23.1Z"
                  fill="currentColor"
                />
                <path
                  d="M9.1 25.2C10.2598 25.2 11.2 24.2598 11.2 23.1C11.2 21.9402 10.2598 21 9.1 21C7.9402 21 7 21.9402 7 23.1C7 24.2598 7.9402 25.2 9.1 25.2Z"
                  fill="currentColor"
                />
              </svg>
            </div>

            <div class="mx-5">
              <h4 class="text-2xl font-semibold text-gray-700">{{$posts->count()}}</h4>
              <div class="text-gray-500">Всего постов</div>
            </div>
          </div>
        </div>

        <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
          <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
            <div class="p-3 bg-pink-600 bg-opacity-75 rounded-full">
              <svg
                class="w-8 h-8 text-white"
                viewBox="0 0 28 28"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M6.99998 11.2H21L22.4 23.8H5.59998L6.99998 11.2Z"
                  fill="currentColor"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linejoin="round"
                />
                <path
                  d="M9.79999 8.4C9.79999 6.08041 11.6804 4.2 14 4.2C16.3196 4.2 18.2 6.08041 18.2 8.4V12.6C18.2 14.9197 16.3196 16.8 14 16.8C11.6804 16.8 9.79999 14.9197 9.79999 12.6V8.4Z"
                  stroke="currentColor"
                  stroke-width="2"
                />
              </svg>
            </div>

            <div class="mx-5">
              <h4 class="text-2xl font-semibold text-gray-700">{{$comments->count()}}</h4>
              <div class="text-gray-500">Кол-во комментов</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-8"></div>

    <div class="flex flex-col mt-8">
      <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
          <table class="min-w-full">
            <thead>
              <tr>
                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                  Имя
                </th>
                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                  Дата создания
                </th>
                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                  Дата обновления
                </th>
                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                  Статус
                </th>
                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                  Роль
                </th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
              </tr>
            </thead>

            @foreach ($users as $user)
              <tbody class="bg-white">
                <tr>
                  <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 w-10 h-10">
                        <img
                          class="w-10 h-10 rounded-full"
                          alt=""
                          src="@if($user->image_path) 
                                {{asset('/images/'.$user->image_path)}} 
                              @else 
                                {{asset('/images/default.png')}} 
                              @endif"
                        />
                      </div>

                      <div class="ml-4">
                        <div class="text-sm font-medium leading-5 text-gray-900">
                          {{$user->name}} {{$user->surname}}
                        </div>
                        <div class="text-sm leading-5 text-gray-500">
                          {{$user->email}}
                        </div>
                      </div>
                    </div>
                  </td>

                  <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                    <div class="text-sm leading-5 text-gray-900">
                      {{$user->created_at}}
                    </div>
                  </td>

                  <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                    <div class="text-sm leading-5 text-gray-900">
                      {{$user->updated_at}}
                    </div>
                  </td>

                  @if ($user->active_status)
                    <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                      <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Online</span>
                    </td>
                  @else
                    <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                      <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Offline</span>
                    </td>
                  @endif

                  @if ($user->is_admin)
                  <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                    <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Admin</span>
                  </td>
                  @else
                    <td class="px-6 py-4 border-b border-gray-200 whitespace-nowrap">
                      <span class="inline-flex px-2 text-xs font-semibold leading-5 text-gray-800 bg-gray-100 rounded-full">User</span>
                    </td>                  
                  @endif 

                  <td class="px-6 py-4 text-sm font-medium leading-5 text-right border-b border-gray-200">
                    <!-- Button trigger modal -->
                    <button type="button" class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out" data-bs-toggle="modal" data-bs-target="#exampleModalLg-{{$user->id}}">Подробнее</button>
                    <!-- Modal -->
                    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="exampleModalLg-{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLgLabel" aria-modal="true" role="dialog">
                      <div class="modal-dialog modal-lg relative w-auto pointer-events-none">
                        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                          <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                            <h5 class="capitalize text-xl font-medium leading-normal text-gray-800" id="exampleModalLgLabel">
                              {{$user->name}} {{$user->surname}}
                            </h5>
                          </div>
                          <div class="modal-body p-4">
                            <div class="text-center">
                              <img
                                src="@if($user->image_path) 
                                      {{asset('/images/'.$user->image_path)}} 
                                    @else 
                                      {{asset('/images/default.png')}} 
                                    @endif"
                                class="rounded-full h-32 w-32 mb-4 mx-auto"
                                alt="Avatar"
                              />
                              <h5 class="text-xl font-medium leading-tight mb-2 capitalize">{{$user->name}} {{$user->surname}}</h5>
                              <p class="text-gray-500">{{$user->email}}</p>
                              <div class="flex justify-around mt-3">
                                <p class="text-gray-500">Дата создания</p>
                                <p class="text-gray-500">Дата изменения</p>
                              </div>
                              <div class="flex justify-around mb-3">
                                <h5 class="text-xl font-medium leading-tight mb-2">{{$user->created_at}}</h5>
                                <h5 class="text-xl font-medium leading-tight mb-2">{{$user->updated_at}}</h5>
                              </div>
                              <div class="flex justify-around mb-3">
                                <p class="text-gray-500">Статус: @if ($user->active_status)
                                                                      <span class="px-2 py-1 text-lg font-medium leading-tight text-green-800 bg-green-100 rounded-full">Online</span>
                                                                    @else
                                                                      <span class="px-2 py-1 text-lg font-medium leading-tight text-red-800 bg-red-100 rounded-full">Offline</span>
                                                                    @endif
                                </p>
                                <p class="text-gray-500">Роль: @if ($user->active_status)
                                                                      <span class="px-2 py-1 text-lg font-medium leading-tight text-green-800 bg-green-100 rounded-full">Admin</span>
                                                                    @else
                                                                      <span class="px-2 py-1 text-lg font-medium leading-tight text-gray-800 bg-gray-100 rounded-full">User</span>
                                                                    @endif
                                </p>


                              </div>
                              <div class="mt-5">
                                <h4 class="text-gray-700 text-xl font-medium leading-tight mb-2 ">Посты пользователя {{$user->name}}</h4>
                                @foreach ($user->post()->whereNull('parent_id') as $post)
                                  <div class="flex">
                                    <div class="flex flex-row w-full rounded-lg bg-white shadow-lg mb-3">
                                      <img class="object-cover w-60 rounded-t-lg md:rounded-none md:rounded-l-lg" src="@if($post->image_path) 
                                                                                                                  {{asset('/images/'.$post->image_path)}} 
                                                                                                                @else 
                                                                                                                  {{asset('/images/default.png')}} 
                                                                                                                @endif" alt="" />
                                      <div class="p-6 flex flex-col text-left w-full bg-slate-200">
                                        <h5 class="text-gray-900 text-xl font-medium mb-2">{{$post->title}}</h5>
                                        <p class="text-gray-700 text-base mb-4">
                                          {{$post->description}}
                                        </p>
                                        <p class="text-gray-600 text-xs">Создан {{$post->created_at->diffForHumans()}}</p>
                                        <p class="text-gray-600 text-xs">Обновлен {{$post->updated_at->diffForHumans()}}</p>
                                        <div class="flex flex-row items-center">
                                          <h4>Категории:   </h4>
                                          @foreach ($post->categories as $category)
                                            <span class="inline-block px-3 py-1 mr-2 text-sm font-semibold text-gray-700 bg-gray-50 rounded-full">
                                              #{{$category->title}}
                                            </span>                                                                                    
                                          @endforeach                                        
                                        </div>
                                      </div>
                                    </div>
                                  </div>                                    
                                @endforeach                                                                
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                            <button type="button"
                              class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out"
                              data-bs-dismiss="modal">
                              Понятно
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>                
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection