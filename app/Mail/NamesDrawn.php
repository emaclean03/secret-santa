<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NamesDrawn extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    public $secretList;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $secretList)
    {
        $this->details = $details;
        $this->secretList = $secretList;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.NamesDrawn');
    }
}
