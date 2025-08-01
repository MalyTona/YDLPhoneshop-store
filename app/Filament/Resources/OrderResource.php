<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Number;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    //custome navbar name into khmer
    public static function getNavigationLabel(): string
    {
        return __('ការបញ្ជាទិញ');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Order Details')->schema([
                        Select::make('user_id')
                            ->label('Customer')
                            ->relationship('user', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Select::make('payment_method')
                            ->options([
                                'stripe' => 'Stripe',
                                'bakong' => 'Direct Bank Transfer',
                            ])
                            ->required(),

                        Select::make('payment_status')
                            ->options([
                                'pending' => 'Pending',
                                'paid' => 'Paid',
                                'failed' => 'Failed',
                            ])
                            ->default('pending')
                            ->required(),


                        ToggleButtons::make('status')
                            ->inline()
                            ->default('new')
                            ->required()
                            ->options([
                                'new' => 'New',
                                'processing' => 'Processing',
                                'shipped' => 'Shipped',
                                'delivered' => 'Delivered',
                                'cancelled' => 'Cancelled',
                            ])
                            ->colors([
                                'new' => 'info',
                                'processing' => 'warning',
                                'shipped' => 'success',
                                'delivered' => 'success',
                                'cancelled' => 'danger',
                            ])
                            ->icons([
                                'new' => 'heroicon-o-sparkles',
                                'processing' => 'heroicon-o-arrow-path',
                                'shipped' => 'heroicon-o-truck',
                                'delivered' => 'heroicon-o-home',
                                'cancelled' => 'heroicon-o-arrow-uturn-left',
                            ]),
                        Select::make('currency')
                            ->options([
                                'usd' => 'USD',
                                'khr' => 'KHR',
                            ])
                            ->default('USD')
                            ->required(),
                        Select::make('shipping_method')
                            ->options([
                                'VET Express' => 'VET Express',
                                'J&T Express' => 'J&T Express',
                            ]),
                        // ADD a field for shipping amount
                        TextInput::make('shipping_amount')
                            ->numeric()
                            ->required()
                            ->default(0)
                            ->prefix('$')
                            ->reactive()
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                $total = 0;
                                $items = $get('items');
                                if ($items) {
                                    foreach ($items as $item) {
                                        $total += $item['total_amount'];
                                    }
                                }
                                $shipping = $get('shipping_amount') ?? 0;
                                $set('grand_total', $total + $shipping);
                            }),
                        Textarea::make('notes')
                            ->columnSpanFull()
                            ->placeholder('Additional notes or instructions for the order')
                    ])->columns(2),
                    Section::make('Order Items')->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Select::make('product_id')
                                    ->relationship('product', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->columnSpan(4)
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, Set $set) {
                                        $product = Product::find($state);
                                        $price = $product?->price ?? 0;
                                        $set('unit_amount', $price);
                                        $set('total_amount', $price);
                                    }),

                                TextInput::make('quantity')
                                    ->numeric()
                                    ->required()
                                    ->minValue(1)
                                    ->default(1)
                                    ->columnSpan(2)
                                    ->reactive()
                                    ->afterStateUpdated(fn($state, Set $set, Get $get) => $set('total_amount', $state * $get('unit_amount'))),

                                TextInput::make('unit_amount')
                                    ->numeric()
                                    ->required()
                                    ->disabled()
                                    ->dehydrated()
                                    ->prefix('$')
                                    ->columnSpan(3),

                                TextInput::make('total_amount')
                                    ->numeric()
                                    ->required()
                                    ->dehydrated()
                                    ->prefix('$')
                                    ->columnSpan(3)

                            ])->columns(12)
                            ->reactive()
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                $total = 0;
                                $items = $get('items');
                                if ($items) {
                                    foreach ($items as $item) {
                                        $total += $item['total_amount'];
                                    }
                                }
                                $shipping = $get('shipping_amount') ?? 0;
                                $set('grand_total', $total + $shipping);
                            }),

                        Placeholder::make('grand_total_placeholder')
                            ->label('Grand Total')
                            ->content(function (Get $get, Set $set) {
                                $total = 0;
                                if (!$repeaters = $get('items')) {
                                    $total = 0;
                                } else {
                                    foreach ($repeaters as $key => $repeater) {
                                        $total += $get("items.{$key}.total_amount") ?? 0;
                                    }
                                }

                                $shipping = $get('shipping_amount') ?? 0;
                                $grand_total = $total + $shipping;

                                $set('grand_total', $grand_total);
                                return '$' . number_format($grand_total, 2);
                            }),

                        Hidden::make('grand_total')
                            ->default(0)
                    ])

                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label('Order ID')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('grand_total')
                    ->numeric()
                    ->searchable()
                    ->sortable()
                    ->money('USD'),

                TextColumn::make('payment_method')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('payment_status')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('currency')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('shipping_method')
                    ->searchable()
                    ->sortable(),


                SelectColumn::make('status')
                    ->options([
                        'new' => 'New',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ])
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                    Action::make('Download Invoice')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->url(fn(Order $record) => route('invoice.download', $record))
                        ->openUrlInNewTab(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AddressRelationManager::class
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 10 ? 'success' : 'danger';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
