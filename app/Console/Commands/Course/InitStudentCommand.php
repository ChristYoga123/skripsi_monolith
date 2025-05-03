<?php

namespace App\Console\Commands\Course;

use App\Models\User;
use Illuminate\Console\Command;

class InitStudentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init-student';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::firstOrCreate([
            'name' => 'Student',
            'email' => 'student@ukmlaos.test',
        ], [
            'password' => bcrypt('password'),
        ])->assignRole(['student', 'mentor']);
        $this->info('Student created successfully');
    }
}
