<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-md text-black">
                        Manage Task Statuses
                    </div>
                    <form method="POST" action="{{ route('status.store') }}" class="mb-4">
                        @csrf
                        <div class="flex items-center space-x-4">
                            <input type="text" name="name" placeholder="Task Status Name"
                                class="border border-gray-300 rounded-md px-2 py-1 w-64">
                            <input type="color" name="color" value="#757575" class="w-12 h-12">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Create
                            </button>
                        </div>
                    </form>
                    <div class="flex space-x-3">
                        @foreach ($statuses as $status)
                            <span class="px-3 py-2 rounded-xl text-xs text-center text-white flex flex-row space-x-2"
                                style="background-color: {{ $status->color }}">
                                <div>{{ $status->name }}
                                </div>
                                <form method="POST"
                                    action="{{ route('status.destroy', $status->id) }}"onsubmit="return confirm('Are you sure you want to delete this status?')">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="status_id" value="{{ $status->id }}" />
                                    <button type="submit" class="text-white">x
                                    </button>
                                </form>
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-md text-black">
                        Manage Admin Users
                    </div>
                    <form class="grid grid-cols-1 md:grid-cols-2 gap-3" method="POST" action="{{ route('register') }}">
                        @csrf
                        @method('POST')
                        <!-- Name -->
                        <div>
                            <x-text-input class="block mt-1 w-full" type="hidden" name="role" :value="__('admin')" />
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4 md:col-span-2">
                            <x-primary-button class="ms-4">
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>
                    </form>
                    @isset($users)
                        @foreach ($users as $user)
                            <div class="grid grid-cols-3 border-b border-gray-300 py-3">
                                <div>
                                    {{ $user->name }}
                                </div>
                                <div>
                                    {{ $user->email }}
                                </div>
                                <div>
                                    {{ $user->role }}
                                </div>
                            </div>
                        @endforeach
                    @endisset

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
