<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Category;
use App\Models\Member;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Total Books', Book::count())
                ->icon('heroicon-o-book-open')
                ->color('primary'),

            Stat::make('Total Categories', Category::count())
                ->icon('heroicon-o-rectangle-stack')
                ->color('primary'),

            Stat::make('Total Borrowings', Borrowing::where('status', 'borrowed')->count())
                ->icon('heroicon-o-clipboard-document-list')
                ->color('warning'),

            Stat::make('Total Overdues', Borrowing::where('status', 'overdue')->count())
                ->icon('heroicon-o-clipboard-document-list')
                ->color('warning'),

            Stat::make('Unpaid Fines', Borrowing::where('status', 'unpaid')->count())
                ->icon('heroicon-o-currency-dollar')
                ->color('warning'),

            Stat::make('Total Members (Active)', Member::where('status', 'active')->count() . ' / ' . Member::count())
                ->icon('heroicon-o-users')
                ->color('success'),

            Stat::make('Pending Reservations', Borrowing::where('status', 'pending')->count())
                ->icon('heroicon-o-calendar')
                ->color('danger'),
        ];
    }
}
