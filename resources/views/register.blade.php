<!doctype html>
<html class="h-full bg-white">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Qvintus | Register</title>
  @vite('resources/css/app.css')
</head>
<body class="h-full">
@if ($errors->any())
  <x-notification title="Something went wrong" :messages="$errors->all()" />
  @elseif(session('status'))
  <x-notification title="Something went wrong" :messages="session('status')" />
@endif
<div class="flex min-h-full">
    <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
      <div class="mx-auto w-full max-w-sm lg:w-96">
        <div>
          <img class="h-10 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
          <h2 class="mt-8 text-2xl/9 font-bold tracking-tight text-gray-900">Create a new account</h2>
          <p class="mt-2 text-sm/6 text-gray-500">
            Already registered?
            <a href="{{ route('login') }}" class="font-semibold text-gray-900 hover:text-gray-500">Sign in now</a>
          </p>
        </div>
  
        <div class="mt-10">
          <div>
            <form action="{{ route('register.process') }}" method="POST" class="space-y-6">
              @csrf
              <div>
                <label for="name" class="block text-sm/6 font-medium text-gray-900">Username</label>
                <div class="mt-2">
                  <input type="text" name="name" id="name" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-sky-200 sm:text-sm/6">
                </div>
              </div>
  
              <div>
                <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                <div class="mt-2">
                  <input type="password" name="password" id="password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-sky-200 sm:text-sm/6">
                </div>
              </div>

              <div>
                <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900">Confirm Password</label>
                <div class="mt-2">
                  <input type="password" name="password_confirmation" id="password_confirmation" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-sky-200 sm:text-sm/6">
                </div>
              </div>
  
              <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-gray-950 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-gray-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-900">Register</button>
              </div>
            </form>
          </div>
  
        </div>
      </div>
    </div>
    <div class="relative hidden w-0 flex-1 lg:block">
      <img class="absolute inset-0 size-full object-cover" src="https://images.unsplash.com/photo-1496917756835-20cb06e75b4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80" alt="">
    </div>
  </div>  
</body>
</html>