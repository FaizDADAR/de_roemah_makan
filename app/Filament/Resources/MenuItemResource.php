<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuItemResource\Pages;
use App\Models\MenuItem;
use Filament\Forms\Components as Forms;
use Filament\Schemas\Components as Schemas;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\FileUpload;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Menu Items';
    protected static ?string $modelLabel = 'Menu Item';
    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return 'Restoran';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Schemas\Section::make('Informasi Menu')->schema([
                Forms\TextInput::make('name')
                    ->label('Nama Menu')
                    ->required()
                    ->maxLength(255),
                Forms\Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->rows(3),
                Forms\TextInput::make('price')
                    ->label('Harga (Rp)')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                Forms\Select::make('category')
                    ->label('Kategori')
                    ->required()
                    ->options([
                        'Hidangan Utama' => 'Hidangan Utama',
                        'Kue Kering' => 'Kue Kering',
                        'Kue Basah' => 'Kue Basah',
                        'Gorengan' => 'Gorengan',
                        'Kerupuk' => 'Kerupuk',
                        'Minuman' => 'Minuman',
                    ]),
                FileUpload::make('image_url')
                    ->label('Foto Menu')
                    ->image()
                    ->directory('images/menu')
                    ->disk('menu_images')
                    ->getUploadedFileNameForStorageUsing(function (FileUpload $component, $file, $record, $get) {
                        $name = $get('name') ?? 'menu';
                        return Str::slug($name) . '.' . $file->getClientOriginalExtension();
                    })
                    ->required(),
            ])->columns(2),

            Schemas\Section::make('Status & Konfigurasi')
                ->description('Atur ketersediaan dan label khusus untuk menu ini.')
                ->schema([
                    Forms\Grid::make(3)->schema([
                        Forms\Toggle::make('available')
                            ->label('Status Tersedia')
                            ->helperText('Aktifkan agar menu muncul di katalog.')
                            ->default(true)
                            ->columnSpanFull(),
                        
                        Forms\Toggle::make('is_best_seller')
                            ->label('Best Seller')
                            ->inline(false),
                        
                        Forms\Toggle::make('is_favorite')
                            ->label('Favorit')
                            ->inline(false),
                        
                        Forms\Toggle::make('is_recommended')
                            ->label('Rekomendasi')
                            ->inline(false),
                        
                        Forms\Toggle::make('is_popular')
                            ->label('Populer')
                            ->inline(false),
                    ])
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('image_url')
                    ->label('Foto')
                    ->formatStateUsing(fn ($state) => new \Illuminate\Support\HtmlString("<div class='w-12 h-12 overflow-hidden rounded-lg shadow-sm border border-gray-200'><img src='".asset($state)."' class='w-full h-full object-cover'></div>")),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                Tables\Columns\IconColumn::make('available')
                    ->label('Tersedia')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_best_seller')
                    ->label('Best Seller')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_recommended')
                    ->label('Rekomendasi')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'Hidangan Utama' => 'Hidangan Utama',
                        'Kue Kering' => 'Kue Kering',
                        'Kue Basah' => 'Kue Basah',
                        'Gorengan' => 'Gorengan',
                        'Kerupuk' => 'Kerupuk',
                        'Minuman' => 'Minuman',
                    ]),
                Tables\Filters\TernaryFilter::make('available')
                    ->label('Ketersediaan'),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('name');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenuItems::route('/'),
            'create' => Pages\CreateMenuItem::route('/create'),
            'edit' => Pages\EditMenuItem::route('/{record}/edit'),
        ];
    }
}
