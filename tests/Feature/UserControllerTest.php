<?php

namespace Tests\Feature;

use App\Http\Controllers\UserController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testUserRegistrationSuccess()
    {
        $userData = [
            'name' => 'name test',
            'email' => 'nametest@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        // Envia uma solicitação POST para a rota de registro com os dados do usuário
        $response = $this->postJson(route('user.register'), $userData);

        // Verifica se a resposta tem o status 200 (OK)
        $response->assertStatus(200);

        // Verifica se o usuário foi criado com os dados fornecidos
        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'email' => $userData['email']
        ]);
    }

    public function testUserRegistrationFailure()
    {
        // First, create a user with a specific email
        $user = User::factory()->create(['email' => 'nametest@example.com']);

        $response = $this->postJson(route('user.register'), $user->toArray());

        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('email', $response->json()['errors']);
    }
}
