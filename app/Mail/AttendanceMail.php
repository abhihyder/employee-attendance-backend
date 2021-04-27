<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AttendanceMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->details->attendance_type == 1) {
            $message = $this->details->employee->user->name . ' checked-in at ' . $this->details->attendance_time;
        } else {
            $message = $this->details->employee->user->name . ' checked-out at ' . $this->details->attendance_time;
        }
        return $this->html($message);
    }
}
