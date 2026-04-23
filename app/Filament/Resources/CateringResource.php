<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CateringResource\Pages;
use App\Models\Catering;
use Filament\Forms\Components as Forms;
use Filament\Schemas\Components as Schemas;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class CateringResource extends Resource
{
    protected static ?string $model = Catering::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Catering';
    protected static ?string $modelLabel = 'Catering';
    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')
            ->whereBetween('date', [now(), now()->addDays(3)])
            ->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Restoran';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Schemas\Section::make('Informasi Catering')->schema([
                Forms\TextInput::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->required(),
                Forms\TextInput::make('phone')
                    ->label('Nomor HP')
                    ->required(),
                Forms\TextInput::make('people')
                    ->label('Jumlah Porsi')
                    ->numeric()
                    ->required(),
                Forms\DatePicker::make('date')
                    ->label('Tanggal')
                    ->required(),
                Forms\TextInput::make('time')
                    ->label('Jam')
                    ->required(),
                Forms\Textarea::make('note')
                    ->label('Catatan')
                    ->rows(2),
                Forms\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'dikonfirmasi' => 'Dikonfirmasi',
                    ])
                    ->required(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->formatStateUsing(fn ($state) => '#' . str_pad($state, 6, '0', STR_PAD_LEFT))
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Pelanggan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('HP')
                    ->searchable(),
                Tables\Columns\TextColumn::make('people')
                    ->label('Orang')
                    ->suffix(' orang'),
                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable()
                    ->description(fn ($record) => 
                        Catering::where('date', $record->date)->where('id', '!=', $record->id)->count() > 0 
                        ? '⚠️ Bentrok dengan pesanan lain!' 
                        : (now()->diffInDays($record->date, false) <= 3 && now()->diffInDays($record->date, false) >= 0 ? '⏰ Segera diantar!' : null)
                    )
                    ->color(fn ($record) => 
                        Catering::where('date', $record->date)->where('id', '!=', $record->id)->count() > 0 
                        ? 'danger' 
                        : (now()->diffInDays($record->date, false) <= 3 && now()->diffInDays($record->date, false) >= 0 ? 'warning' : null)
                    ),
                Tables\Columns\TextColumn::make('time')
                    ->label('Jam'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'dikonfirmasi' => 'success',
                        default => 'secondary',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'dikonfirmasi' => 'Dikonfirmasi',
                    ]),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCaterings::route('/'),
            'edit' => Pages\EditCatering::route('/{record}/edit'),
        ];
    }
}
