<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Separation;
use App\Models\Resignation;
use App\Models\Termination;
use Illuminate\Console\Command;

class IsActiveStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:isActiveStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Users Is Active Status';

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


    $users = User::where('is_active', 1)->whereDate('inactive_date', today())->get();
    // $users =  User::whereDate('inactive_date', today())->get();


    foreach ($users as $user) {
        $user->email = null;
        $user->phone = null;
        $user->username = null;
        $user->is_active = '';
        $user->save();

        $resignations = Resignation::where('resignation_employee_id', $user->id)->where('status',1)->get();
        $terminations = Termination::where('termination_employee_id', $user->id)->get();

        foreach($resignations as $resignation){
            $separation = new Separation();
            $separation->separation_com_id = $resignation->resignation_com_id;
            $separation->employee_id = $resignation->resignation_employee_id;
            $separation->resignation_id = $resignation->id;
            $separation->date = $user->inactive_date;
            $separation->replace_employee_id = $user->replace_employee_id;
            $separation->save();
        }
        foreach ($terminations as  $termination) {
            $separation = new Separation();
            $separation->separation_com_id = $termination->termination_com_id ;
            $separation->employee_id = $termination->termination_employee_id ;
            $separation->resignation_id = $termination->id;
            $separation->date = $user->inactive_date;
            $separation->replace_employee_id = $user->replace_employee_id;
            $separation->save();
        }


    }
    // \Log::info($separation);
    }

}

