<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Modules\Main\Models\Disease;
use Modules\Main\Models\DiseaseType;

use App\Jobs\CalculateStocksJob ;
use App\Jobs\SendNotifyForProductsJob ;
use App\Jobs\SendResultStockImportJob ;
use DB ;
use Config;
use Carbon\Carbon;
class StockImportOperationJob implements ShouldQueue
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
        ini_set('memory_limit', '1G');//1 GIGABYTE
        foreach($this->data as $row) {
            if(isset($row['diseases_types_code']) && isset($row['diseases_code_icd10']) && isset($row['diseases_name']) ){
                $diseaseType = DiseaseType::where('diseases_types_code',$row['diseases_types_code'])->first();
                $disease = Disease::where('diseases_code_icd10',$row['diseases_code_icd10'])->first();
                if(!$disease){
                    $disease = new Disease ;
                }
                $disease->diseases_code_icd10 = $row['diseases_code_icd10'];
                $disease->diseases_name = $row['diseases_name'];
                if($diseaseType){
                    $disease->diseases_types_id = $diseaseType->diseases_types_id;
                }
                $disease->diseases_clinical_manifestations  = isset($row['diseases_clinical_manifestations']) ? $row['diseases_clinical_manifestations'] : '';
                $disease->diseases_criteria_admission       = isset($row['diseases_criteria_admission']) ? $row['diseases_criteria_admission'] : '';
                $disease->diseases_triggers_progress_notes  = isset($row['diseases_triggers_progress_notes']) ? $row['diseases_triggers_progress_notes'] : '';
                $disease->diseases_most_important_dd        = isset($row['diseases_most_important_dd']) ? $row['diseases_most_important_dd'] : '';
                $disease->diseases_not_covered              = isset($row['diseases_not_covered']) ? $row['diseases_not_covered'] : '';
                $disease->diseases_insurance_notes_1        = isset($row['diseases_insurance_notes_1']) ? $row['diseases_insurance_notes_1'] : '';
                $disease->diseases_investigations           = isset($row['diseases_investigations']) ? $row['diseases_investigations'] : '';
                $disease->diseases_achi1                    = isset($row['diseases_achi1']) ? $row['diseases_achi1'] : '';
                $disease->diseases_treatment_notes          = isset($row['diseases_treatment_notes']) ? $row['diseases_treatment_notes'] : '';
                $disease->diseases_insurance_notes_2        = isset($row['diseases_insurance_notes_2']) ? $row['diseases_insurance_notes_2'] : '';
                $disease->diseases_procedures               = isset($row['diseases_procedures']) ? $row['diseases_procedures'] : '';
                $disease->diseases_achi2                    = isset($row['diseases_achi2']) ? $row['diseases_achi2'] : '';
                $disease->diseases_status                   = isset($row['diseases_status']) ? (string)$row['diseases_status'] : '';
                $disease->diseases_position                 = isset($row['diseases_position']) ? $row['diseases_position'] : '';
                $disease->save();

            }
        }
        $allJobs = DB::table('jobs')->get();
        if(sizeof($allJobs) <= 1){
            SendResultStockImportJob::dispatch($this->admin,$this->file_name)->onConnection('database');
        }
    }

}
