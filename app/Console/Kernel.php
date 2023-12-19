<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\IsActiveStatusCommand;
use App\Console\Commands\ContructualEmployment;
use App\Console\Commands\InternEmployment;
use App\Console\Commands\ProbationEmployment;
use App\Console\Commands\TraineeEmployment;
use App\Console\Commands\CheckProbationEndDate;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected $commands = [
        IsActiveStatusCommand::class,
        ContructualEmployment::class,
        InternEmployment::class,
        ProbationEmployment::class,
        TraineeEmployment::class,
        CheckProbationEndDate::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('command:isActiveStatus')->daily();
        $schedule->command('command:contractualEmployment')->daily();
        $schedule->command('command:internEmployment')->daily();
        $schedule->command('command:probationEmployment')->daily();
        $schedule->command('command:traineeEmployment')->daily();
        $schedule->command('command:checkProbition')->daily();

    }

    // protected function schedule(Schedule $schedule)
    //     {
    //         $schedule->command(IsActiveStatusCommand::class)->daily();
    //     }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
