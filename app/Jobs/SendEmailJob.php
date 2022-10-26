<?php

namespace App\Jobs;

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
        foreach ($this->details as $detail) {
            try {
                Mail::to($detail->email)->send(new TestAmazonEmail($detail->parent, $secretList));
            } catch (\Exception $e) {
                Log::error('Error sending email' . $e->getMessage());
            }
        }


    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        //dd('hello');
        //Mail::to('emaclean03@aol.com')->send(new TestAmazonEmail($this->details));
    }
}
