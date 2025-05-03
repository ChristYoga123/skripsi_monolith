<?php

namespace App\Filament\Mentor\Resources\KursusResource\Pages;

use Exception;
use Filament\Actions;
use App\Models\Kursus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use App\Enums\LaosCourse\Kursus\TipeEnum;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Mentor\Resources\KursusResource;

class ManageKursuses extends ManageRecords
{
    protected static string $resource = KursusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Buat Kursus')
                ->closeModalByClickingAway(false)
                ->using(function (array $data) {
                    DB::beginTransaction();
                    try
                    {
                        // Create the course first
                        $course = Kursus::create([
                            'judul' => $data['judul'],
                            'kategori' => $data['kategori'],
                            'level' => $data['level'],
                            'deskripsi' => $data['deskripsi'],
                            'tipe' => $data['tipe'],
                            'harga' => $data['tipe'] === TipeEnum::FREE->value ? 0 : $data['harga'],
                            'is_published' => $data['is_published'],
                            'keypoints' => $data['keypoints'],
                            'resource_url' => $data['resource_url'],
                        ]);

                        // Handle media upload if there's a thumbnail
                        if (isset($data['kursus-thumbnail'])) {
                            $course->addMedia($data['kursus-thumbnail'])->toMediaCollection('kursus-thumbnail');
                        }

                        // Handle tech stacks relationship
                        if (!empty($data['techStacks'])) {
                            $course->techStacks()->attach($data['techStacks']);
                        }

                        // Get the current authenticated user as the main mentor
                        $mainMentor = Auth::user();

                        // Start with the main mentor
                        $mentorIds = [$mainMentor->id];

                        // If additional mentors were selected, add them to the array
                        if (!empty($data['mentors'])) {
                            $mentorIds = array_merge($mentorIds, $data['mentors']);
                        }

                        // Attach all mentors (main mentor + selected mentors if any)
                        $course->mentors()->attach($mentorIds);

                        DB::commit();
                        return $course;
                    }catch(Exception $e)
                    {
                        DB::rollBack();
                        Notification::make()
                            ->title('Error')
                            ->body('Gagal membuat course: ' . $e->getMessage())
                            ->danger()
                            ->send();
                        return;
                    }
                }),
        ];
    }
}
