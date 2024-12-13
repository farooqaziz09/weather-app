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

          <form method="GET" action="/weather">
            <input type="text" name="city" placeholder="Enter city name" required>
            <button
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
              type="submit">Search Weather</button>
          </form>
          <hr>
          @if (isset($weather))
            <h2>Weather in {{ $weather['name'] }}</h2>
            <p>Temperature: {{ $weather['main']['temp'] }}°C</p>
            <p>Humidity: {{ $weather['main']['humidity'] }}</p>
            <p>Wind Speed: {{ $weather['wind']['speed'] }}</p>
            <p>Description: {{ $weather['weather'][0]['description'] }}</p>
            <form method="POST" action="/weather/save">
              @csrf
              <input type="hidden" name="city" value="{{ $weather['name'] }}">
              <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                type="submit" class="btn">Save as Task</button>
            </form>
          @endif
          <hr>

          <h2>Your Tasks</h2>
          <ul>
            @foreach ($tasks as $task)
              <li>{{ $task->title }} - {{ $task->description }}
                <a href="{{ url('task/view/' . $task->id) }}"><i class="fa-solid fa-eye"></i></a>|
                <a href="{{ url('task/edit/' . $task->id) }}"><i class="fa-solid fa-pencil"></i></a> |
                <a href="{{ url('task/delete/' . $task->id) }}"><i class="fa-solid fa-trash"></i></a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
