<?php

namespace App\Http\Controllers;

use App\Models\HolidayPlan;
use Illuminate\Http\Request;

class HolidayPlanController extends Controller
{
    public function index()
    {
        $holidayPlans = HolidayPlan::all();
        return response()->json($holidayPlans);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'location' => 'required',
        ]);

        $holidayPlan = HolidayPlan::create($validatedData);

        return response()->json($holidayPlan, 201);

    }

    public function getHolidayPlan(HolidayPlan $holidayPlan)
    {
        return response()->json($holidayPlan);
    }

    public function update(Request $request, HolidayPlan $holidayPlan)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'location' => 'required',
        ]);

        $holidayPlan->update($validatedData);

        return response()->json($holidayPlan, 200);
    }

    public function delete(HolidayPlan $holidayPlan)
    {
        $holidayPlan->delete();

        return response()->json(null, 204);

    }

    public function pdfGenerate()
    {

    }
}
