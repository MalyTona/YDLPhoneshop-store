<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('មានការបញ្ចាទិញថ្មី', Order::query()->where('status', 'new')->count()),
            Stat::make('ការបញ្ចាទិញបានរៀបចំ', Order::query()->where('status', 'processing')->count()),
            Stat::make('ការបញ្ចាទិញបានដឹកជញ្ជូន', Order::query()->where('status', 'shipped')->count()),
            Stat::make('ការបញ្ចាទិញបានទៅដល់', Order::query()->where('status', 'delivered')->count()),
            Stat::make('បានបោះបង់ការបញ្ជាទិញ', Order::query()->where('status', 'cancelled')->count()),
            Stat::make('មធ្យមសាច់ប្រាក់នៃការបញ្ជាទិញ', Number::currency(Order::query()->avg('grand_total'), 'USD'))

      
        ];
    }
}
