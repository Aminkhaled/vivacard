<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\ImportDistributionJob;

use File ;

class ImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file_name ;
    public $admin ;

     /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file_name,$admin)
    {
        set_time_limit(500);
        $this->file_name = $file_name ;
        $this->admin = $admin ;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('memory_limit', '1G');//1 GIGABYTE
        // ini_set('memory_limit','1000056M');

        if(str_contains(env('pathimages'),'public')){
            $path = public_path().'/' ;
        }else{
            $path = env('BASE_URL',str_replace('/public','',public_path())).'/';
        }

        $content = Excel::toArray([], $path.'uploads/import_files/'.$this->file_name);

        $bas_url = env('BASE_URL','');
        $sitemap_url = env('BASE_URL','');
        if(str_contains($bas_url,'localhost')){
            $baseUrl = base_path().'/public'  ;
        }else{
            $baseUrl = $sitemap_url;
        }

        if (!file_exists($baseUrl.'/uploads/imports_reports/'.$this->file_name.'.txt')) {
            touch($baseUrl.'/uploads/imports_reports/'.$this->file_name.'.txt');
        }
        file_put_contents($baseUrl.'/uploads/imports_reports/'.$this->file_name.'.txt',json_encode($content));

        ImportDistributionJob::dispatch($this->admin,$this->file_name,[])->onConnection('database');
        sleep(10);

    }


}
