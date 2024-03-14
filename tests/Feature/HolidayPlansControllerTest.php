<?php

namespace Tests\Feature;

use App\Models\HolidayPlan;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HolidayPlansControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testIndex()
    {
        $holidayPlans = HolidayPlan::factory()->count(3)->create();

        // Chamar a rota do método index
        $response = $this->getJson(route('holidayPlans.index'));
        dd($response);

        // Verificar se a resposta é bem-sucedida (status 200)
        $response->assertStatus(200);

        // Verificar se a resposta contém os dados esperados
        foreach ($holidayPlans as $holidayPlan) {
            $response->assertJsonFragment([
                'title' => $holidayPlan->title,
                'description' => $holidayPlan->description,
                'date' => Carbon::createFromFormat($holidayPlan->date),
                'location' => $holidayPlan->location,
                'participants' => $holidayPlan->participants,
                '_links' => [
                    'self' => route('holidayPlans.show', ['holidayPlan' => $holidayPlan->id]),
                    'rel' => 'self'
                ]
            ]);

            // $response->assertJsonFragment([
            //     'date' => $holidayPlan->date->format('Y-m-d'),
            // ]);
        }
    }
}
