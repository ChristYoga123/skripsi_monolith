<?php

namespace App\Filament\Mentor\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Kursus;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use App\Enums\LaosCourse\Kursus\TipeEnum;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Enums\LaosCourse\Kursus\LevelEnum;
use App\Enums\LaosCourse\Kursus\KategoriEnum;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Mentor\Resources\KursusResource\Pages;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use App\Filament\Mentor\Resources\KursusResource\RelationManagers;

class KursusResource extends Resource
{
    protected static ?string $model = Kursus::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Detail Course')
                    ->columns(1)
                    ->schema([
                        Forms\Components\TextInput::make('judul')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\Select::make('kategori')
                            ->required()
                            ->options(KategoriEnum::class),
                        Forms\Components\Select::make('mentors')
                            ->label('Mentor (Opsional. Pilih mentor yang akan diajak berkolaborasi. Jika tidak ada, maka Anda akan menjadi mentor utama)')
                            ->relationship('mentors', 'name', function (Builder $query) {
                                $query->role('mentor')->whereNot('id', auth()->id());
                            })
                            ->default(auth()->id())
                            ->multiple()
                            ->preload()
                            ->searchable(),
                        Forms\Components\Select::make('techStacks')
                            ->label('Tech Stack')
                            ->required()
                            ->relationship('techStacks', 'nama')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('nama')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                Forms\Components\SpatieMediaLibraryFileUpload::make('tech-stack-thumbnail')
                                    ->collection('tech-stack-thumbnail')
                                    ->required()
                                    ->optimize('webp')
                                    ->image()
                                    ->maxFiles(1)
                                    ->maxSize(1024),
                            ]),
                        Forms\Components\Select::make('level')
                            ->required()
                            ->options(LevelEnum::class),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('kursus-thumbnail')
                            ->collection('kursus-thumbnail')
                            ->required()
                            ->optimize('webp')
                            ->image()
                            ->maxFiles(1)
                            ->maxSize(1024),
                        Forms\Components\RichEditor::make('deskripsi')
                            ->required(),
                        Forms\Components\TextInput::make('resource_url')
                            ->label('Resource URL')
                            ->required()
                            ->url(),
                        Forms\Components\Toggle::make('is_published')
                            ->label('Siap Publish')
                            ->default(false),
                    ]),

                Forms\Components\Fieldset::make('Key Points')
                    ->columns(1)
                    ->schema([
                        Forms\Components\Repeater::make('keypoints')
                            ->schema([
                                Forms\Components\TextInput::make('point')
                                    ->required(),
                            ])
                            ->required(),
                    ]),
                Forms\Components\Fieldset::make('Pricing')
                    ->columns(1)
                    ->schema([
                        Forms\Components\Select::make('tipe')
                            ->required()
                            ->options(TipeEnum::class)
                            ->default('free')
                            ->afterStateUpdated(fn(Set $set, string $state) => $state === TipeEnum::FREE->value ? $set('harga', 0) : null)
                            ->live(),
                        Forms\Components\TextInput::make('harga')
                            ->required()
                            ->default(0)
                            ->minValue(1)
                            ->prefix('Rp')
                            ->suffix('.00')
                            ->visible(fn(Get $get) => $get('tipe') === 'premium')
                            ->required(fn(Get $get) => $get('tipe') === 'premium'),
                    ]),
                Forms\Components\Fieldset::make('Galeri')
                    ->columns(1)
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('galeri')
                            ->label('Galeri (Opsional dan bisa lebih dari 1 gambar)')
                            ->collection('kursus-galeri')
                            ->multiple()
                            ->image()
                            ->optimize('webp'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Kursus::query()->withCount(['mentors', 'students'])->whereHas('mentors', function ($query) {
                $query->where('mentor_id', auth()->id());
            }))
            ->columns([
                TextColumn::make('judul')
                    ->searchable(),
                TextColumn::make('kategori')
                    ->getStateUsing(fn(Kursus $course) => $course->kategori->getLabel())
                    ->badge(),
                SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->collection('kursus-thumbnail')
                    ->circular(),
                TextColumn::make('courseMentors')
                    ->label('Mentor')
                    ->getStateUsing(fn(Kursus $course) => $course->mentors_count . ' Mentor'),
                TextColumn::make('courseStudents')
                    ->label('Student')
                    ->getStateUsing(fn(Kursus $course) => $course->students_count . ' Student'),
                TextColumn::make('harga')
                    ->weight(FontWeight::Bold)
                    ->money('IDR'),
                ToggleColumn::make('is_published')
                    ->label('Terpublish'),
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
                Tables\Actions\Action::make('aturMateri')
                    ->label('Atur Materi')
                    ->color('info')
                    ->icon('heroicon-o-book-open')
                    ->url(fn(Kursus $record) => Pages\AturMateriPage::getUrl(['record' => $record])),
                Tables\Actions\Action::make('lihatTestimoni')
                    ->label('Lihat Testimoni')
                    ->color('warning')
                    ->icon('heroicon-o-star')
                    ->url(fn(Kursus $record) => Pages\LihatTestimoniPage::getUrl(['record' => $record])),
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(function(array $data)
                    {
                        if($data['tipe'] === TipeEnum::FREE->value)
                        {
                            $data['harga'] = 0;
                        }
                        return $data;
                    }),
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
            'materi' => Pages\AturMateriPage::route('/{record}/materi'),
        ];
    }
}
