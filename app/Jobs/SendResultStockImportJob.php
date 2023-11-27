<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\ImportResponse;
use App\Events\ImportResponseEvent ;
use DB ;
class SendResultStockImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $admin ;
    public $file_name ;

     /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($admin,$file_name)
    {
        set_time_limit(500);
        $this->admin = $admin ;
        $this->file_name = $file_name ;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

            $bas_url = env('BASE_URL','');
            $sitemap_url = env('BASE_URL','');
            if(str_contains($bas_url,'localhost')){
                $baseUrl = base_path().'/public' ;
            }else{
                $baseUrl = $sitemap_url;
            }
            if (file_exists($baseUrl.'/uploads/imports_reports/'.$this->file_name.'.txt')) {
                event(new ImportResponseEvent(__('general::lang.wrongData'),[asset('uploads/imports_reports/'.$this->file_name.'.txt')],$this->admin->admins_id));
                if($this->admin->email)
                {
                  Mail::to($this->admin->email)->send(new ImportResponse(__('general::lang.wrongData'), [asset('uploads/imports_reports/'.$this->file_name.'.txt')]));
                }
            }else{

                event(new ImportResponseEvent(__('main::lang.importSuccess'),[],$this->admin->admins_id));
                if($this->admin->email)
                {
                    Mail::to($this->admin->email)->send(new ImportResponse(__('main::lang.importSuccess'), []));
                }
            }
        // }



    }


}
