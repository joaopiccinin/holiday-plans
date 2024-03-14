<?php

namespace Tests\Feature;

use App\Models\HolidayPlan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;
use Tests\TestCase;

class HolidayPlansControllerTest extends TestCase
{
    // Test rollback
    use DatabaseTransactions;
    public function testIndex()
    {
        // Create a test user
        $user = User::factory()->create();

        // User authentication
        Passport::actingAs($user);

        // Create a holidayplan test
        $holidayPlans = HolidayPlan::factory()->count(3)->create();

        $response = $this->getJson(route('holidayPlans.index'));

        $response->assertStatus(200);

        foreach ($holidayPlans as $holidayPlan) {
            $response->assertJsonFragment([
                'title' => $holidayPlan->title,
                'description' => $holidayPlan->description,
                'date' => $holidayPlan->date->format('Y-m-d'),
                'location' => $holidayPlan->location,
                'participants' => $holidayPlan->participants,
            ]);

        }
        $user->delete();
    }
}
