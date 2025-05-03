<?php

namespace App\Filament\Admin\Resources\MentorResource\Pages;

use App\Models\User;
use App\Models\Kursus;
use Filament\Tables\Table;
use Filament\Resources\Pages\Page;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use App\Enums\LaosCourse\Kursus\LevelEnum;
use Illuminate\Contracts\Support\Htmlable;
use App\Enums\LaosCourse\Kursus\KategoriEnum;
use App\Enums\LaosCourse\Kursus\TipeEnum;
use App\Filament\Admin\Resources\MentorResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Enums\FiltersLayout;

class LihatKursusPage extends Page implements HasTable
{
    use InteractsWithTable, InteractsWithRecord;
    protected static string $resource = MentorResource::class;

    protected static string $view = 'filament.admin.resources.mentor-resource.pages.lihat-kursus-page';

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

    public function getTitle(): string|Htmlable
    {
        return 'Kursus ' . $this->record->name;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Kursus::query()->withCount(['students'])->whereHas('mentors', function ($query) {
                $query->where('mentor_id', $this->record->id);
            }))
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
                TextColumn::make('student')
                    ->getStateUsing(fn(Kursus $record) => $record->students_count . ' Student')
            ])
            ->filters([
                SelectFilter::make('kategori')
                    ->options(KategoriEnum::class),
                SelectFilter::make('level')
                    ->options(LevelEnum::class),
                SelectFilter::make('tipe')
                    ->options(TipeEnum::class),
            ], layout: FiltersLayout::AboveContent);
    }
}
