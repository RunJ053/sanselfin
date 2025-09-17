<?php

namespace App\Exports;

use App\Models\MovimientoFinanciero;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class ReporteExport implements FromView
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $controller = new \App\Http\Controllers\ReporteController();
        $data = $controller->financieros($this->request)->getData();

        return view('admin.reports.reporte_excel', (array) $data);
    }
}
