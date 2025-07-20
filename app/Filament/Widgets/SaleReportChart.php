<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class SaleReportChart extends ChartWidget
{
    protected static ?string $heading = 'Sales Report';

    public ?string $filter = 'today';

    protected int | string | array $columnSpan = 'full';

    /**
     * Dispatch event on initial load to sync the page.
     */
    public function mount(): void
    {
        $this->dispatch('filterChanged', filter: $this->filter);
    }

    /**
     * Dispatch event whenever the filter is updated.
     */
    public function updatedFilter(string $value): void
    {
        $this->dispatch('filterChanged', filter: $value);
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last 7 Days',
            'month' => 'Last 30 Days',
            'year' => 'This Year',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        $query = Order::query()->where('payment_status', 'paid');

        switch ($activeFilter) {
            case 'today':
                $query->whereDate('created_at', Carbon::today());
                break;
            case 'week':
                // Corrected logic for a rolling 7-day period
                $query->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()]);
                break;
            case 'month':
                // Corrected logic for a rolling 30-day period
                $query->whereBetween('created_at', [Carbon::now()->subDays(29)->startOfDay(), Carbon::now()->endOfDay()]);
                break;
            case 'year':
                $query->whereYear('created_at', Carbon::now()->year);
                break;
        }

        $data = $query->selectRaw('DATE(created_at) as date, SUM(grand_total) as total_revenue, COUNT(*) as total_orders')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $labels = $data->map(fn($item) => Carbon::parse($item->date)->format('d M'))->toArray();
        $revenue = $data->map(fn($item) => $item->total_revenue)->toArray();
        $orders = $data->map(fn($item) => $item->total_orders)->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Total Revenue',
                    'data' => $revenue,
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'yAxisID' => 'revenueY',
                ],
                [
                    'label' => 'Total Orders',
                    'data' => $orders,
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'yAxisID' => 'ordersY',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'revenueY' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'left',
                    'title' => [
                        'display' => true,
                        'text' => 'Revenue ($)',
                    ],
                ],
                'ordersY' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'right',
                    'title' => [
                        'display' => true,
                        'text' => 'Orders',
                    ],
                    'grid' => [
                        'drawOnChartArea' => false,
                    ],
                ],
            ],
        ];
    }
}
