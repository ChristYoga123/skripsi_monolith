<?php

namespace App\Filament\Mentor\Resources\KursusResource\Pages;

use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\KursusBab;
use Filament\Tables\Table;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use App\Filament\Mentor\Resources\KursusResource;
use App\Enums\LaosCourse\KursusBabMateri\TipeEnum;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class AturMateriPage extends Page implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms, InteractsWithRecord;

    protected static string $resource = KursusResource::class;

    protected static string $view = 'filament.mentor.resources.kursus-resource.pages.atur-materi-page';

    public function getTitle(): string|Htmlable
    {
        return 'Atur Materi Kursus ' . $this->record->judul;
    }

    public ?array $data = [];

    public function mount(int | string $record)
    {
        $this->record = $this->resolveRecord($record);
        $this->form->fill([]);
    }

    public function createMateriAction(): CreateAction
    {
        return CreateAction::make('createMateri')
            ->closeModalByClickingAway(false)
            ->label('Buat Materi')
            ->model(KursusBab::class)
            ->form([
                Hidden::make('kursus_id')
                    ->default($this->record->id),
                TextInput::make('judul')
                    ->label('Judul Bab')
                    ->required(),
                Repeater::make('materi')
                    ->relationship('materi')
                    ->schema([
                        TextInput::make('judul')
                            ->required(),
                        Select::make('tipe')
                            ->label('Tipe Konten')
                            ->options([
                                TipeEnum::VIDEO->value => TipeEnum::VIDEO->label(),
                                TipeEnum::TEXT->value => TipeEnum::TEXT->label(),
                            ])
                            ->live()
                            ->afterStateUpdated(function(Set $set, string $state)
                            {
                                if($state === TipeEnum::VIDEO->value)
                                {
                                    $set('text', null);
                                } else
                                {
                                    $set('youtube_url', null);
                                }
                            })
                            ->required(),
                        TextInput::make('youtube_url')
                            ->required(fn(Get $get) => $get('tipe') === 'video')
                            ->visible(fn(Get $get) => $get('tipe') === 'video')
                            ->url(),
                        RichEditor::make('text')
                            ->required(fn(Get $get) => $get('tipe') === 'text')
                            ->visible(fn(Get $get) => $get('tipe') === 'text')
                            ->columnSpanFull(),
                        Toggle::make('is_terkunci')
                            ->label('Apakah Materi Terkunci?')
                            ->default(false)
                    ])
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(KursusBab::query()->withCount(['materi'])->whereKursusId($this->record->id))
            ->columns([
                TextColumn::make('judul'),
                TextColumn::make('materi')
                    ->label('Jumlah Materi')
                    ->getStateUsing(fn(KursusBab $courseChapter) => $courseChapter->materi_count . ' Materi'),
            ])
            ->actions([
                EditAction::make()
                    ->closeModalByClickingAway(false)
                    ->form([
                        TextInput::make('judul')
                            ->required(),
                        Repeater::make('materi')
                            ->relationship('materi')
                            ->schema([
                                TextInput::make('judul')
                                    ->required(),
                                Select::make('tipe')
                                    ->label('Tipe Konten')
                                    ->options([
                                        'video' => 'Video',
                                        'text' => 'Text',
                                    ])
                                    ->live()
                                    ->required(),
                                TextInput::make('youtube_url')
                                    ->required(fn(Get $get) => $get('tipe') === 'video')
                                    ->url()
                                    ->visible(fn(Get $get) => $get('tipe') === 'video'),
                                RichEditor::make('text')
                                    ->required(fn(Get $get) => $get('tipe') === 'text')
                                    ->visible(fn(Get $get) => $get('tipe') === 'text')
                                    ->columnSpanFull(),
                                Toggle::make('is_terkunci')
                                    ->label('Apakah Materi Terkunci?'),
                            ])
                ]),
                DeleteAction::make(),
            ]);
    }
}
