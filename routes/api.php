<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolidayPlanController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\UserController;

Route::group([
    "middleware" => ["auth:api"]
], function(){
    Route::get('/holidayplans', [HolidayPlanController::class, 'index'])->name('holidayPlans.index');
    Route::post('/holidayplans', [HolidayPlanController::class, 'store'])->name('holidayPlans.store');
    Route::get('/holidayplans/{holidayPlan}', [HolidayPlanController::class, 'show'])->name('holidayPlans.show');
    Route::put('/holidayplans/{holidayPlan}', [HolidayPlanController::class, 'update'])->name('holidayPlans.update');
    Route::delete('/holidayplans/{holidayPlan}', [HolidayPlanController::class, 'destroy'])->name('holidayPlans.destroy');
    Route::get('holidayPlan/pdf/{id}', [PdfController::class, 'holidayPlanPdfGenerate'])->name('holidayPlan.pdf');

    Route::delete("/logout", [UserController::class, "logout"])->name('user.logout');
    Route::get("/profile", [UserController::class, "profile"])->name('user.profile');


});

Route::post("/register", [UserController::class, "register"])->name('user.register');
Route::post("/login", [UserController::class, "login"])->name('user.login');
