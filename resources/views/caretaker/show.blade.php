<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daily Care Log Detail: ' . $chicken->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Report Header -->
                    <div class="flex justify-between items-center pb-6 mb-6 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $chicken->name }}</h3>
                            <p class="text-sm text-indigo-600 dark:text-indigo-400 font-semibold">{{ $chicken->breed }}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300">
                                ✔ Completed today
                            </span>
                            <p class="text-xs text-gray-550 dark:text-gray-400 mt-1">Logged on: {{ $log->date->format('F d, Y') }}</p>
                        </div>
                    </div>

                    <!-- Log Cards -->
                    <div class="space-y-6">
                        
                        <!-- Feeding details -->
                        <div class="bg-indigo-50/20 dark:bg-indigo-950/10 rounded-lg p-6 border border-indigo-100/50 dark:border-indigo-900/20">
                            <div class="flex items-center space-x-2 text-indigo-850 dark:text-indigo-300 mb-4">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h4 class="font-bold text-md">Feeding Details</h4>
                            </div>
                            <dl class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                                <div>
                                    <dt class="text-gray-500 dark:text-gray-400">Feed Type</dt>
                                    <dd class="mt-1 font-semibold text-gray-900 dark:text-white">{{ $log->feed_type }}</dd>
                                </div>
                                <div>
                                    <dt class="text-gray-500 dark:text-gray-400">Quantity Provided</dt>
                                    <dd class="mt-1 font-semibold text-gray-900 dark:text-white">{{ $log->feed_quantity }}</dd>
                                </div>
                                <div>
                                    <dt class="text-gray-500 dark:text-gray-400">Feeding Time</dt>
                                    <dd class="mt-1 font-semibold text-gray-900 dark:text-white">{{ \Carbon\Carbon::createFromFormat('H:i:s', $log->feed_time)->format('h:i A') }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Health details -->
                        <div class="bg-amber-50/20 dark:bg-amber-950/10 rounded-lg p-6 border border-amber-100/50 dark:border-amber-900/20">
                            <div class="flex items-center space-x-2 text-amber-850 dark:text-amber-300 mb-4">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                <h4 class="font-bold text-md">Health & Behaviour Check</h4>
                            </div>
                            <dl class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm mb-4">
                                <div class="sm:col-span-3">
                                    <dt class="text-gray-500 dark:text-gray-400">Overall Appearance & Status</dt>
                                    <dd class="mt-1">
                                        @if ($log->health_status == 'Healthy')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300">
                                                Healthy
                                            </span>
                                        @elseif ($log->health_status == 'Under Observation')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300">
                                                Under Observation
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-800 dark:bg-rose-900/40 dark:text-rose-300">
                                                {{ $log->health_status }}
                                            </span>
                                        @endif
                                    </dd>
                                </div>
                            </dl>
                            @if ($log->health_symptoms)
                                <div class="border-t border-amber-100/50 dark:border-amber-900/20 pt-3 text-sm">
                                    <span class="text-gray-500 dark:text-gray-400 block text-xs">Symptoms / Remarks:</span>
                                    <p class="mt-1 text-gray-800 dark:text-gray-200 bg-amber-50/10 dark:bg-amber-950/5 p-3 rounded italic font-serif">
                                        "{{ $log->health_symptoms }}"
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Egg details -->
                        <div class="bg-emerald-50/20 dark:bg-emerald-950/10 rounded-lg p-6 border border-emerald-100/50 dark:border-emerald-900/20">
                            <div class="flex items-center space-x-2 text-emerald-850 dark:text-emerald-300 mb-4">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                <h4 class="font-bold text-md">Egg Collection Details</h4>
                            </div>
                            <dl class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                                <div>
                                    <dt class="text-gray-500 dark:text-gray-400">Eggs Collected</dt>
                                    <dd class="mt-1 font-bold text-lg text-emerald-600 dark:text-emerald-450">{{ $log->eggs_collected }} eggs</dd>
                                </div>
                                <div class="sm:col-span-2">
                                    <dt class="text-gray-500 dark:text-gray-400">Logged By</dt>
                                    <dd class="mt-1 font-semibold text-gray-900 dark:text-white">{{ $log->user->name }} ({{ $log->user->email }})</dd>
                                </div>
                            </dl>
                        </div>

                    </div>

                    <!-- Footer Action -->
                    <div class="flex items-center justify-end pt-6 mt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('caretaker.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-750 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                            Back to Caretaker Dashboard
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
