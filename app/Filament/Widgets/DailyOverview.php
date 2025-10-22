<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DailyOverview extends StatsOverviewWidget
{
    use InteractsWithPageFilters;
    protected  static ?int $sort = 2;


    protected function getStats(): array
    {

        $start = $this->filters['Start_date'] ?? null;
        $end = $this->filters['End_date'] ?? null;

        return [
            Stat::make(
                ' Products',
                Product::when(
                    $start,
                    fn($query) => $query->whereDate('created_at', '>', $start)
                )
                    ->when(
                        $end,
                        fn($query) => $query->WhereDate('created_at', '<', $end)
                    )
                    ->count()
            )

                ->description('Recent Products')
                ->chart([1, 3, 4, 7, 10])
                ->color('danger'),
            Stat::make(' Orders', Order::count())
                ->description('Recent Orders')
                ->chart([1, 2, 3])
                ->color('success'),
            Stat::make('Categores', Category::count())
                ->description('Recent Categoories')
                ->chart([1, 2, 3])
                ->color('info')


        ];
    }
}
