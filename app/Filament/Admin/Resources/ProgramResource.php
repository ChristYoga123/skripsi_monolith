<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Program;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Dotswan\MapPicker\Fields\Map;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\ProgramResource\Pages;
use App\Filament\Admin\Resources\ProgramResource\RelationManagers;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Program';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Detail Program')
                    ->columns(1)
                    ->schema([
                        Forms\Components\Select::make('divisi_id')
                            ->required()
                            ->label('Divisi')
                            ->relationship('divisi', 'nama')
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('judul_program')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('judul_kegiatan')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('thumbnail')
                            ->required()
                            ->maxFiles(1)
                            ->optimize('webp')
                            ->image()
                            ->label('Thumbnail (Max 1 file, Max 1MB)')
                            ->collection('program-thumbnail'),
                        Forms\Components\RichEditor::make('konten')
                            ->required()
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Fieldset::make('Waktu Pendaftaran & Tempat')
                    ->columns(1)
                    ->schema([
                        Forms\Components\Grid::make()
                            ->columns(2)
                            ->schema([
                                Forms\Components\DatePicker::make('open_regis_panitia')
                                    ->required()
                                    ->label('Tanggal Pembukaan Pendaftaran Panitia'),
                                Forms\Components\DatePicker::make('close_regis_panitia')
                                    ->required()
                                    ->label('Tanggal Penutupan Pendaftaran Panitia'),
                            ]),
                        Forms\Components\TextInput::make('gform_panitia')
                            ->required()
                            ->url()
                            ->columnSpanFull(),
                        Forms\Components\Grid::make()
                            ->columns(2)
                            ->schema([
                                Forms\Components\DatePicker::make('open_regis_peserta')
                                    ->required()
                                    ->label('Tanggal Pembukaan Pendaftaran Peserta'),
                                Forms\Components\DatePicker::make('close_regis_peserta')
                                    ->required()
                                    ->label('Tanggal Penutupan Pendaftaran Peserta'),
                            ]),
                        Forms\Components\TextInput::make('gform_peserta')
                            ->required()
                            ->url()
                            ->columnSpanFull(),
                        Map::make('location')
                            ->label('Lokasi Kegiatan')
                            ->defaultLocation(latitude: -8.165516031480806, longitude: 113.71727423131937)
                            ->afterStateUpdated(function (Set $set, ?array $state): void {
                                $set('lat', $state['lat']);
                                $set('long', $state['lng']);
                            })
                            ->afterStateHydrated(function ($state, $record, Set $set): void {
                                $set('location', [
                                        'lat'     => $record->lat ?? -8.165516031480806,
                                        'lng'     => $record->long ?? 113.71727423131937,
                                    ]
                                );
                            })
                            ->liveLocation(true, true, 5000)
                            ->showMarker()
                            ->markerColor("#22c55eff")
                            ->showFullscreenControl()
                            ->showZoomControl()
                            ->draggable()
                            ->tilesUrl("https://tile.openstreetmap.de/{z}/{x}/{y}.png")
                            ->zoom(15)
                            ->detectRetina()
                            ->showMyLocationButton()
                            ->extraTileControl([])
                            ->extraControl([
                                'zoomDelta'           => 1,
                                'zoomSnap'            => 2,
                            ]),
                        Forms\Components\TextInput::make('lat')
                            ->required()
                            ->live()
                            ->columns(2)
                            ->readOnly(),
                        Forms\Components\TextInput::make('long')
                            ->required()
                            ->live()
                            ->columns(2)
                            ->readOnly(),
                    ]),
                Forms\Components\Fieldset::make('Jadwal Kegiatan')
                    ->columns(1)
                    ->schema([
                        Forms\Components\Repeater::make('jadwal_kegiatan')
                            ->required()
                            ->schema([
                                Forms\Components\TextInput::make('jadwal')
                                    ->required(),
                                Forms\Components\DatePicker::make('waktu')
                                    ->required(),
                            ])
                    ]),
                Forms\Components\Fieldset::make('Dokumentasi')
                    ->columns(1)
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('dokumentasi')
                            ->multiple()
                            ->image()
                            ->optimize('webp')
                            ->label('Dokumentasi (Optional)')
                            ->collection('program-dokumentasi'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('divisi.nama')
                    ->label('Divisi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('judul_program')
                    ->searchable(),
                Tables\Columns\TextColumn::make('judul_kegiatan')
                    ->searchable(),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('program-thumbnail')
                    ->collection('program-thumbnail')
                    ->label('Thumbnail'),
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
                //
            ])
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
            'index' => Pages\ManagePrograms::route('/'),
        ];
    }
}
