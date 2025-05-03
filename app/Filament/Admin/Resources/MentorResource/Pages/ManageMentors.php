<?php

namespace App\Filament\Admin\Resources\MentorResource\Pages;

use Exception;
use Filament\Actions;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Admin\Resources\MentorResource;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ManageMentors extends ManageRecords
{
    protected static string $resource = MentorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Assign Mentor')
                ->closeModalByClickingAway(false)
                ->action(function(array $data) {
                    DB::beginTransaction();
                    try
                    {
                        User::whereIn('id', $data['student'])->each(function($student) {
                            $student->assignRole('mentor');
                        });

                        DB::commit();
                        Notification::make()
                            ->title('Sukses')
                            ->body('Berhasil assign mentor')
                            ->success()
                            ->send();
                    }catch(Exception $e)
                    {
                        DB::rollBack();
                        Log::error($e->getMessage());
                        Notification::make()
                            ->title('Gagal')
                            ->body('Gagal menambahkan mentor')
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }

    public function getTitle(): string
    {
        return 'Mentor';
    }
    
}
