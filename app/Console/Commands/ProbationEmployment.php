<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Role;
use App\Models\Notification;
use Illuminate\Console\Command;
use Auth;
use Carbon\Carbon;

class ProbationEmployment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:probationEmployment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of Probation employees based on their Probation date';

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
        $employees = User::where('employment_type', 'Probation')->whereBetween('probation_expiry_date', [Carbon::now(), Carbon::now()->addDays(30)])->get();

        $admins = User::where('user_admin_status', 'Yes')->first('id');


        ############### random key generate code starts###########

        function generateRandomString($length = 25)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $random_key = generateRandomString();

        ############### random key generate code staendsrts###########


        foreach ($employees as $employee) {

            if ($employee->report_to_parent_id) {
                $report_to_parent_id = $employee->report_to_parent_id;
            } else {
                $report_to_parent_id = null;
            }
            $notification = new Notification();
            $notification->notification_token = $random_key;
            $notification->notification_com_id = $employee->com_id;
            $notification->notification_type = "Probation";
            $notification->notification_title = "Employee Probation Approve";
            $notification->notification_from = $employee->id;
            // $notification->notification_to = $report_to_parent_id;
            $notification->report_admin_id = $admins->id;
            $notification->notification_status = "Unseen";
            $notification->save();
        }

        // \Log::info($notification);
    }
}
