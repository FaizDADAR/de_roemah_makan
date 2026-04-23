<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Catering;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalRevenue = Order::where('status', 'selesai')->sum('total');
        $newOrders = Order::where('status', 'pending')->count();
        $upcomingCatering = Catering::where('status', 'pending')
            ->whereBetween('date', [now(), now()->addDays(3)])
            ->count();

        return [
            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Dari pesanan selesai')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Pesanan Baru', $newOrders)
                ->description('Menunggu diproses')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('warning'),
            Stat::make('Catering Mendatang', $upcomingCatering)
                ->description('Dalam 3 hari ke depan')
                ->descriptionIcon('heroicon-m-truck')
                ->color($upcomingCatering > 0 ? 'danger' : 'info'),
        ];
    }
}
