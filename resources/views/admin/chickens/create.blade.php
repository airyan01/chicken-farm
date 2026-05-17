<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Chicken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.chickens.store') }}" class="space-y-6">
                        @csrf

                        <!-- Chicken Name/Tag -->
                        <div>
                            <x-input-label for="name" :value="__('Name / Tag')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus placeholder="e.g. Chicken A (Tag 001)" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <!-- Breed -->
                        <div>
                            <x-input-label for="breed" :value="__('Breed')" />
                            <x-text-input id="breed" name="breed" type="text" class="mt-1 block w-full" :value="old('breed')" required placeholder="e.g. Rhode Island Red, Leghorn" />
                            <x-input-error class="mt-2" :messages="$errors->get('breed')" />
                        </div>

                        <!-- Date Acquired -->
                        <div>
                            <x-input-label for="acquired_at" :value="__('Date Acquired')" />
                            <x-text-input id="acquired_at" name="acquired_at" type="date" class="mt-1 block w-full" :value="old('acquired_at', now()->toDateString())" required />
                            <x-input-error class="mt-2" :messages="$errors->get('acquired_at')" />
                        </div>

                        <!-- Caretaker Assignment -->
                        <div>
                            <x-input-label for="caretaker_id" :value="__('Assign Caretaker (Optional)')" />
                            <select id="caretaker_id" name="caretaker_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">-- Leave Unassigned --</option>
                                @foreach ($caretakers as $caretaker)
                                    <option value="{{ $caretaker->id }}" {{ old('caretaker_id') == $caretaker->id ? 'selected' : '' }}>
                                        {{ $caretaker->name }} ({{ $caretaker->email }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('caretaker_id')" />
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('admin.chickens.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-750 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Add Chicken') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
