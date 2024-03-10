<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Details') }} {{ $task->title }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-gray-900">
                    @if (session('success'))
                        <div class="alert alert-success bg-green-100 p-5 text-center">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="mx-auto py-6 sm:px-6 lg:px-8">
                        <form method="POST" action="{{ route('tasks.update', $task) }}">
                            @method('PATCH')
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <div class="mb-4">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                    <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}"
                                        class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <x-input-error class="mt-2" :messages="$errors->get('title', $task->title)" />
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" id="status"
                                        class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        @foreach ($statuses as $key => $status)
                                            <option value="{{ $status->id }}" {{ $status->id ==  $task->task_status_id ? 'selected' : '' }}>
                                                {{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('status')" />
                                </div>
                                <div class="mb-4">
                                    <label for="duedate" class="block text-sm font-medium text-gray-700">Due
                                        Date</label>
                                    <input type="datetime-local" name="duedate" id="duedate"
                                    value="{{ old('duedate', $task->duedate) }}"
                                        class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <x-input-error class="mt-2" :messages="$errors->get('duedate')" />
                                </div>
                                <div class="mb-4 md:col-span-3">
                                    <label for="description"
                                        class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea name="description" id="description"
                                        class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $task->description) }}</textarea>
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <button type="submit"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Update
                                    Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
