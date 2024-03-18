<?php

namespace Tests\Feature;

use App\Models\HolidayPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class PdfControllerTest extends TestCase
{
    public function testShow()
    {
        // Create a test user
        $user = User::factory()->create();

        // User authentication
        Passport::actingAs($user);
        $holidayPlan = HolidayPlan::factory()->create();

        $response = $this->getJson(route('holidayPlans.show', ['holidayPlan' => $holidayPlan->id]));
        $response->assertStatus(200);

        // Verify data
        $response->assertJson([
            'title' => $holidayPlan->title,
            'description' => $holidayPlan->description,
            'date' => $holidayPlan->date->format('Y-m-d'),
            'location' => $holidayPlan->location,
            'participants' => $holidayPlan->participants,
        ]);
    }
}
