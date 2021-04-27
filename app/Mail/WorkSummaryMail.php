<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WorkSummaryMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $summary;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($summary)
    {
        $this->summary = $summary;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->html('Your todays work summary is ' . $this->summary);
    }
}
