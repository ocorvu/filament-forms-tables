<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
      <meta charset="utf-8">

      <meta name="application-name" content="{{ config('app.name') }}">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>{{ config('app.name') }}</title>

      <style>[x-cloak] { display: none !important; }</style>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
      @livewireStyles
      @livewireScripts
      @stack('scripts')
  </head>

  <body class="antialiased">
    <nav class="bg-gray-800">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
            </div>
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="{{ route('products.show') }}" class="
                @if (request()->route()->uri === 'products')
                  active
                @else
                  not-active
                @endif" aria-current="page">Products</a>
  
                <a href="{{ route('products.create') }}" class="
                  @if (request()->route()->uri === 'create')
                   active
                  @else
                    not-active
                  @endif 
                  ">New</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>

    {{ $slot }}

    @livewire('notifications')
  </body>
</html>
