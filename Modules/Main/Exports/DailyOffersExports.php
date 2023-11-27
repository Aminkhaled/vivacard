<?php

namespace Modules\Main\Exports;

use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class DailyOffersExports implements FromView, Responsable
{


    use Exportable;
    
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName =	'daily_offers.xlsx';
    
    /**
    * Optional Writer Type
    */
    private $writerType = Excel::XLSX;
    
    /**
    * Optional headers
    */
    // private $headers = [
    //     'Content-Type' => 'text/csv',
    

	// ];
	public function __construct($daily_offers)
    {
        $this->daily_offers = $daily_offers;
    }

    public function view(): View
    {
        return view('main::admin.exports.daily_offers', [
            'daily_offers' => $this->daily_offers ,
        ]);
    }

    public function query()
    {
        //
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // 
    }
}
