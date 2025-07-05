<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Order;

class LatestOrders extends BaseWidget
{
    //Make LatestOrder full 
    protected int | string | array $columnSpan = 'full';

    //display OrderStats OnTop 
    protected static ?int $sort =2;

    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label('Order ID')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('grand_total')

                    ->money('USD'),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state):string => match($state){
                        'new' => 'info',
                        'processing' => 'warning',
                        'shipped' => 'success',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                    })
                    ->icon(fn(string $state):string => match($state){
                        'new' => 'heroicon-o-sparkles', 
                        'processing' => 'heroicon-o-arrow-path',
                        'shipped' => 'heroicon-o-truck',              
                        'delivered' => 'heroicon-o-home',            
                        'cancelled' => 'heroicon-o-arrow-uturn-left', 
                    } )
                    ->sortable(),

                TextColumn::make('payment_method')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('payment_status')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning', // For "pending" status
                        'paid' => 'success',    // For "paid" status
                        'failed' => 'danger',     // For "failed" status
                        default => 'gray',      // Fallback for any other status
                    }),


                TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                 Action::make('View Order')
                    ->url(fn (Order $record): string => OrderResource::getUrl('view', ['record' => $record]))
                    ->color('info')
                    ->icon('heroicon-o-eye'),
            ]);
    }
}
