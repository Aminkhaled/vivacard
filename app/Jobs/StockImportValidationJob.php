<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\SendResultStockImportJob ;
use Illuminate\Support\Facades\Validator;
use Config;
use DB ;
class StockImportValidationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data ;
    public $from ;
    public $admin ;
    public $file_name ;
     /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data,$admin,$from,$file_name)
    {
        set_time_limit(500);
        $this->data = $data ;
        $this->from = $from ;
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
            $baseUrl = base_path().'/public'  ;
        }else{
            $baseUrl = $sitemap_url;
        }
        ini_set('memory_limit', '1G');//1 GIGABYTE
        // Config::set('queue.default', 'sync');

        $rules = [
            '*.diseases_code_icd10'                     => 'required',
            '*.diseases_name'                           => 'required',
            // '*.diseases_types_code'                     => 'required|exists:mysql.diseases_types,diseases_types_code',
            '*.diseases_types_code'                     => 'required',
            '*.diseases_clinical_manifestations'        => 'nullable',
            '*.diseases_criteria_admission'             => 'nullable',
            '*.diseases_triggers_progress_notes'        => 'nullable',
            '*.diseases_most_important_dd'              => 'nullable',
            '*.diseases_not_covered'                    => 'nullable',
            '*.diseases_insurance_notes_1'              => 'nullable',
            '*.diseases_investigations'                 => 'nullable',
            '*.diseases_achi1'                          => 'nullable',
            '*.diseases_treatment_notes'                => 'nullable',
            '*.diseases_insurance_notes_2'              => 'nullable',
            '*.diseases_procedures'                     => 'nullable',
            '*.diseases_achi2'                          => 'nullable',
            '*.diseases_status'                         => 'required',
            '*.diseases_position'                       => 'required',
        ];
        // Check if Data Valid or Not
        $checkDataValid = $this->validateData($this->data, $rules);
        if ($checkDataValid) {

            if (!file_exists($baseUrl.'/uploads/imports_reports/'.$this->file_name.'.txt')) {
                touch($baseUrl.'/uploads/imports_reports/'.$this->file_name.'.txt');
            }
            $content = file_get_contents($baseUrl.'/uploads/imports_reports/'.$this->file_name.'.txt');
            $pattern = "/[0-9]+/";
            foreach($checkDataValid as $error){
                preg_match($pattern, $error,$matches);
                if(sizeof($matches) >0 ){
                    $error = str_replace($matches[0],($this->from*5000)+(intval($matches[0])),$error);
                }
                $content .= " \n ".$error;
            }
            file_put_contents($baseUrl.'/uploads/imports_reports/'.$this->file_name.'.txt',$content);

        }

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
