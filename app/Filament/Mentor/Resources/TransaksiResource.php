<?php

namespace App\Filament\Mentor\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Transaksi;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Enums\LaosCourse\Transaksi\StatusEnum;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Mentor\Resources\TransaksiResource\Pages;
use App\Filament\Mentor\Resources\TransaksiResource\RelationManagers;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Transaksi';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Transaksi::query()->whereHas('kursus', function($query)
            {
                $query->whereHas('mentors', function($query)
                {
                    $query->where('id', auth()->user()->id);
                });
            }))
            ->columns([
                Tables\Columns\TextColumn::make('order_id')
                    ->weight(FontWeight::Bold)
                    ->searchable(),
                Tables\Columns\TextColumn::make('student.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kursus.judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('diskon.kode')
                    ->getStateUsing(fn(Transaksi $record) => $record->diskon_kode ?? '-')
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->getStateUsing(fn(Transaksi $record) => $record->status->getLabel() ?? '-')
                    ->color(fn(Transaksi $record) => $record->status->color() ?? 'secondary'),
                Tables\Columns\TextColumn::make('total_harga')
                    ->money('IDR')
                    ->weight(FontWeight::Bold)
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(StatusEnum::class)
            ], layout: FiltersLayout::AboveContent)
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTransaksis::route('/'),
        ];
    }
}
