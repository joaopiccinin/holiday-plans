<?php

namespace Tests\Feature;

use App\Models\HolidayPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
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
    }

    public function testUnauthenticatedAccessToIndex()
    {
        $response = $this->getJson(route('holidayPlans.index'));

        $response->assertStatus(401);
    }

    public function testUpdate()
    {
        $user = User::factory()->create();
        // User authentication
        Passport::actingAs($user);
        $holidayPlan = HolidayPlan::factory()->create();

        $data = [
            'title' => 'test title',
            'description' => 'test description',
            'date' => '2024-01-01',
            'location' => 'Ijui',
            'participants' => 'Pedro, Joao, Paulo'
        ];
        $response = $this->putJson(route('holidayPlans.update', ['holidayPlan' => $holidayPlan]), $data);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'title' => 'test title',
            'description' => 'test description',
            'date' => '2024-01-01',
            'location' => 'Ijui',
            'participants' => 'Pedro, Joao, Paulo'
        ]);
    }

    public function testStore()
    {
        // Cria um usuário fictício
        $user = User::factory()->create();
        // Autentica o usuário usando Laravel Passport
        Passport::actingAs($user);
        // Dados do plano de feriado
        $data = [
            'title' => 'test title',
            'description' => 'test description',
            'date' => '2024-01-01',
            'location' => 'Ijui',
            'participants' => 'Pedro, Joao, Paulo'
        ];
        // Faz uma requisição PUT para a rota correspondente ao método store do controller
        $response = $this->postJson(route('holidayPlans.store'), $data);
        // Verifica se a resposta foi bem-sucedida (código de status 200)
        $response->assertStatus(201);
        // Verifica se os dados retornados são os mesmos que foram enviados
        $response->assertJsonFragment($data);
        // Verifica se um novo plano de feriado foi criado no banco de dados
        $this->assertDatabaseHas('holiday_plans', $data);
    }
}
