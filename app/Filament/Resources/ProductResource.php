<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Arr;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';
    //Global search Product
    protected static ?string $recordTitleAttribute = 'name';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Product Details')->schema([
                       TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                // ប្រសិនបើប្រតិបត្តិការមិនមែនជា 'create' ទេ វានឹងត្រឡប់ចេញវិញ។
                                if ($operation !== 'create') {
                                    return;
                                }
                               
                                // (បម្លែងឈ្មោះផលិតផលឲ្យសមរម្យសម្រាប់ URL)
                                $set('slug', Str::slug($state));
                            }),
                        
                       TextInput::make('slug')
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated()
                            ->required()
                            ->unique(Product::class, 'slug', ignoreRecord: true),
                        
                       RichEditor::make('description')
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('products')
                             ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ])
                         ])->columns(2),
                       
                    // File upload for product images
                    Section::make('Product Images')->schema([
                        FileUpload::make('images')
                            ->multiple()
                            ->directory('products')
                            ->maxFiles(5)
                            ->reorderable(),
                    ])
                    ])->columnSpan(2),


                    Group::make()->schema([
                        Section::make('Price')->schema([
                            TextInput::make('price')
                            ->numeric()
                            ->required()
                            ->prefix('$')
                        ]),

                        Section::make('Associated Categories')->schema([
                            // Category association
                        Select::make('category_id') 
                            ->relationship('category', 'name') 
                            ->searchable()
                            ->preload()
                            ->required(),
                            // Brand association
                        Select::make('brand_id') 
                            ->relationship('brand', 'name') 
                            ->searchable()
                            ->preload()
                            ->required(),
                        ]),
                        Section::make('Status')->schema([
                            Toggle::make('in_stock')
                                ->required()
                                ->default(true),
                            
                            Toggle::make('is_active')
                                ->required()
                                ->default(true),

                            Toggle::make('is_featured')
                                ->required(),
                            
                            Toggle::make('on_sale')
                                ->required(),
                              
                        ]),
                    ])->columnSpan(1)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                ImageColumn::make('images') 
                ->label('Product Image')
                ->state(function ($record) {
                    // Check if the images attribute is an array and not empty
                    if (is_array($record->images) && !empty($record->images)) {
                        // Return the first image from the array
                        return Arr::first($record->images);
                    }
                    // Return null or a default placeholder if no images exist
                    return null;
                    
                }),
                    

                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('category.name')
                ->searchable()
                ->sortable(),
                TextColumn::make('brand.name')
                ->searchable()
                ->sortable(),
                TextColumn::make('price')
                ->money('USD')
                ->sortable(),
               
                IconColumn::make('is_featured')
                ->boolean(),
                IconColumn::make('on_sale')
                ->boolean(),
                IconColumn::make('in_stock')
                ->boolean(),
                IconColumn::make('is_active')
                ->boolean(),
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
                SelectFIlter::make('category')
                    ->relationship('category', 'name'),    
                SelectFIlter::make('brand')
                    ->relationship('brand', 'name'),              
            ])
            ->actions([
                 Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
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
            //
        ];
    }
    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'slug'];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}