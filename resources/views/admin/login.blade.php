<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tailwind Login Template by David Grzyb</title>
	<meta name="author" content="David Grzyb">
  <meta name="description" content="">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="body-bg min-h-screen pt-12 md:pt-20 pb-6 px-2 md:px-0" style="font-family:'Lato',sans-serif;">
  <main class="bg-gray-200 max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl">
    @if (session()->has('message'))
    <div class="container flex justify-center text-center px-2">
      <p class="my-2 text-gray-50 bg-red-500 rounded-2xl py-2 px-4">
        {{ session()->get('message') }}
      </p>
    </div>
    @endif
    <section>
      <h3 class="font-bold text-2xl">Вход в Админку</h3>
      <p class="text-gray-600 pt-2">Введите данные</p>
    </section>

    <section class="mt-5">
      <form class="flex flex-col" method="POST" action="{{route('loginAdmin')}}">
        @csrf
          <div class="mb-6 pt-3 rounded bg-gray-200">
            <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="email">Email</label>
            <input type="text" name="email" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-blue-600 transition duration-500 px-3 pb-3">
          </div>
          <div class="mb-6 pt-3 rounded bg-gray-200">
            <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="password">Пароль</label>
            <input type="password" name="password" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-blue-600 transition duration-500 px-3 pb-3">
          </div>
          <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200" type="submit">Войти</button>
      </form>
    </section>
  </main>
</body>
</html>