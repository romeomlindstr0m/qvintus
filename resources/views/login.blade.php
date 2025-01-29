<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qvintus | Sign in</title>
    @vite('resources/css/app.css')
</head>
<body class="h-full font-inter">
<x-navbar />
<div class="flex min-h-full">
  <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
    <div class="mx-auto w-full max-w-sm lg:w-96">
      <div>
        <img class="h-10 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
        <h2 class="mt-8 text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
      </div>

      <div class="mt-10">
        <div>
          <form action="{{ route('login.process') }}" method="POST" class="space-y-6">
            @csrf
            <div>
              <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
              <div class="mt-2">
                <input type="email" name="email" id="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-sky-200 sm:text-sm/6">
              </div>
            </div>

            <div>
              <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
              <div class="mt-2">
                <input type="password" name="password" id="password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-sky-200 sm:text-sm/6">
              </div>
            </div>

            <div class="flex items-center justify-between">

              <div class="text-sm/6">
                <a href="#" class="font-semibold text-blue-600 hover:text-blue-800">Forgot password?</a>
              </div>
            </div>

            <div>
              <button type="submit" class="flex w-full justify-center rounded-md bg-gray-950 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-800">Sign in</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  <div class="relative hidden w-0 flex-1 lg:block">
    <img class="absolute inset-0 size-full object-cover" src="{{ asset('library-bookshelves.webp') }}" />
  </div>
</div>

@if ($errors->any())
  <x-notification type="error" title="Something went wrong!" :body="$errors->all()" />
@endif
</body>
</html>