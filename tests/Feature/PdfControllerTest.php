<?php

namespace Tests\Feature;

use App\Models\HolidayPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Tests\TestCase;

class PdfControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testHolidayPlanPdfGenerate()
    {
        // Criar um plano de feriado fictício
        $holidayPlan = HolidayPlan::factory()->create();

        // Simular a autenticação de um usuário
        $user = User::factory()->create();
        Passport::actingAs($user);

        // Chamar o método holidayPlanPdfGenerate
        $response = $this->getJson(route('holidayPlan.pdf', ['id' => $holidayPlan->id]));

        // Verificar se a resposta foi bem-sucedida
        $response->assertStatus(200);

        // Verificar se o conteúdo do PDF foi retornado
        $response->assertHeader('Content-Type', 'application/pdf');
    }
}
