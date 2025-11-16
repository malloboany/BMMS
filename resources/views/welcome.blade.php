<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Filament styles -->
    <link rel="stylesheet" href="{{ asset('css/filament/filament/app.css') }}">

    <!-- App styles / scripts (built by Vite) -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 flex flex-col font-sans">
    <header class="border-b bg-white/80 backdrop-blur">
        <div class="max-w-6xl mx-auto flex items-center justify-between px-4 py-4">
            <a href="#home" class="flex items-center gap-2">
                <span
                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-primary-600 text-white font-semibold">
                    B
                </span>
                <span class="font-semibold text-lg">Booking Management System</span>
            </a>
            <nav class="hidden md:flex items-center gap-3 text-sm">
                <a href="#home" class="px-3 py-1.5 rounded-md hover:bg-primary-50">Home</a>
                <a href="{{ url('/admin') }}" class="px-3 py-1.5 rounded-md hover:bg-primary-50">Login</a>
                <a href="#about-us" class="px-3 py-1.5 rounded-md hover:bg-primary-50">About Us</a>
                <a href="#privacy" class="px-3 py-1.5 rounded-md hover:bg-primary-50">Privacy</a>
                <a href="#developer" class="px-3 py-1.5 rounded-md hover:bg-primary-50">About Developer</a>
            </nav>
        </div>
    </header>

    <main id="home" class="flex-1">
        <section class="max-w-6xl mx-auto px-4 py-12 lg:py-20 flex flex-col-reverse lg:flex-row items-center gap-10">
            <div class="flex-1">
                <p
                    class="inline-flex items-center gap-2 text-xs font-medium text-primary-700 bg-primary-50 px-3 py-1 rounded-full mb-4">
                    Powered by Laravel &amp; Filament
                </p>
                <h1 class="text-3xl lg:text-4xl font-semibold mb-4">
                    Simple booking management for modern training centers
                </h1>
                <p class="text-slate-600 mb-6">
                    BMMS helps you organize training sessions, manage participants, and keep track of bookings
                    in one clean dashboard, built with Filament.
                </p>
                <ul class="space-y-2 text-sm text-slate-700 mb-8">
                    <li>• Centralize training schedules and locations</li>
                    <li>• Track attendees and confirmations</li>
                    <li>• Quickly search and filter bookings</li>
                    <li>• Designed for Illaftrain training centers</li>
                </ul>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ url('/admin') }}"
                        class="inline-flex items-center px-5 py-2.5 rounded-md bg-primary-600  text-sm font-medium hover:bg-primary-700">
                        Log in to dashboard
                    </a>
                    <a href="#about-us"
                        class="inline-flex items-center px-5 py-2.5 rounded-md border border-slate-200 text-sm font-medium text-slate-800 hover:bg-slate-100">
                        Learn more
                    </a>
                </div>
            </div>

            <div class="flex-1">
                <div class="relative">
                    <div
                        class="absolute -inset-4 rounded-3xl bg-gradient-to-tr from-primary-200 via-emerald-100 to-sky-200 opacity-60 blur-2xl">
                    </div>
                    <div class="relative rounded-3xl bg-white shadow-xl overflow-hidden border border-slate-100">
                        <img src="https://images.pexels.com/photos/1181675/pexels-photo-1181675.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=1200"
                            alt="Booking and calendar management illustration" class="w-full h-64 lg:h-80 object-cover">
                        <div class="p-4 border-t border-slate-100">
                            <p class="text-xs font-semibold text-primary-700 uppercase tracking-wide mb-1">
                                Classic booking workflow
                            </p>
                            <p class="text-sm text-slate-700">
                                From first request to confirmed seat, follow your training bookings step by step with
                                clear statuses and actions.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="about-us" class="border-t bg-white">
            <div class="max-w-6xl mx-auto px-4 py-10 lg:py-14 grid gap-8 lg:grid-cols-2">
                <div>
                    <h2 class="text-xl font-semibold mb-3">About Illaftrain</h2>
                    <p class="text-slate-700 text-sm mb-3">
                        Illaftrain is a specialized training center network focusing on practical, career‑oriented
                        education.
                        This booking system is designed to support locations such as the Illaftrain Turkey center.
                    </p>
                    <p class="text-slate-700 text-sm mb-4">
                        Learn more about Illaftrain Turkey and its programs:
                    </p>
                    <a href="https://www.illaftrain.co.uk/ar/location/TUR" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center px-4 py-2.5 rounded-md border border-primary-200 text-sm font-medium text-primary-700 hover:bg-primary-50">
                        Visit Illaftrain Turkey location page
                    </a>
                </div>
                <div class="text-sm text-slate-700">
                    <h3 class="font-semibold mb-3">Why a booking management system?</h3>
                    <p class="mb-3">
                        Training organizations need a clear, reliable way to track sessions, seats, and attendees.
                        BMMS aims to provide a clean interface for administrators while staying flexible for future
                        modules
                        like payments, attendance tracking, and reporting.
                    </p>
                    <p>
                        Built with Laravel and Filament, the system is ready to grow into a full back‑office solution
                        for Illaftrain centers and similar institutions.
                    </p>
                </div>
            </div>
        </section>

        <section id="privacy" class="border-t bg-slate-50">
            <div class="max-w-6xl mx-auto px-4 py-10 lg:py-12">
                <h2 class="text-xl font-semibold mb-3">Privacy</h2>
                <p class="text-sm text-slate-700 mb-2">
                    This booking system is intended for internal use by Illaftrain staff and authorized users.
                </p>
                <p class="text-sm text-slate-700 mb-2">
                    Booking data (such as participant names, contact details, and session information) is stored
                    securely
                    in a MySQL database managed by Laravel. Access to administrative pages is protected and can be
                    extended
                    with role‑based permissions using Filament.
                </p>
            </div>
        </section>

        <section id="developer" class="border-t bg-white">
            <div class="max-w-6xl mx-auto px-4 py-10 lg:py-12 grid gap-8 lg:grid-cols-[1.2fr,1fr] items-center">
                <div>
                    <h2 class="text-xl font-semibold mb-3">About the developer</h2>
                    <p class="text-sm text-slate-700 mb-3">
                        This booking management system is developed by Mohammed Alloboany, with a focus on clean code,
                        modern Laravel best practices, and a smooth Filament‑powered admin experience.
                    </p>
                    <p class="text-sm text-slate-700 mb-4">
                        Mohammed is passionate about building tools that make everyday operations easier for training
                        centers,
                        instructors, and administrators.
                    </p>
                    <a href="https://www.linkedin.com/in/mohammed-alloboany/" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center px-4 py-2.5 rounded-md bg-slate-900 text-white text-sm font-medium hover:bg-slate-800">
                        View LinkedIn profile
                    </a>
                </div>
                <div class="text-sm text-slate-600">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4">
                        <p class="font-medium mb-2">Tech stack</p>
                        <p class="mb-1">• Laravel 12 – backend framework</p>
                        <p class="mb-1">• Filament – admin panel &amp; UI toolkit</p>
                        <p class="mb-1">• MySQL – relational database</p>
                        <p>• Tailwind‑inspired styling for a clean landing page</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t bg-slate-900 text-slate-200 text-xs">
        <div class="max-w-6xl mx-auto px-4 py-4 flex flex-col md:flex-row items-center justify-between gap-2">
            <p>© {{ date('Y') }} Booking Management System for Illaftrain. All rights reserved.</p>
            <p class="text-slate-400">
                Built with Laravel &amp; Filament by <a href="https://www.linkedin.com/in/mohammed-alloboany/"
                    target="_blank" rel="noopener noreferrer">
                    Mohammed Alloboany.
                </a>
            </p>
        </div>
    </footer>
</body>

</html>
