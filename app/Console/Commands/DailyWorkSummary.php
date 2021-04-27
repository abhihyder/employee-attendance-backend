<?php

namespace App\Console\Commands;

use App\Mail\WorkSummaryMail;
use App\Models\AttendanceLog;
use App\Models\Employee;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class DailyWorkSummary extends Command
{

    protected $employee_id;
    protected $attendance_at;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'summary:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will send daily work summary';

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

        $attendanceLog = AttendanceLog::where('attendance_date', date('Y-m-d'))->get();

        foreach ($attendanceLog as $a) {
            if ($a->attendance_type == 1) {
                $this->employee_id = $a->employee_id;
                $this->attendance_at = $a->attendance_date . ' ' . $a->attendance_time;

                foreach ($attendanceLog as $a2) {
                    if ($a2->employee_id == $this->employee_id && $a2->attendance_type == 2) {
                        $employee = Employee::find($this->employee_id);
                        $checkInTime = Carbon::parse($this->attendance_at);
                        $checkOutTime = Carbon::parse($a2->attendance_date . ' ' . $a2->attendance_time);
                        $workSummary = gmdate('H:i:s', $checkOutTime->diffInSeconds($checkInTime));

                        Mail::to($employee->user->email)->send(new WorkSummaryMail($workSummary));
                    }
                }
            }
        }
    }
}
