<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Farm Manager Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Statistical Overview Widgets -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                
                <!-- Total Chickens -->
                <div class="bg-gradient-to-br from-indigo-500 to-purple-600 dark:from-indigo-650 dark:to-purple-750 text-white rounded-xl shadow-md p-6 flex items-center justify-between transition-transform duration-250 hover:scale-102">
                    <div>
                        <span class="text-sm font-medium text-indigo-100 uppercase tracking-wider block mb-1">Total Chickens</span>
                        <span class="text-3xl font-bold font-sans">{{ $totalChickens }}</span>
                    </div>
                    <div class="bg-white/10 p-3 rounded-lg">
                        <svg class="h-8 w-8 text-white/90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>

                <!-- Eggs Collected Today -->
                <div class="bg-gradient-to-br from-emerald-500 to-teal-600 dark:from-emerald-650 dark:to-teal-750 text-white rounded-xl shadow-md p-6 flex items-center justify-between transition-transform duration-250 hover:scale-102">
                    <div>
                        <span class="text-sm font-medium text-emerald-100 uppercase tracking-wider block mb-1">Eggs Today</span>
                        <span class="text-3xl font-bold font-sans">{{ $totalEggsToday }}</span>
                    </div>
                    <div class="bg-white/10 p-3 rounded-lg">
                        <svg class="h-8 w-8 text-white/90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>

                <!-- Chickens Needing Attention -->
                <div class="bg-gradient-to-br from-rose-500 to-orange-650 dark:from-rose-650 dark:to-orange-750 text-white rounded-xl shadow-md p-6 flex items-center justify-between transition-transform duration-250 hover:scale-102">
                    <div>
                        <span class="text-sm font-medium text-rose-100 uppercase tracking-wider block mb-1">Attention Required</span>
                        <span class="text-3xl font-bold font-sans">{{ $chickensNeedingAttention }}</span>
                    </div>
                    <div class="bg-white/10 p-3 rounded-lg">
                        <svg class="h-8 w-8 text-white/90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>

                <!-- Active Caretakers -->
                <div class="bg-gradient-to-br from-blue-500 to-cyan-600 dark:from-blue-650 dark:to-cyan-750 text-white rounded-xl shadow-md p-6 flex items-center justify-between transition-transform duration-250 hover:scale-102">
                    <div>
                        <span class="text-sm font-medium text-blue-100 uppercase tracking-wider block mb-1">Active Caretakers</span>
                        <span class="text-3xl font-bold font-sans">{{ $activeCaretakers }}</span>
                    </div>
                    <div class="bg-white/10 p-3 rounded-lg">
                        <svg class="h-8 w-8 text-white/90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>

            </div>

            <!-- Chickens Overview Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-100 dark:border-gray-700">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Daily Coop Status Overview</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Real-time daily feed tracking, egg collections, and health check-ins</p>
                        </div>
                        <a href="{{ route('admin.history.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-750 dark:bg-indigo-900/30 dark:text-indigo-300 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition duration-150">
                            View Care History Log →
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Chicken Name/Tag</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Caretaker</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Latest Health Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Today's Feeding</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Today's Eggs</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @forelse ($chickens as $chicken)
                                    @php
                                        $todayLog = $chicken->careLogs->first();
                                        $latestLog = $chicken->latestCareLog;
                                    @endphp
                                    <tr class="hover:bg-gray-55/50 dark:hover:bg-gray-700/30 transition duration-150">
                                        
                                        <!-- Chicken Name -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $chicken->name }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $chicken->breed }}</div>
                                        </td>

                                        <!-- Caretaker -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($chicken->caretaker)
                                                <span class="text-sm text-gray-900 dark:text-gray-300 font-medium">{{ $chicken->caretaker->name }}</span>
                                            @else
                                                <span class="text-xs text-gray-400 dark:text-gray-500 italic">Unassigned</span>
                                            @endif
                                        </td>

                                        <!-- Latest Health Status -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($latestLog)
                                                @if ($latestLog->health_status == 'Healthy')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300">
                                                        Healthy
                                                    </span>
                                                @elseif ($latestLog->health_status == 'Under Observation')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300">
                                                        Under Observation
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-800 dark:bg-rose-900/40 dark:text-rose-350">
                                                        {{ $latestLog->health_status }}
                                                    </span>
                                                @endif
                                                <span class="text-xxs text-gray-400 block mt-0.5">As of {{ $latestLog->date->format('M d') }}</span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-500 dark:bg-gray-700/60 dark:text-gray-400">
                                                    No Logs Yet
                                                </span>
                                            @endif
                                        </td>

                                        <!-- Today's Feeding -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($todayLog && $todayLog->feed_type)
                                                <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $todayLog->feed_type }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $todayLog->feed_quantity }} at {{ \Carbon\Carbon::createFromFormat('H:i:s', $todayLog->feed_time)->format('h:i A') }}</div>
                                            @else
                                                <span class="text-xs text-gray-400 dark:text-gray-500 italic flex items-center">
                                                    <span class="h-2 w-2 bg-amber-400 rounded-full inline-block mr-1.5 animate-pulse"></span> Pending Feed
                                                </span>
                                            @endif
                                        </td>

                                        <!-- Today's Eggs -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($todayLog)
                                                <span class="inline-flex items-center px-2.5 py-1 rounded text-xs font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/20 dark:text-emerald-450 border border-emerald-100 dark:border-emerald-900/40">
                                                    + {{ $todayLog->eggs_collected }} eggs
                                                </span>
                                            @else
                                                <span class="text-sm font-bold text-gray-450 dark:text-gray-500">0</span>
                                            @endif
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                            No chickens registered yet. Please register chickens to see dashboard status.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
