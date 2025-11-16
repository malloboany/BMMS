<x-filament::section>
    <div class="flex flex-col gap-4">
        <div class="flex flex-wrap items-end gap-4">


            <div class="ml-auto text-sm text-gray-500 dark:text-gray-400">
                Analytics for <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $monthLabel }}</span>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Today's pending bookings
                </div>
                <div class="mt-2 text-3xl font-semibold text-gray-900 dark:text-gray-100">
                    {{ $todayPendingCount }}
                </div>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Pending this month
                </div>
                <div class="mt-2 text-3xl font-semibold text-amber-600">
                    {{ $statusCounts['pending'] }}
                </div>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Confirmed this month
                </div>
                <div class="mt-2 text-3xl font-semibold text-emerald-600">
                    {{ $statusCounts['confirmed'] }}
                </div>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Cancelled this month
                </div>
                <div class="mt-2 text-3xl font-semibold text-rose-600">
                    {{ $statusCounts['cancelled'] }}
                </div>
            </div>
        </div>

        <div>
            <div class="mb-2 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                    Bookings calendar
                </h3>

                <div class="flex items-center gap-3 text-xs text-gray-500 dark:text-gray-400">
                    <div class="flex items-center gap-1">
                        <span class="h-3 w-3 rounded-full bg-amber-500"></span>
                        <span>Pending</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="h-3 w-3 rounded-full bg-emerald-500"></span>
                        <span>Confirmed</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="h-3 w-3 rounded-full bg-rose-500"></span>
                        <span>Cancelled</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-7 text-xs font-medium text-gray-500 dark:text-gray-400">
                @foreach (['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $dayName)
                    <div class="py-1 text-center">
                        {{ $dayName }}
                    </div>
                @endforeach
            </div>

            <div
                class="mt-1 grid grid-cols-7 gap-px rounded-lg border border-gray-200 bg-gray-200 text-xs dark:border-gray-700 dark:bg-gray-700">
                @foreach ($weeks as $week)
                    @foreach ($week as $day)
                        <div
                            class="min-h-[80px] bg-white p-1 align-top text-gray-900 dark:bg-gray-900 dark:text-gray-100 @unless ($day['isCurrentMonth']) opacity-50 @endunless">
                            <div class="flex items-center justify-between">
                                <span class="text-[11px] font-semibold">
                                    {{ $day['date']->day }}
                                </span>
                            </div>

                            <div class="mt-1 space-y-0.5">
                                @foreach ($day['bookings'] as $booking)
                                    @php
                                        $statusColor = match ($booking->status) {
                                            'pending'
                                                => 'bg-amber-100 text-amber-800 dark:bg-amber-500/20 dark:text-amber-200',
                                            'confirmed'
                                                => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-200',
                                            'cancelled'
                                                => 'bg-rose-100 text-rose-800 dark:bg-rose-500/20 dark:text-rose-200',
                                            default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200',
                                        };
                                    @endphp

                                    <a
                                        href="{{ route('filament.admin.resources.bookings.edit', $booking) }}"
                                        wire:navigate
                                        class="block"
                                    >
                                        <div class="truncate rounded px-1 py-0.5 text-[10px] {{ $statusColor }}">
                                            {{ \Illuminate\Support\Str::limit($booking->customer_name, 18) }}
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

        <div class="mt-6">
            <div class="mb-2 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                    Today's bookings
                </h3>
            </div>

            @if ($todayBookings->isEmpty())
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    No bookings scheduled for today.
                </p>
            @else
                <div class="divide-y divide-gray-200 overflow-hidden rounded-xl border border-gray-200 bg-white dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-900">
                    @foreach ($todayBookings as $booking)
                        @php
                            $statusColor = match ($booking->status) {
                                'pending'
                                    => 'bg-amber-100 text-amber-800 dark:bg-amber-500/20 dark:text-amber-200',
                                'confirmed'
                                    => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-200',
                                'cancelled'
                                    => 'bg-rose-100 text-rose-800 dark:bg-rose-500/20 dark:text-rose-200',
                                default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200',
                            };
                        @endphp

                        <a
                            href="{{ route('filament.admin.resources.bookings.edit', $booking) }}"
                            wire:navigate
                            class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800"
                        >
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $booking->customer_name }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $booking->booking_date->format('H:i') }}
                                    </div>
                                </div>

                                <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-medium {{ $statusColor }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-filament::section>
