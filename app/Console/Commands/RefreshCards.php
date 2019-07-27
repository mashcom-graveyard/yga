<?php

namespace App\Console\Commands;

use App\Province;
use App\Sport;
use Illuminate\Console\Command;

class RefreshCards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cards:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $provinces = Province::all();
        $sports = Sport::orderBy('name',"ASC")->get();
        $this->info(' Starting Card Refreshing. This is a might take a few minutes ' . PHP_EOL);
        //foreach($provinces as $province){
          //$this->info('Running cards for Province: ' .$province->name. PHP_EOL);
          //foreach($sports as $sport){
            // $this->info('Sport:' .$sport->name. PHP_EOL);
             \App\Jobs\GenerateAccreditationCards::dispatch(15,19)->delay(now()->addMinutes(2));
           // $this->info('Job Dispatched....'. PHP_EOL);
          //}
        //}
    }
}
