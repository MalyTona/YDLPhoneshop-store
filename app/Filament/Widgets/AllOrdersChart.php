<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

/**
 * This widget displays a chart for ALL orders, including paid, pending, and other statuses.
 * It's designed to give an overview of all store activity and potential revenue.
 */
class AllOrdersChart extends ChartWidget
{
    /**
     * The title displayed at the top of the chart widget.
     */
    protected static ?string $heading = 'All Orders & Potential Revenue';

    /**
     * The default filter that is active when the chart first loads.
     */
    public ?string $filter = 'week';

    /**
     * Defines the options available in the filter dropdown on the chart.
     * The key is the value used in the code (e.g., 'week'), and the value is the text displayed to the user (e.g., 'Last 7 Days').
     */
    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last 7 Days',
            'month' => 'Last 30 Days',
            'year' => 'This Year',
        ];
    }

    /**
     * This is the main function that fetches and prepares the data for the chart.
     * It runs every time the filter is changed.
     */
    protected function getData(): array
    {
        // Get the currently selected filter value (e.g., 'week').
        $activeFilter = $this->filter;

        // Start a new query on the Order model. This query will fetch ALL orders.
        $query = Order::query();

        // Use a switch statement to apply the correct date range based on the active filter.
        switch ($activeFilter) {
            case 'today':
                $query->whereDate('created_at', Carbon::today());
                break;
            case 'week':
                $query->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()]);
                break;
            case 'month':
                $query->whereBetween('created_at', [Carbon::now()->subDays(29)->startOfDay(), Carbon::now()->endOfDay()]);
                break;
            case 'year':
                $query->whereYear('created_at', Carbon::now()->year);
                break;
        }

        // Execute the query and format the results.
        $data = $query->selectRaw('DATE(created_at) as date, SUM(grand_total) as potential_revenue, COUNT(*) as total_orders')
            ->groupBy('date') // Group the results by day
            ->orderBy('date', 'asc') // Order the results by date
            ->get();

        // Prepare the data for the chart's datasets and labels.
        $labels = $data->map(fn($item) => Carbon::parse($item->date)->format('d M'))->toArray();
        $revenue = $data->map(fn($item) => $item->potential_revenue)->toArray();
        $orders = $data->map(fn($item) => $item->total_orders)->toArray();

        // Return the final data structure that Chart.js expects.
        return [
            'datasets' => [
                [
                    'label' => 'Potential Revenue',
                    'data' => $revenue,
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'yAxisID' => 'revenueY', // Links this dataset to the left Y-axis
                ],
                [
                    'label' => 'Total Orders',
                    'data' => $orders,
                    'borderColor' => 'rgba(255, 159, 64, 1)',
                    'backgroundColor' => 'rgba(255, 159, 64, 0.2)',
                    'yAxisID' => 'ordersY', // Links this dataset to the right Y-axis
                ],
            ],
            'labels' => $labels,
        ];
    }

    /**
     * Sets the type of chart to display.
     * Options include: 'line', 'bar', 'pie', 'doughnut', etc.
     */
    protected function getType(): string
    {
        return 'line';
    }

    /**
     * Provides advanced configuration options for the Chart.js library.
     * This is used here to create two separate Y-axes for revenue and order count.
     */
    protected function getOptions(): array
    {
        return [
            'scales' => [
                'revenueY' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'left', // Position on the left side
                    'title' => [
                        'display' => true,
                        'text' => 'Potential Revenue ($)',
                    ],
                ],
                'ordersY' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'right', // Position on the right side
                    'title' => [
                        'display' => true,
                        'text' => 'Total Orders',
                    ],
                    'grid' => [
                        'drawOnChartArea' => false, // Prevents grid lines from overlapping
                    ],
                ],
            ],
        ];
    }
}
