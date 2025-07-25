<?php

namespace App\Filament\Pages;

use App\Exports\OrdersExport;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use App\Filament\Widgets\AllOrdersChart;
use App\Filament\Widgets\LatestOrders;
use Filament\Pages\Page;
use App\Filament\Widgets\SaleReportChart;
use Filament\Actions\Action;
use Livewire\Attributes\On;
use Maatwebsite\Excel\Facades\Excel;

class SaleReport extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static string $view = 'filament.pages.sale-report';

    protected static ?string $navigationGroup = 'Reports';

    protected static ?string $title = 'Sale Report';
    //custome navbar name into khmer
    public static function getNavigationLabel(): string
    {
        return __('របាយការលក់');
    }
    protected static ?int $navigationSort = 1;

    public ?string $filter = 'today';

    #[On('filterChanged')]
    public function updateFilter(string $filter): void
    {
        $this->filter = $filter;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStats::class,
            SaleReportChart::class,
            // LatestOrders::class,
            AllOrdersChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export')
                ->label('Export to Excel')
                ->action(fn() => Excel::download(new OrdersExport($this->filter), 'sales-report-' . $this->filter . '.xlsx'))
                ->icon('heroicon-o-arrow-down-tray'),
        ];
    }
}
