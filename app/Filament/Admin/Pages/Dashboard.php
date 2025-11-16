<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Admin\Widgets\BookingsAnalytics;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;

class Dashboard extends BaseDashboard
{
    public function getColumns(): int | array
    {
        return 1;
    }

    /**
     * @return array<class-string>
     */
    public function getWidgets(): array
    {
        return [
            AccountWidget::class,
            BookingsAnalytics::class,
        ];
    }
}
