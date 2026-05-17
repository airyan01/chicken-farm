<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Care History Logs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Filters Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8 border border-gray-150 dark:border-gray-700">
                <div class="p-6">
                    <h3 class="text-md font-bold text-gray-900 dark:text-white mb-4">Filter History Logs</h3>
                    
                    <form method="GET" action="{{ route('admin.history.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        
                        <!-- Select Chicken -->
                        <div>
                            <x-input-label for="chicken_id" :value="__('Filter by Chicken')" />
                            <select id="chicken_id" name="chicken_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- All Chickens --</option>
                                @foreach ($chickensList as $chickenItem)
                                    <option value="{{ $chickenItem->id }}" {{ request('chicken_id') == $chickenItem->id ? 'selected' : '' }}>
                                        {{ $chickenItem->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Start Date -->
                        <div>
                            <x-input-label for="start_date" :value="__('Start Date')" />
                            <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" :value="request('start_date')" />
                        </div>

                        <!-- End Date -->
                        <div>
                            <x-input-label for="end_date" :value="__('End Date')" />
                            <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" :value="request('end_date')" />
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-2 pt-2 md:pt-0">
                            <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-indigo-650 hover:bg-indigo-750 text-white rounded-md font-semibold text-xs uppercase tracking-widest transition duration-150 shadow-sm">
                                Filter
                            </button>
                            <a href="{{ route('admin.history.index') }}" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-650 hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-md font-semibold text-xs uppercase tracking-widest transition duration-150 shadow-sm">
                                Reset
                            </a>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Care Logs History List -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-150 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Historical Daily Records</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Chicken</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Logged By</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Feeding Details</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Health Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider text-center">Eggs</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @forelse ($logs as $log)
                                    <tr class="hover:bg-gray-55/50 dark:hover:bg-gray-700/30 transition duration-150">
                                        
                                        <!-- Date -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $log->date->format('M d, Y') }}
                                        </td>

                                        <!-- Chicken -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $log->chicken->name }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-450">{{ $log->chicken->breed }}</div>
                                        </td>

                                        <!-- Logged By -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $log->user->name }}
                                        </td>

                                        <!-- Feeding Details -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            <div><span class="font-medium">{{ $log->feed_type }}</span> ({{ $log->feed_quantity }})</div>
                                            <div class="text-xs text-gray-450 mt-0.5">at {{ \Carbon\Carbon::createFromFormat('H:i:s', $log->feed_time)->format('h:i A') }}</div>
                                        </td>

                                        <!-- Health Status -->
                                        <td class="px-6 py-4">
                                            @if ($log->health_status == 'Healthy')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300">
                                                    Healthy
                                                </span>
                                            @elseif ($log->health_status == 'Under Observation')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300">
                                                    Under Observation
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-800 dark:bg-rose-900/40 dark:text-rose-350">
                                                    {{ $log->health_status }}
                                                </span>
                                            @endif
                                            
                                            @if ($log->health_symptoms)
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 italic max-w-xs truncate" title="{{ $log->health_symptoms }}">
                                                    "{{ $log->health_symptoms }}"
                                                </p>
                                            @endif
                                        </td>

                                        <!-- Eggs -->
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="text-sm font-bold text-gray-800 dark:text-gray-200">
                                                {{ $log->eggs_collected }}
                                            </span>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                            No care logs found matching the selected filters.
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
