<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactInfoResource\Pages;
use App\Models\ContactInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactInfoResource extends Resource
{
    protected static ?string $model = ContactInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';
    //custome navbar name into khmer
    public static function getNavigationLabel(): string
    {
        return __('ព័ត៌មានទំនាក់ទំនង ');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Header Content')
                    ->schema([
                        Forms\Components\TextInput::make('title_main')
                            ->required(),
                        Forms\Components\TextInput::make('title_highlight')
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->rows(3),
                    ]),

                Forms\Components\Section::make('Contact Details')
                    ->schema([
                        Forms\Components\TextInput::make('address')
                            ->required(),
                        Forms\Components\TextInput::make('phone_1')
                            ->tel()
                            ->required(),
                        Forms\Components\TextInput::make('phone_2')
                            ->tel(),
                        Forms\Components\TextInput::make('opening_hours')
                            ->required(),
                        Forms\Components\TextInput::make('telegram_link')
                            ->url(),
                    ]),

                Forms\Components\Section::make('Map Links')
                    ->schema([
                        Forms\Components\Textarea::make('map_embed_url')
                            ->label('Google Maps Embed URL')
                            ->required()
                            ->rows(3),
                        Forms\Components\Textarea::make('map_directions_link')
                            ->label('Google Maps Directions URL')
                            ->required()
                            ->rows(3),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title_main')
                    ->label('Title'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('phone_1')
                    ->label('Phone Number'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // We disable bulk actions since there's only one record.
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactInfos::route('/'),
            'edit' => Pages\EditContactInfo::route('/{record}/edit'),
        ];
    }
}
