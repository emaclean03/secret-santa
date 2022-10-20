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
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;

        foreach($this->details as $detail){
            Mail::to($detail->email)->send(new TestAmazonEmail($detail->parent->email));
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
