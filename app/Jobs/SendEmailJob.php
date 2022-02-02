<?php

namespace App\Jobs;

use App\Services\AdService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailSent;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ads = app(AdService::class)->getAdsForTomorrow();

        foreach ($ads as $ad) {
            $data=[
                'name'=> $ad->advertiser->name,
                'date'=> $ad->start_date
            ];
            Mail::to($ad->advertiser->email)->send(new EmailSent($data));
        }
    }
}
