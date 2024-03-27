<?php

namespace App\Http\Controllers;

use App\Models\HolidayPlan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class HolidayPlanController extends Controller
{
    public function index()
    {
        $holidayPlans = HolidayPlan::orderBy('date')->get();
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
        return response()->json($data, 200);
    }


    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'date' => 'required|date_format:Y-m-d',
                'location' => 'required',
                'participants' => 'nullable|string'
            ]);
            $holidayPlan = HolidayPlan::create($validatedData);

            return response()->json($holidayPlan, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function show(Request $request, HolidayPlan $holidayPlan)
    {
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
        return response()->json($resource, 200);
    }

    public function update(Request $request, HolidayPlan $holidayPlan)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'date' => 'required|date_format:Y-m-d',
                'location' => 'required',
                'participants' => 'nullable|string'
            ]);
            $holidayPlan->update($validatedData);

            return response()->json($holidayPlan, 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function destroy(HolidayPlan $holidayPlan)
    {
        $holidayPlan->delete();

        return response()->json(['message' => 'Deleção concluída com sucesso'], 200);
    }
}
