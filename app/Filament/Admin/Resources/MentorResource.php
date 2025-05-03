<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\MentorResource\Pages;
use App\Filament\Admin\Resources\MentorResource\RelationManagers;

class MentorResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Mentor';

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->columns(1)
                    ->schema([
                        Forms\Components\Select::make('student')
                            ->options(User::query()->role('student')->pluck('name', 'id'))
                            ->label('Pilih student yang akan menjadi mentor (Bisa lebih dari satu)')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->multiple()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(User::query()->with('kursusMentor')->role('mentor'))
            ->columns([
                Tables\Columns\ImageColumn::make('avatar_url')
                    ->label('Avatar')
                    ->circular()
                    ->getStateUsing(fn(User $student) => !$student->avatar_url ? 'https://ui-avatars.com/api/?name=' . $student->name : $student->avatar_url),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Mentor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('job')
                    ->label('Pekerjaan')
                    ->getStateUsing(fn(User $student) => $student->custom_fields['job'] ?? 'N/A'),
                Tables\Columns\TextColumn::make('kursusMentor')
                    ->label('Jumlah Kursus')
                    ->getStateUsing(fn(User $mentor) => $mentor->kursusMentor->count() . ' Kursus')
                    ->badge(),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('lihatCourse')
                    ->label('Lihat Kursus')
                    ->color('info')
                    ->icon('heroicon-o-academic-cap')
                    ->url(fn(User $mentor) => Pages\LihatKursusPage::getUrl(['record' => $mentor])),
                Tables\Actions\DeleteAction::make()
                    ->action(function (User $record) {
                        $record->removeRole('mentor');
                        Notification::make()
                            ->title('Sukses')
                            ->body('Berhasil menghapus mentor')
                            ->success()
                            ->send();
                    }),
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
            'index' => Pages\ManageMentors::route('/'),
            'kursus' => Pages\LihatKursusPage::route('/{record}/kursus'),
            // 'testimoni' => Pages\LihatTestimoniPage::route('/{record}/testimoni'),
        ];
    }
}
