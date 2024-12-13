<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>
  <style>
    .btn.btn-blue {
      border: 1px solid grey;
      padding: 10px;
    }
  </style>
  <div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          @if (Session::has('message'))
            <p
              class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 {{ Session::get('alert-class', 'alert-info') }} text-neutral-500	">
              {{ Session::get('message') }}</p>
          @endif
          <h1>Welcome, {{ auth()->user()->name }}</h1>

          <form class="max-w-sm mx-auto" method="POST" action="{{ url('task/update/' . $task['id']) }}">
            @csrf
            <input type="hidden" name="id" value="{{ $task['id'] }}">
            <div class="mb-5">

              <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">
                Title:
                <input type="text" name="title" value="{{ $task['title'] }}"
                  class="bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400">
              </label>
            </div>
            <div class="mb-5">

              <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">
                Description:
                <textarea name="description" id="" cols="30" rows="10"
                  class="bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400">{{ $task['description'] }}</textarea>
              </label>
            </div>
            <button
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
              type="submit">Save</button>
          </form>
          <hr>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
