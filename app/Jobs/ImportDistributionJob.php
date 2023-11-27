<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Jobs\StockImportOperationJob;
use App\Jobs\StockImportValidationJob;
use File ;
use DB ;
use Illuminate\Support\Facades\Validator;;
class ImportDistributionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file_name ;
    public $admin ;
    public $content ;

     /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($admin,$file_name,$content=null)
    {
        set_time_limit(500);
        $this->file_name = $file_name ;
        $this->admin = $admin ;
        $this->content = $content ;

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
            $baseUrl = base_path().'/public'  ;
        }else{
            $baseUrl = $sitemap_url;
        }
        ini_set('memory_limit', '1G');//1 GIGABYTE

        if (file_exists($baseUrl.'/uploads/imports_reports/'.$this->file_name.'.txt')) {
            $content = file_get_contents($baseUrl.'/uploads/imports_reports/'.$this->file_name.'.txt');
            $this->content = json_decode($content) ;
            if (File::exists($baseUrl.'/uploads/imports_reports/'.$this->file_name.'.txt')) {
                File::delete($baseUrl.'/uploads/imports_reports/'.$this->file_name.'.txt');
            }
        }

        $data = [];
        if(is_array($this->content) && sizeof($this->content) > 0 && is_array($this->content[0]) &&  sizeof($this->content[0]) > 0){
            $columnNames = array_values($this->content[0][0]);
            array_shift($this->content[0]);
            foreach($this->content[0] as $key => $row){
                $arr = array_combine($columnNames,$row);
                array_push($data,$arr);
            }
        }

        // DB::connection('mysql')->select('TRUNCATE TABLE diseases;');
        if(sizeof($data) > 5000){
            foreach(array_chunk($data,5000) as $key => $array_data){
                StockImportValidationJob::dispatch($array_data,$this->admin,$key,$this->file_name)->onConnection('database');
                StockImportOperationJob::dispatch($array_data,$this->admin,$key,$this->file_name)->onConnection('database');
            }
        }else{
            StockImportValidationJob::dispatch($data,$this->admin,0,$this->file_name)->onConnection('database');
            StockImportOperationJob::dispatch($data,$this->admin,0,$this->file_name)->onConnection('database');
        }
        sleep(10);
    }


    /**
     * Validate Data and send errors messages as array
     * @param  Order $order
     * @return [type]           [description]
     */
    public function validateData($data, $rules)
    {
        $messages = null;
        //check the validator true or not
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            // Get Messages
            $messages = $validator->messages()->all();
        }

        return $messages;
    }
}
