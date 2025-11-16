<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Booking;
use Carbon\Carbon;
use Filament\Widgets\Widget;

class BookingsAnalytics extends Widget
{
    protected static bool $isDiscovered = true;

    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected string $view = 'filament.admin.widgets.bookings-analytics';

    public int $year;

    public int $month;

    public function mount(): void
    {
        $now = now();

        $this->year = (int) $now->year;
        $this->month = (int) $now->month;
    }

    public static function canView(): bool
    {
        return auth()->user()?->can('manage bookings') ?? false;
    }

    /**
     * @return array<string, mixed>
     */
    protected function getViewData(): array
    {
        $todayPendingCount = Booking::query()
            ->whereDate('booking_date', today())
            ->where('status', 'pending')
            ->count();

        $todayBookings = Booking::query()
            ->whereDate('booking_date', today())
            ->orderBy('booking_date')
            ->get(['id', 'customer_name', 'status', 'booking_date', 'service_type_id']);

        $monthStart = Carbon::create($this->year, $this->month, 1)->startOfMonth();
        $monthEnd = $monthStart->copy()->endOfMonth();

        $statusCounts = Booking::query()
            ->selectRaw('status, count(*) as aggregate')
            ->whereBetween('booking_date', [$monthStart, $monthEnd])
            ->groupBy('status')
            ->pluck('aggregate', 'status')
            ->all();

        $bookings = Booking::query()
            ->whereBetween('booking_date', [$monthStart, $monthEnd])
            ->orderBy('booking_date')
            ->get(['id', 'customer_name', 'status', 'booking_date', 'service_type_id']);

        $bookingsByDate = $bookings->groupBy(fn (Booking $booking) => $booking->booking_date->toDateString());

        $startOfCalendar = $monthStart->copy()->startOfWeek();
        $endOfCalendar = $monthEnd->copy()->endOfWeek();

        $weeks = [];
        $current = $startOfCalendar->copy();

        while ($current <= $endOfCalendar) {
            $week = [];

            for ($i = 0; $i < 7; $i++) {
                $dateString = $current->toDateString();

                $week[] = [
                    'date' => $current->copy(),
                    'isCurrentMonth' => $current->month === $monthStart->month,
                    'bookings' => $bookingsByDate->get($dateString, collect()),
                ];

                $current->addDay();
            }

            $weeks[] = $week;
        }

        $yearOptions = range((int) now()->year - 5, (int) now()->year + 1);

        return [
            'todayPendingCount' => $todayPendingCount,
            'statusCounts' => [
                'pending' => $statusCounts['pending'] ?? 0,
                'confirmed' => $statusCounts['confirmed'] ?? 0,
                'cancelled' => $statusCounts['cancelled'] ?? 0,
            ],
            'monthLabel' => $monthStart->isoFormat('MMMM YYYY'),
            'weeks' => $weeks,
            'yearOptions' => $yearOptions,
            'todayBookings' => $todayBookings,
        ];
    }
}
