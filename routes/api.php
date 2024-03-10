<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolidayPlanController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/holidayplans', [HolidayPlanController::class, 'index']);
Route::post('/holidayplans', [HolidayPlanController::class, 'store']);
Route::get('/holidayplans/{$holidayPlan}', [HolidayPlanController::class, 'getHolidayPlan']);
Route::put('/holidayplans/{$holidayPlan}', [HolidayPlanController::class, 'update']);
Route::delete('/holidayplans/{$holidayPlan}', [HolidayPlanController::class, 'destroy']);
