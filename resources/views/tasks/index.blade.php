<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    @if (session('success'))
                        <div class="alert alert-success bg-green-100 p-5 text-center">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="mx-auto py-6 sm:px-6 lg:px-8">
                        <form method="POST" action="{{ route('tasks.store') }}">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <div class="mb-4">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                                        class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" id="status"
                                        class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        @foreach ($statuses as $key => $status)
                                            <option value="{{ $status->id }}" {{ $key == 0 ? 'selected' : '' }}>
                                                {{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('status')" />
                                </div>
                                <div class="mb-4">
                                    <label for="duedate" class="block text-sm font-medium text-gray-700">Due
                                        Date</label>
                                    <input type="datetime-local" name="duedate" id="duedate"
                                        class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                        min="<?php echo date('Y-m-d\TH:i'); ?>">

                                    <x-input-error class="mt-2" :messages="$errors->get('duedate')" />
                                </div>
                                <div class="mb-4 md:col-span-3">
                                    <label for="description"
                                        class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea name="description" id="description"
                                        class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <button type="submit"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Create
                                    Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="py-5">
                        {{ __('Manage All Tasks') }}
                    </div>
                    <form method="GET" action="{{ route('tasks.index') }}"
                        class="flex justify-start space-x-4 border-b pb-5 border-gray-400">
                        <div class="flex items-center space-x-4">
                            <label for="status" class="text-sm">Status:</label>
                            <select name="status" id="status"
                                class="border border-gray-300 rounded-md px-2 py-1 text-sm min-w-[150px]">
                                <option value="">Select Status</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}"
                                        {{ request()->input('status') == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center space-x-4">
                            <label for="due_date" class="text-sm">Due Date:</label>
                            <input type="date" name="due_date" id="due_date"
                                value="{{ request()->input('due_date') }}"
                                class="border border-gray-300 rounded-md px-2 py-1 text-sm">
                        </div>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm">
                            Apply Filters
                        </button>
                        <button type="button" onclick="window.location='{{ route('tasks.index') }}'"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm">
                            Reset Filters
                        </button>
                    </form>

                    @if (count($tasks) > 0)
                        @foreach ($tasks as $task)
                            <div
                                class="grid grid-cols-1 md:grid-cols-5 py-3 border-b border-gray-100 justify-center items-center">
                                <div class="font-bold">
                                    <div>
                                        {{ $task->title ?? 'N/A' }}
                                    </div>
                                    <div class="text-sm text-gray-500 font-normal">
                                        @if (auth()->user()->isAdmin())
                                            by {{ $task->user->name }}
                                        @endif
                                    </div>
                                </div>
                                <div class="text-gray-600">
                                    {{ $task->description ?? 'No descriptionf found' }}
                                </div>
                                <div class="text-gray-600">
                                    @if ($task->duedate)
                                        @php
                                            $duedate = \Carbon\Carbon::parse($task->duedate);
                                        @endphp

                                        @if ($duedate->isFuture())
                                            <div class="flex gap-3">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="24" height="24" fill="white" />
                                                    <circle cx="12" cy="12" r="9" stroke="#000000"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M12 6V12L7.5 16.5" stroke="#000000" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                {{ $duedate->diffForHumans([
                                                    'parts' => 2,
                                                    'join' => ', ',
                                                    'short' => true,
                                                ]) }}
                                            </div>
                                        @else
                                            <p class="text-gray-400">
                                                Due date has passed
                                            </p>
                                        @endif
                                    @endif
                                </div>
                                <div class="text-center">
                                    <span class="px-3 py-2 rounded-xl text-xs text-center text-white"
                                        style="background-color: {{ $task->status?->color }}">{{ $task->status?->name }}</span>
                                </div>
                                <div class="text-gray-600 text-right">
                                    @can('view', $task)
                                        <a href="{{ route('tasks.show', $task) }}"
                                            class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded focus:outline-none focus:bg-indigo-600">View</a>
                                    @endcan
                                </div>
                            </div>
                        @endforeach
                        <div>
                            {{ $tasks->links() }}
                        </div>
                    @else
                        <p>No tasks found.
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
