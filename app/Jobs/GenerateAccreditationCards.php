<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateAccreditationCards implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $province_id,$sport_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($province_id,$sport_id)
    {
        $this->province_id = $province_id;
        $this->sport_id = $sport_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return;
        $snappy = \App::make('snappy.pdf');
        
        $province = \App\Province::find($this->province_id);
        $sport = \App\Sport::find($this->sport_id);
     
        $snappy->generate("https://youthgames.changamire.com/province_sports_cards/$province->id/$sport->id", "/var/www/html/app/storage/app/public/$province->name/$sport->name.pdf",[],true);
    }
}
