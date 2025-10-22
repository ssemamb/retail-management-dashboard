<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class RecentOrders extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Recent Orders';

    protected string|int |array $columnSpan = 'full';
    protected  static ?int $sort = 1;

    protected function getData(): array
    {
        $start = $this->filters['Start_date'] ?? null;
        $end = $this->filters['End_date'] ?? null;

        $data = Trend::model(Order::class)
            ->between(
                start: $start ? Carbon::parse($start) : now()->subMonths(6),
                end: $end ? Carbon::parse($end) : now(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Recent Orders',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate)->toArray(),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => Carbon::parse($value->date)->format('M Y'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
