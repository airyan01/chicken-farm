<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Record Daily Care Log: ' . $chicken->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6 pb-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-850 dark:text-gray-200">Chicken Information</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Breed: <span class="font-medium text-gray-900 dark:text-white">{{ $chicken->breed }}</span> | Date Acquired: <span class="font-medium text-gray-900 dark:text-white">{{ $chicken->acquired_at->format('M d, Y') }}</span></p>
                    </div>

                    <form method="POST" action="{{ route('caretaker.chickens.store-log', $chicken) }}" class="space-y-6">
                        @csrf

                        <!-- SECTION 1: Feeding -->
                        <div class="bg-indigo-50/40 dark:bg-indigo-950/20 p-6 rounded-lg border border-indigo-100/50 dark:border-indigo-900/40 space-y-4">
                            <h4 class="text-md font-bold text-indigo-850 dark:text-indigo-300">1. Feeding Details</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Feed Type -->
                                <div>
                                    <x-input-label for="feed_type" :value="__('Feed Type')" />
                                    <x-text-input id="feed_type" name="feed_type" type="text" class="mt-1 block w-full" :value="old('feed_type')" required placeholder="e.g. Layer Pellets, Grower Mash" />
                                    <x-input-error class="mt-2" :messages="$errors->get('feed_type')" />
                                </div>

                                <!-- Feed Quantity -->
                                <div>
                                    <x-input-label for="feed_quantity" :value="__('Quantity (grams/kg)')" />
                                    <x-text-input id="feed_quantity" name="feed_quantity" type="text" class="mt-1 block w-full" :value="old('feed_quantity')" required placeholder="e.g. 500g, 1.2kg" />
                                    <x-input-error class="mt-2" :messages="$errors->get('feed_quantity')" />
                                </div>
                            </div>

                            <!-- Feeding Time -->
                            <div>
                                <x-input-label for="feed_time" :value="__('Time of Feeding')" />
                                <x-text-input id="feed_time" name="feed_time" type="time" class="mt-1 block w-full" :value="old('feed_time', now()->format('H:i'))" required />
                                <x-input-error class="mt-2" :messages="$errors->get('feed_time')" />
                            </div>
                        </div>

                        <!-- SECTION 2: Health Status -->
                        <div class="bg-amber-50/40 dark:bg-amber-950/10 p-6 rounded-lg border border-amber-100/50 dark:border-amber-900/30 space-y-4">
                            <h4 class="text-md font-bold text-amber-850 dark:text-amber-300">2. Health & Behaviour Check</h4>

                            <!-- Health Status -->
                            <div>
                                <x-input-label for="health_status" :value="__('Overall Appearance & Behaviour')" />
                                <select id="health_status" name="health_status" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-500 dark:focus:border-amber-600 focus:ring-amber-500 dark:focus:ring-amber-600 rounded-md shadow-sm" required>
                                    <option value="Healthy" {{ old('health_status') == 'Healthy' ? 'selected' : '' }}>Healthy (Active, normal posture)</option>
                                    <option value="Under Observation" {{ old('health_status') == 'Under Observation' ? 'selected' : '' }}>Under Observation (Slightly lethargic/minor concern)</option>
                                    <option value="Sick" {{ old('health_status') == 'Sick' ? 'selected' : '' }}>Sick (Lethargic, coughing, sneezing, abnormal stool)</option>
                                    <option value="Injured" {{ old('health_status') == 'Injured' ? 'selected' : '' }}>Injured (Wounds, limping)</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('health_status')" />
                            </div>

                            <!-- Symptoms -->
                            <div>
                                <x-input-label for="health_symptoms" :value="__('Symptoms / Remarks (Optional)')" />
                                <textarea id="health_symptoms" name="health_symptoms" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-500 dark:focus:border-amber-600 focus:ring-amber-500 dark:focus:ring-amber-600 rounded-md shadow-sm" placeholder="Describe symptoms or overall observations if sick, injured, or under observation...">{{ old('health_symptoms') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('health_symptoms')" />
                            </div>
                        </div>

                        <!-- SECTION 3: Eggs Collected -->
                        <div class="bg-emerald-50/40 dark:bg-emerald-950/10 p-6 rounded-lg border border-emerald-100/50 dark:border-emerald-900/30 space-y-4">
                            <h4 class="text-md font-bold text-emerald-850 dark:text-emerald-300">3. Egg Collection</h4>

                            <!-- Eggs Collected -->
                            <div>
                                <x-input-label for="eggs_collected" :value="__('Number of Eggs Collected')" />
                                <x-text-input id="eggs_collected" name="eggs_collected" type="number" min="0" class="mt-1 block w-full" :value="old('eggs_collected', 0)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('eggs_collected')" />
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('caretaker.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-750 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Record Entry') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
