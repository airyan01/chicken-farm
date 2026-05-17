<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Caretaker Dashboard - Daily Chicken Care') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Flash Messages -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 dark:bg-emerald-900 dark:text-emerald-200 dark:border-emerald-600 rounded shadow-sm flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-emerald-700 dark:text-emerald-200 hover:text-emerald-950 font-bold">&times;</button>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-rose-100 border-l-4 border-rose-500 text-rose-700 dark:bg-rose-900 dark:text-rose-200 dark:border-rose-600 rounded shadow-sm flex items-center justify-between">
                    <span>{{ session('error') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-rose-700 dark:text-rose-200 hover:text-rose-950 font-bold">&times;</button>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Welcome, {{ Auth::user()->name }}!</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Below is the list of chickens assigned to your care. Please make sure to record a daily feeding, health, and egg log for each chicken today.
                    </p>
                </div>
            </div>

            <!-- Assigned Chickens List -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($chickens as $chicken)
                    @php
                        $todayLog = $chicken->careLogs->first(); // Eager loaded and filtered for today
                    @endphp
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow duration-200">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-white">{{ $chicken->name }}</h4>
                                    <p class="text-xs text-indigo-600 dark:text-indigo-400 font-semibold uppercase tracking-wider">{{ $chicken->breed }}</p>
                                </div>
                                
                                <!-- Today's Status Badge -->
                                @if ($todayLog)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300">
                                        ✔ Logged Today
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300">
                                        ⚠ Pending Log
                                    </span>
                                @endif
                            </div>

                            <div class="space-y-2 border-t border-gray-150 dark:border-gray-700 pt-3 text-sm text-gray-600 dark:text-gray-400">
                                <div class="flex justify-between">
                                    <span>Date Acquired:</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-200">{{ $chicken->acquired_at->format('M d, Y') }}</span>
                                </div>

                                @if ($todayLog)
                                    <div class="flex justify-between">
                                        <span>Eggs Collected Today:</span>
                                        <span class="font-bold text-emerald-600 dark:text-emerald-400">{{ $todayLog->eggs_collected }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Health Status:</span>
                                        <span class="font-semibold text-gray-900 dark:text-gray-200">{{ $todayLog->health_status }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Action Footer -->
                        <div class="bg-gray-50 dark:bg-gray-700/30 px-6 py-4 border-t border-gray-150 dark:border-gray-700 flex items-center justify-end">
                            @if ($todayLog)
                                <a href="{{ route('caretaker.chickens.show-log', $chicken) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-gray-400 focus:outline-none focus:ring ring-gray-300 transition ease-in-out duration-150">
                                    View Today's Log
                                </a>
                            @else
                                <a href="{{ route('caretaker.chickens.create-log', $chicken) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-750 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 transition ease-in-out duration-150 shadow-sm">
                                    + Record Daily Care
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-12 text-center text-gray-500 dark:text-gray-400">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">No Assigned Chickens</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400 max-w-md mx-auto">
                            You currently do not have any chickens assigned to your care. Please contact the Farm Manager (Admin) to assign chickens.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
