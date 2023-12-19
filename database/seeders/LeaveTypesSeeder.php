<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('leave_types')->insert([
            'leave_type' => 'Sick leave',
            'allocated_day' => 14,
            'leave_type_company_id' => 1,

        ]);
        DB::table('leave_types')->insert([
            'leave_type' => 'Casual Leave',
            'allocated_day' => 10,
            'leave_type_company_id' => 1,

        ]);
        DB::table('leave_types')->insert([
            'leave_type' => 'Annual leave',
            'allocated_day' => 11,
            'leave_type_company_id' => 1,

        ]);
    }
}
