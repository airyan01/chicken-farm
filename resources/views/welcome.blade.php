<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Chicken Farm Management System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts / Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-800 min-h-screen flex flex-col justify-between">
        
        <!-- Navbar -->
        <nav class="bg-white border-b border-gray-250 py-4 px-6">
            <div class="max-w-6xl mx-auto flex justify-between items-center">
                <span class="text-lg font-bold text-gray-900">🐔 Chicken Farm Management System</span>
                
                @if (Route::has('login'))
                    <div class="space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-indigo-600 hover:underline">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:underline">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-semibold text-gray-600 hover:underline">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </nav>

        <!-- Hero / Header Section -->
        <main class="max-w-4xl mx-auto px-6 py-12 flex-grow">
            <div class="bg-white border border-gray-200 rounded-lg p-8 shadow-sm mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Welcome to the Chicken Farm Management System</h1>
                <p class="text-gray-600 leading-relaxed mb-6">
                    This is a collaborative web platform built to manage poultry inventory, track daily chicken care logs, and monitor egg collections. The system facilitates role-based collaboration between Farm Owners (Admins) and Daily Barn Caretakers.
                </p>
                
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded shadow">
                        Open Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded shadow">
                        Log In to Start
                    </a>
                @endauth
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                
                <!-- Feature 1 -->
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                    <h3 class="font-bold text-gray-900 text-lg mb-2">👤 Role-Based Portals</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Secure access control built for two user roles:
                        <br>• **Admins** manage stock inventory and review logs.
                        <br>• **Caretakers** log daily feeding details and record collections.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                    <h3 class="font-bold text-gray-900 text-lg mb-2">📋 Inventory & Assignment</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Admins can perform complete CRUD actions to register chickens (tag name, breed, date acquired) and assign them to specific caretaker staff.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                    <h3 class="font-bold text-gray-900 text-lg mb-2">✍️ Care Logging</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Caretakers record daily care logs for assigned chickens including:
                        <br>• Feeding type, quantity, and time.
                        <br>• Health status check-ins and remarks.
                        <br>• Daily egg collection counts.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                    <h3 class="font-bold text-gray-900 text-lg mb-2">📊 Dashboard & History</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Admins see real-time coop metrics (total stock, eggs collected today, sick alerts) and can filter historical entries by stock tag and date ranges.
                    </p>
                </div>

            </div>

            <!-- How It Works Section -->
            <div class="bg-white border border-gray-200 rounded-lg p-8 shadow-sm">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">How the System Works</h2>
                <ol class="list-decimal list-inside space-y-3 text-sm text-gray-600 leading-relaxed">
                    <li>**flock Registration**: The Farm Admin registers the chicken stock inventory and assigns them to caretakers.</li>
                    <li>**Daily Barn Care**: Caretakers log into their portal, see their assigned chickens, and submit daily feed, health, and egg data.</li>
                    <li>**Centralized Reporting**: The system aggregates today's observations on the Admin dashboard and logs a chronological care history timeline.</li>
                </ol>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-6">
            <div class="max-w-6xl mx-auto px-6 text-center text-xs text-gray-500">
                <p>&copy; {{ date('Y') }} Chicken Farm Management System. Academic Group Project.</p>
            </div>
        </footer>

    </body>
</html>
