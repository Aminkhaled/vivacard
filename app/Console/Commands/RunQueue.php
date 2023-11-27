<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\General\Models\Language;

use Carbon\Carbon;
use DB ;
class RunQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'run queue';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        ini_set('memory_limit','1000056M');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $activeJobs = DB::select('SELECT * FROM `jobs` WHERE `reserved_at` > 0') ;
        if(sizeof($activeJobs) > 5){
            // $Jobs = DB::select('UPDATE `jobs` SET `attempts`=0,`reserved_at`=null') ;
            // \Artisan::call('queue:restart');
        }else{
            \Artisan::call('queue:work database --stop-when-empty  --tries=2 --timeout=100024');
        }

        $this->info('run queue success');
    }
}
