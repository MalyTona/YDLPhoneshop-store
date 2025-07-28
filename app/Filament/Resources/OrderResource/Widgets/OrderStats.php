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
        // for .env change to km 
        return [
            Stat::make('មានការបញ្ចាទិញថ្មី', Order::query()->where('status', 'new')->count()),
            Stat::make('ការបញ្ចាទិញបានរៀបចំ', Order::query()->where('status', 'processing')->count()),
            Stat::make('ការបញ្ចាទិញបានដឹកជញ្ជូន', Order::query()->where('status', 'shipped')->count()),
            Stat::make('ការបញ្ចាទិញបានទៅដល់', Order::query()->where('status', 'delivered')->count()),
            // Stat::make('បានបោះបង់ការបញ្ជាទិញ', Order::query()->where('status', 'cancelled')->count()),


            // Stat::make('Average Price', Number::currency(Order::query()->avg('grand_total'), 'USD')),
            Stat::make('តម្លៃមធ្យម (Average Price)', Number::currency(Order::query()->where('payment_status', 'paid')->avg('grand_total') ?? 0, 'USD')),

            // Corrected: Only sum the grand_total for orders where payment_status is 'paid'
            Stat::make('សាច់ប្រាក់សរុប (Revenue)', Number::currency(Order::query()->where('payment_status', 'paid')->sum('grand_total') ?? 0,  'USD')),




        ];
        // return [
        //     Stat::make('New Orders', Order::query()->where('status', 'new')->count()),
        //     Stat::make('Orders Processing', Order::query()->where('status', 'processing')->count()),
        //     Stat::make('Orders Shipped', Order::query()->where('status', 'shipped')->count()),
        //     Stat::make('Orders Delivered', Order::query()->where('status', 'delivered')->count()),
        //     Stat::make('Orders Cancelled', Order::query()->where('status', 'cancelled')->count()),
        // Stat::make('Average Order Value', Number::currency(Order::query()->avg('grand_total'), 'USD'))
        // Stat::make('Total Revenue', Number::currency(Order::query()->sum('grand_total'), 'USD'))

        // ];
    }
}
