<?php

namespace App\Http\Controllers;

use App\Models\HolidayPlan;

class PdfController extends Controller
{
    public function holidayPlanPdfGenerate($id)
    {
        $holidayPlan = HolidayPlan::find($id);

        $pdf = app('dompdf.wrapper');

        $pdf->loadView('holidayPlan', compact('holidayPlan'));

        return $pdf->download('holiday_plan_'. $id . '.pdf');
    }
}
