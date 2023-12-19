<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class ContructualEmployment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:contractualEmployment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of contractual employees based on their contractual date';

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
        $employees = User::where('employment_type', 'Contactual')->whereDate('expiry_date', today())->get();

        foreach ($employees as $employee) {
                $employee->is_active = '';
                $employee->save();

        }
    }
}
