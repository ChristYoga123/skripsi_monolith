<?php

namespace App\Livewire\Admin\LaosCourse\Diskon;

use Carbon\Carbon;
use App\Models\Diskon;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\DeleteAction;
use App\Enums\LaosCourse\Diskon\JenisEnum;
use Filament\Actions\Contracts\HasActions;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Actions\Concerns\InteractsWithActions;

class BasicDiskonComponent extends Component implements HasTable, HasForms, HasActions
{
    use InteractsWithTable, InteractsWithForms, InteractsWithActions;

    public function render()
    {
        return view('livewire.admin.laos-course.diskon.basic-diskon-component');
    }

    public function createBasicDiskonAction(): CreateAction
    {
        return CreateAction::make('createBasicDiskon')
            ->label('Buat Diskon')
            ->modalHeading('Buat Diskon')
            ->form([
                TextInput::make('kode')
                    ->unique(ignoreRecord: true)
                    ->required(),
                TextInput::make('persentase')
                    ->numeric()
                    ->required()
                    ->suffix('%')
                    ->minValue(1)
                    ->maxValue(99),
                Select::make('jenis')
                    ->label('Jenis Diskon')
                    ->options(JenisEnum::class)
                    ->default(JenisEnum::DIBATASI_TANGGAL->value)
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        if ($get('jenis') === JenisEnum::DIBATASI_TANGGAL->value) {
                            $set('kuota', null);
                        } else {
                            $set('tanggal_mulai', null);
                            $set('tanggal_selesai', null);
                        }
                    }),
                Grid::make()
                    ->schema([
                        DatePicker::make('tanggal_mulai')
                            ->label('Tanggal Mulai')
                            ->required()
                            ->visible(fn (Get $get) => $get('jenis') === JenisEnum::DIBATASI_TANGGAL->value),
                        DatePicker::make('tanggal_selesai')
                            ->label('Tanggal Selesai')
                            ->required()
                            ->visible(fn (Get $get) => $get('jenis') === JenisEnum::DIBATASI_TANGGAL->value),
                    ])
                    ->visible(fn (Get $get) => $get('jenis') === JenisEnum::DIBATASI_TANGGAL->value),
                TextInput::make('kuota')
                    ->label('Kuota')
                    ->numeric()
                    ->required(fn(Get $get) => $get('jenis') === JenisEnum::DIBATASI_KUOTA->value)
                    ->minValue(1)
                    ->suffix('Kuota')
                    ->visible(fn (Get $get) => $get('jenis') === JenisEnum::DIBATASI_KUOTA->value),
            ])
            ->action(function(array $data)
            {
                Diskon::create([
                    'kode' => $data['kode'],
                    'jenis' => $data['jenis'],
                    'kuota' => $data['jenis'] === JenisEnum::DIBATASI_KUOTA->value ? $data['kuota'] : null,
                    'tanggal_mulai' => $data['jenis'] === JenisEnum::DIBATASI_TANGGAL->value ? $data['tanggal_mulai'] : null,
                    'tanggal_selesai' => $data['jenis'] === JenisEnum::DIBATASI_TANGGAL->value ? $data['tanggal_selesai'] : null,
                    'persentase' => $data['persentase'],
                ]);

                Notification::make()
                    ->title('Diskon Berhasil Dibuat')
                    ->body('Diskon berhasil dibuat.')
                    ->success()
                    ->send();
            });
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Diskon::query()->with('transaksi')->whereKursusId(null))
            ->columns([
                TextColumn::make('kode')
                    ->getStateUsing(fn(Diskon $record) => strtoupper($record->kode))
                    ->searchable(),
                TextColumn::make('persentase')
                    ->numeric()
                    ->suffix('%')
                    ->badge()
                    ->sortable(),
                TextColumn::make('jenis')
                    ->label('Jenis Diskon')
                    ->getStateUsing(fn(Diskon $record) => $record->jenis->getLabel()),
                TextColumn::make('tanggal')
                    ->label('Tanggal Aktif')
                    ->getStateUsing(fn(Diskon $record) => $record->jenis->value == JenisEnum::DIBATASI_TANGGAL->value ? Carbon::parse($record->tanggal_mulai)->translatedFormat('d F Y') . ' - ' . Carbon::parse($record->tanggal_selesai)->translatedFormat('d F Y') : '-'),
                TextColumn::make('kuota')
                    ->label('Kuota')
                    ->getStateUsing(fn(Diskon $record) => $record->jenis->value == JenisEnum::DIBATASI_KUOTA->value ? $record->transaksi->count() . '/' . $record->kuota . ' Penggunaan' : '-'),
                TextColumn::make('status')
                    ->getStateUsing(fn(Diskon $record) => $record->isActive ? 'Aktif' : 'Tidak Aktif')
                    ->badge()
                    ->color(fn(Diskon $record) => $record->isActive ? 'success' : 'danger')     
            ])
            ->actions([
                EditAction::make()
                    ->form([
                        TextInput::make('kode')
                            ->unique(ignoreRecord: true)
                            ->required(),
                        TextInput::make('persentase')
                            ->numeric()
                            ->required()
                            ->suffix('%')
                            ->minValue(1)
                            ->maxValue(99),
                        Select::make('jenis')
                            ->label('Jenis Diskon')
                            ->options([
                                JenisEnum::DIBATASI_TANGGAL->value => JenisEnum::DIBATASI_TANGGAL->getLabel(),
                                JenisEnum::DIBATASI_KUOTA->value => JenisEnum::DIBATASI_KUOTA->getLabel(),
                            ])
                            ->default(JenisEnum::DIBATASI_TANGGAL->value)
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                if ($get('jenis') === JenisEnum::DIBATASI_TANGGAL->value) {
                                    $set('kuota', null);
                                } else {
                                    $set('tanggal_mulai', null);
                                    $set('tanggal_selesai', null);
                                }
                            }),
                        Grid::make()
                            ->schema([
                                DatePicker::make('tanggal_mulai')
                                    ->label('Tanggal Mulai')
                                    ->required()
                                    ->visible(fn (Get $get) => $get('jenis') === JenisEnum::DIBATASI_TANGGAL->value),
                                DatePicker::make('tanggal_selesai')
                                    ->label('Tanggal Selesai')
                                    ->required()
                                    ->visible(fn (Get $get) => $get('jenis') === JenisEnum::DIBATASI_TANGGAL->value),
                            ])
                            ->visible(fn (Get $get) => $get('jenis') === JenisEnum::DIBATASI_TANGGAL->value),
                        TextInput::make('kuota')
                            ->label('Kuota')
                            ->numeric()
                            ->required(fn(Get $get) => $get('jenis') === JenisEnum::DIBATASI_KUOTA->value)
                            ->minValue(1)
                            ->suffix('Kuota')
                            ->visible(fn (Get $get) => $get('jenis') === JenisEnum::DIBATASI_KUOTA->value),
                        ])
                    ->action(function (Diskon $record, array $data) {
                        $record->update([
                            'kode' => $data['kode'],
                            'jenis' => $data['jenis'],
                            'kuota' => $data['jenis'] === JenisEnum::DIBATASI_KUOTA->value ? $data['kuota'] : null,
                            'tanggal_mulai' => $data['jenis'] === JenisEnum::DIBATASI_TANGGAL->value ? $data['tanggal_mulai'] : null,
                            'tanggal_selesai' => $data['jenis'] === JenisEnum::DIBATASI_TANGGAL->value ? $data['tanggal_selesai'] : null,
                            'persentase' => $data['persentase'],
                        ]);

                        Notification::make()
                            ->title('Diskon Berhasil Diperbarui')
                            ->body('Diskon berhasil diperbarui.')
                            ->success()
                            ->send();
                    }),
                DeleteAction::make()
            ])
        ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
