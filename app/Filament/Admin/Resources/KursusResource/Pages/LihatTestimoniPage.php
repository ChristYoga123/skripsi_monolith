<?php

namespace App\Filament\Admin\Resources\KursusResource\Pages;

use App\Models\User;
use App\Models\Kursus;
use Filament\Tables\Table;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Admin\Resources\KursusResource;
use App\Models\KursusMurid;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\Layout\Stack;
use IbrahimBougaoua\FilamentRatingStar\Columns\Components\RatingStar;

class LihatTestimoniPage extends Page implements HasTable
{
    use InteractsWithTable, InteractsWithRecord;

    protected static string $resource = KursusResource::class;

    protected static string $view = 'filament.admin.resources.kursus-resource.pages.lihat-testimoni-page';

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

    public function getTitle(): string|Htmlable
    {
        return 'Testimoni Kursus ' . $this->record->judul;
    }

    public function table(Table $table): Table
    {
        return $table->query(KursusMurid::query()
                ->whereHas('kursus', function ($query) {
                    $query->where('id', $this->record->id);
                })
                ->with(['student'])
            )
            ->columns([
                Split::make([
                    ImageColumn::make('avatar_url')
                        ->label('Avatar')
                        ->circular()
                        ->getStateUsing(fn(KursusMurid $record) => !$record->student->avatar_url ? 'https://ui-avatars.com/api/?name=' . $record->student->name : $record->student->avatar_url)
                        ->grow(false),
                    TextColumn::make('student.name')
                        ->label('Nama Student')
                        ->searchable(),
                    Stack::make([
                        RatingStar::make('rating')
                            ->size('md')
                            ->sortable(),
                        TextColumn::make('komentar'),
                    ])
                ])
            ])
            ->actions([
                DeleteAction::make(),
            ]);
    }
}
