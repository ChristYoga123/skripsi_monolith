<?php

namespace Database\Seeders;

use App\Models\Kursus;
use App\Models\User;
use App\Enums\LaosCourse\Kursus\KategoriEnum;
use App\Enums\LaosCourse\Kursus\LevelEnum;
use App\Enums\LaosCourse\Kursus\TipeEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class KursusSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        // Buat 10 user mentor
        $mentors = User::factory(10)->create();
        foreach ($mentors as $mentor) {
            $mentor->assignRole('mentor');
        }

        // Buat 100 kursus
        for ($i = 1; $i <= 100; $i++) {
            DB::beginTransaction();
            try {
                $kategori = $faker->randomElement(KategoriEnum::cases());
                $level = $faker->randomElement(LevelEnum::cases());
                $tipe = $faker->randomElement(TipeEnum::cases());
                
                $judul = "Kursus-" . $i;
                $kursus = Kursus::create([
                    'judul' => $judul,
                    'slug' => Str::slug($judul),
                    'kategori' => $kategori,
                    'deskripsi' => $faker->paragraph(3),
                    'keypoints' => [
                        $faker->sentence(),
                        $faker->sentence(),
                        $faker->sentence(),
                    ],
                    'level' => $level,
                    'tipe' => 'free',
                    'harga' => 0,
                    'is_published' => $faker->boolean(80),
                    'resource_url' => $faker->url(),
                ]);

                // Tambahkan thumbnail
                $kursus->addMediaFromUrl('https://picsum.photos/800/600')
                    ->toMediaCollection('kursus-thumbnail');

                // Tambahkan mentor (1-3 mentor per kursus)
                $randomMentors = $mentors->random($faker->numberBetween(1, 3));
                $kursus->mentors()->attach($randomMentors->pluck('id'));

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        }
    }
} 