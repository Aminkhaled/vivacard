<?php

namespace Modules\General\Exports;

use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;



class ContactUsExport implements FromView, Responsable
{


    use Exportable;

    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName =	'contactus.xlsx';

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

    public function __construct( $contactus)
    {
        $this->contactus = $contactus;
    }

    public function view(): View
    {
        return view('general::admin.contactus.contactusExport', [
            'contactus' => $this->contactus ,
        ]);
    }

}
