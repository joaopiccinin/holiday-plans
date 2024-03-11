<?php

namespace App\Http\Controllers;

use App\Models\HolidayPlan;
use Illuminate\Http\Request;

class HolidayPlanController extends Controller
{
    public function index()
    {
        $holidayPlans = HolidayPlan::all();
        $data = [];
        foreach ($holidayPlans as $holidayPlan) {
            $resource = [
                'title' => $holidayPlan->title,
                'description' => $holidayPlan->description,
                'date' => $holidayPlan->date,
                'location' => $holidayPlan->location,
                'participants' => $holidayPlan->participants,
                '_links' => [
                    'self' => route('holidayPlans.show', ['holidayPlan' => $holidayPlan->id]),
                    'rel' => 'self'
                ]
            ];
            $data[] = $resource;
        }
        return response()->json($data);
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

    public function show(HolidayPlan $holidayPlan)
    {
        $holidayPlan = HolidayPlan::find($holidayPlan->id);

        $resource = [
            'title' => $holidayPlan->title,
            'description' => $holidayPlan->description,
            'date' => $holidayPlan->date,
            'location' => $holidayPlan->location,
            'participants' => $holidayPlan->participants,
            '_links' => [
                'Holiday plans List' => route('holidayPlans.index'),
            ]
        ];
        return response()->json($resource);
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
