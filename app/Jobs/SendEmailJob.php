<?php

namespace App\Jobs;

use App\Mail\NamesDrawn;
use App\Mail\TestAmazonEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;
    public $secretList;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details, $secretList)
    {
        $this->details = $details;
        $this->secretList = $secretList;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        foreach ($this->details as $detail) {
            try {
                Mail::to($detail->email)->send(new NamesDrawn($detail->parent, $this->secretList));
            } catch (\Exception $e) {
                Log::error('Error sending email' . $e->getMessage());
            }
        }
    }
}
