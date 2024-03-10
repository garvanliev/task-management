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
                    <div class="grid grid-cols-1 md:grid-cols-3 border-b border-gray-200 py-6">
                        <div class="text-black font-bold text-lg">
                            {{ $task->title }}
                        </div>
                        <div class="text-gray-600">
                            @if ($task->duedate)
                                @php
                                    $duedate = \Carbon\Carbon::parse($task->duedate);
                                @endphp

                                @if ($duedate->isFuture())
                                    <div class="flex mx-auto gap-3 justify-center">
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
                                    <p class="text-gray-400 mx-auto text-center">
                                        Due date has passed
                                    </p>
                                @endif
                            @endif
                        </div>
                        <div class="md:text-right">
                            <span class="px-3 py-2 rounded-xl text-xs text-center text-white"
                                style="background-color: {{ $task->status?->color }}">{{ $task->status?->name }}</span>
                        </div>
                    </div>
                    <div class="py-6 text-gray-500">
                        {{ $task->description ?? 'No description found' }}
                    </div>
                    <div class="flex gap-3">
                        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{ route('tasks.edit', $task)}}"> Edit </a>
                        <form action="{{ route('tasks.delete', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div>
                    <form method="POST" action="{{ route('tasks.comments.store', $task) }}">
                        @csrf
                        <label for="description" class="block text-sm font-medium text-gray-700">Comment</label>
                        <input
                            class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            type="text" name="description" />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600 my-2 ml-auto">Post
                            Comment</button>
                    </form>
                </div>
                <div class="text-gray-900">
                    @if (count($task->comments) > 0)
                        @foreach ($task->comments()->orderBy('created_at', 'desc')->get() as $comment)
                            <div class="grid gird-cols-1 py-2 border-b border-gray-300 my-3">
                                <div class="text-sm text-black font-bold">
                                    {{ $comment->user->name }} <span
                                        class="text-xs text-gray-300 font-normal">{{ $comment->created_at->diffForHumans([
                                            'parts' => 2,
                                            'join' => ', ',
                                            'short' => true,
                                        ]) }}</span>
                                </div>
                                <div class="text-gray-500">
                                    {{ $comment->description }}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Post your first comment.
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
