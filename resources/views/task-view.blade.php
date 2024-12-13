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
          <h2>Task </h2>
          <ul>
            <li>{{ $task->title }} - {{ $task->description }}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
