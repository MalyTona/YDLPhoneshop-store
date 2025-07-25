<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStats::class
        ];
    }

    //funciton សម្រាប Filter Tap

    public function getTabs(): array
    {
        // for .env change to km 

        return [
            null => Tab::make('ទាំងអស់'),
            'new' => Tab::make('មានការបញ្ចាទិញថ្មី')->query(fn ($query) => $query->where('status', 'new')),
            'processing' => Tab::make('ការបញ្ចាទិញបានរៀបចំ')->query(fn ($query) => $query->where('status', 'processing')),
            'shipped' => Tab::make('ការបញ្ចាទិញបានដឹកជញ្ជូន')->query(fn ($query) => $query->where('status', 'shipped')),
            'delivered' => Tab::make('ការបញ្ចាទិញបានទៅដល់')->query(fn ($query) => $query->where('status', 'delivered')),
            'cancelled' => Tab::make('បានបោះបង់ការបញ្ជាទិញ')->query(fn ($query) => $query->where('status', 'cancelled')),

        ];

    //     return [
    //     null => Tab::make('All'), // ទាំងអស់
    //     'new' => Tab::make('New Orders')->query(fn ($query) => $query->where('status', 'new')), // មានការបញ្ចាទិញថ្មី
    //     'processing' => Tab::make('Processing Orders')->query(fn ($query) => $query->where('status', 'processing')), // ការបញ្ចាទិញបានរៀបចំ
    //     'shipped' => Tab::make('Shipped Orders')->query(fn ($query) => $query->where('status', 'shipped')), // ការបញ្ចាទិញបានដឹកជញ្ជូន
    //     'delivered' => Tab::make('Delivered Orders')->query(fn ($query) => $query->where('status', 'delivered')), // ការបញ្ចាទិញបានទៅដល់
    //     'cancelled' => Tab::make('Cancelled Orders')->query(fn ($query) => $query->where('status', 'cancelled')), // បានបោះបង់ការបញ្ជាទិញ
    // ];

    }
}
