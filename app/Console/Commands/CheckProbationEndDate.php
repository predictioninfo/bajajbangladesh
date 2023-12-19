<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ProbationNotification;
use App\Models\User;
use Carbon\Carbon;
use Auth;

class CheckProbationEndDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:checkProbition';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $employees = User::where('employment_type', 'Probation')->whereBetween('in_probation_month', [Carbon::now(), Carbon::now()->addDays(30)])->get();

        foreach ($employees as $employee) {

            $employeesupervisors = User::where('id', '=', $employee->report_to_parent_id)->get();
        }
        foreach ($employeesupervisors as $employeesupervisor) {

            Notification::route('mail', $employeesupervisor->email ?? '')->notify(new ProbationNotification($employee->first_name, $employee->last_name, $employee->in_trine_month));
        }
        // dd($employees);
        // \Log::info($employeesupervisor);
    }
}
