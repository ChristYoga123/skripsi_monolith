<?php

namespace App\Livewire\Admin\LaosCourse\Diskon;

use App\Enums\LaosCourse\Kursus\TipeEnum;
use App\Models\Diskon;
use App\Models\Kursus;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Components\Grid;
use Filament\Notifications\Notification;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class FlashSaleDiskonComponent extends Component implements HasTable, HasForms, HasActions
{
    use InteractsWithTable, InteractsWithForms, InteractsWithActions;

    public function render()
    {
        return view('livewire.admin.laos-course.diskon.flash-sale-diskon-component');
    }

    public function createFlashSaleAction(): CreateAction
    {
        return CreateAction::make('createFlashSale')
            ->label('Buat Flash Sale')
            ->modalHeading('Buat Flash Sale')
            ->form([
                Select::make('kursus_id')
                    ->label('Kursus (Bisa lebih dari 1)')
                    ->options($this->getKursusOptions())
                    ->multiple()
                    ->required()
                    ->preload()
                    ->searchable()
                    ->allowHtml(),
                TextInput::make('persentase')
                    ->numeric()
                    ->required()
                    ->suffix('%')
                    ->minValue(1)
                    ->maxValue(99)
            ])
            ->action(function(array $data)
            {
                foreach($data['kursus_id'] as $kursus)
                {
                    Diskon::create([
                        'kursus_id' => $kursus,
                        'persentase' => $data['persentase'],
                    ]);
                }

                Notification::make()
                    ->title('Flash Sale Berhasil Dibuat')
                    ->body('Flash Sale untuk kursus berhasil dibuat.')
                    ->success()
                    ->send();
            });
    }

    private function getKursusOptions(): array
    {
        $kursus = Kursus::with('media')->whereIsPublished(true)->whereTipe(TipeEnum::PREMIUM)->doesntHave('flashSale')->get();
        
        $options = [];

        foreach ($kursus as $item) {
            $options[$item->id] = '<div class="flex items-center gap-2">
                <img src="' . $item->getFirstMediaUrl('kursus-thumbnail') . '" alt="' . $item->judul . '" class="w-5 h-5 rounded-full">
                <span>' . $item->judul . '</span>
            </div>';
        }

        return $options;
    }

    public function table(Table $table): Table
    {
        return $table->query(Diskon::query()->with('kursus.media')->whereNot('kursus_id', null))
            ->columns([
                ImageColumn::make('kursus-thumbnail')
                    ->label('Thumbnail')
                    ->getStateUsing(fn(Diskon $record) => $record->kursus->getFirstMediaUrl('kursus-thumbnail'))
                    ->circular(),
                TextColumn::make('kursus.judul')
                    ->searchable(),
                TextColumn::make('kursus.kategori')
                    ->getStateUsing(fn(Diskon $record) => $record->kursus->kategori->getLabel()),
                TextColumn::make('kursus.level')
                    ->getStateUsing(fn(Diskon $record) => $record->kursus->level->getLabel())
                    ->badge()
                    ->color(fn(Diskon $record) => $record->kursus->level->getColor())
                    ->sortable()
                    ->searchable(),
                TextColumn::make('persentase')
                    ->badge()
                    ->sortable()
                    ->suffix('%')
                    ->searchable(),
                TextColumn::make('kursus.harga')
                    ->weight(FontWeight::Bold)
                    ->label('Harga Terbaru')
                    ->getStateUsing(function(Diskon $diskon) {
                        $hargaAsli = $diskon->kursus->harga;
                        $hargaDiskon = $hargaAsli - ($hargaAsli * $diskon->persentase / 100);
                        
                        return '<span style="text-decoration: line-through; color: red;">Rp' . number_format($hargaAsli, 0, ',', '.') . '</span> Rp' . number_format($hargaDiskon, 0, ',', '.');
                    })
                    ->html()
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()
                    ->form([
                        TextInput::make('persentase')
                            ->label('Persentase')
                            ->numeric()
                            ->required()
                            ->suffix('%')
                            ->minValue(1)
                            ->maxValue(99)
                    ])
                    ->action(function (Diskon $record, array $data) {
                        $record->update([
                            'persentase' => $data['persentase'],
                        ]);
                        Notification::make()
                            ->title('Flash Sale Berhasil Diperbarui')
                            ->body('Flash Sale untuk kursus berhasil diperbarui.')
                            ->success()
                            ->send();
                    }),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
