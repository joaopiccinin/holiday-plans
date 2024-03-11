<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolidayPlanController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/holidayplans', [HolidayPlanController::class, 'index'])->name('holidayPlans.index');
Route::post('/holidayplans', [HolidayPlanController::class, 'store'])->name('holidayPlans.store');
Route::get('/holidayplans/{holidayPlan}', [HolidayPlanController::class, 'show'])->name('holidayPlans.show');
Route::put('/holidayplans/{holidayPlan}', [HolidayPlanController::class, 'update'])->name('holidayPlans.update');
Route::delete('/holidayplans/{$holidayplan}', [HolidayPlanController::class, 'destroy'])->name('holidayPlans.destroy');
