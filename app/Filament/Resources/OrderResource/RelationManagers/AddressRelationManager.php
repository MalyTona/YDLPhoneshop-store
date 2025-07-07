<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
class AddressRelationManager extends RelationManager
{
    protected static string $relationship = 'address';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('phone')
                    ->required()
                    ->tel()
                    ->maxLength(20),

                Select::make('province')
                    ->required()
                    ->options([
                        'Phnom Penh' => 'Phnom Penh',
                        'Banteay Meanchey' => 'Banteay Meanchey',
                        'Battambang' => 'Battambang',
                        'Kampong Cham' => 'Kampong Cham',
                        'Kampong Chhnang' => 'Kampong Chhnang',
                        'Kampong Speu' => 'Kampong Speu',
                        'Kampong Thom' => 'Kampong Thom',
                        'Kampot' => 'Kampot',
                        'Kandal' => 'Kandal',
                        'Kep' => 'Kep',
                        'Koh Kong' => 'Koh Kong',
                        'Kratie' => 'Kratie',
                        'Mondulkiri' => 'Mondulkiri',
                        'Oddar Meanchey' => 'Oddar Meanchey',
                        'Pailin' => 'Pailin',
                        'Preah Sihanouk' => 'Preah Sihanouk',
                        'Preah Vihear' => 'Preah Vihear',
                        'Prey Veng' => 'Prey Veng',
                        'Pursat' => 'Pursat',
                        'Ratanakiri' => 'Ratanakiri',
                        'Siem Reap' => 'Siem Reap',
                        'Stung Treng' => 'Stung Treng',
                        'Svay Rieng' => 'Svay Rieng',
                        'Takeo' => 'Takeo',
                        'Tboung Khmum' => 'Tboung Khmum',
                    ]),
                    
                Textarea::make('street_address')
                    ->required()
                    ->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('street_address')
            ->columns([
                TextColumn::make('fullname')
                    ->label('Full Name'),

                TextColumn::make('phone'),

                TextColumn::make('province'),

                TextColumn::make('street_address'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
