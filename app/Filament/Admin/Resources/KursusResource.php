<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Kursus;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Enums\FiltersLayout;
use App\Enums\LaosCourse\Kursus\TipeEnum;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Enums\LaosCourse\Kursus\LevelEnum;
use App\Enums\LaosCourse\Kursus\KategoriEnum;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\KursusResource\Pages;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use App\Filament\Admin\Resources\KursusResource\RelationManagers;

class KursusResource extends Resource
{
    protected static ?string $model = Kursus::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Kursus';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kategori')
                    ->required(),
                Forms\Components\Textarea::make('deskripsi')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('keypoints')
                    ->required(),
                Forms\Components\TextInput::make('level')
                    ->required(),
                Forms\Components\TextInput::make('tipe')
                    ->required(),
                Forms\Components\TextInput::make('harga')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_published')
                    ->required(),
                Forms\Components\Textarea::make('resource_url')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Kursus::query()->withCount(['students', 'mentors']))
            ->columns([
                SpatieMediaLibraryImageColumn::make('kursus-thumbnail')
                    ->label('Thumbnail')
                    ->collection('kursus-thumbnail')
                    ->circular(),
                TextColumn::make('judul')
                    ->searchable(),
                TextColumn::make('kategori')
                    ->getStateUsing(fn(Kursus $record) => $record->kategori->getLabel()),
                TextColumn::make('level')
                    ->getStateUsing(fn(Kursus $record) => $record->level->getLabel())
                    ->badge()
                    ->color(fn(Kursus $record) => $record->level->getColor())
                    ->sortable()
                    ->searchable(),
                TextColumn::make('harga')
                    ->money('IDR')
                    ->weight(FontWeight::Bold)
                    ->sortable(),
                TextColumn::make('is_published')
                    ->label('Status Publikasi')
                    ->getStateUsing(fn(Kursus $record) => $record->is_published ? 'Published' : 'Draft')
                    ->badge()
                    ->color(fn(Kursus $record) => $record->is_published ? 'success' : 'danger'),
                TextColumn::make('mentor')
                    ->getStateUsing(fn(Kursus $record) => $record->mentors_count . ' Mentor'),
                TextColumn::make('student')
                    ->getStateUsing(fn(Kursus $record) => $record->students_count . ' Student'),
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
                SelectFilter::make('kategori')
                    ->options(KategoriEnum::class),
                SelectFilter::make('level')
                    ->options(LevelEnum::class),
                SelectFilter::make('tipe')
                    ->options(TipeEnum::class)
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\Action::make('lihatTestimoni')
                    ->label('Lihat Testimoni')
                    ->color('warning')
                    ->icon('heroicon-o-star')
                    ->url(fn(Kursus $record) => Pages\LihatTestimoniPage::getUrl(['record' => $record])),
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
            'index' => Pages\ManageKursuses::route('/'),
            'testimoni' => Pages\LihatTestimoniPage::route('/{record}/testimoni'),
        ];
    }
}
