<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('Download Invoice')
                ->icon('heroicon-o-arrow-down-tray')
                ->url(fn() => route('invoice.download', $this->record))
                ->openUrlInNewTab(),
        ];
    }
}
