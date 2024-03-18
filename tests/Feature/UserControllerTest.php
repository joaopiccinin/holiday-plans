<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Validation\ValidationException;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserRegistrationSuccess()
    {
        $userData = [
            'name' => 'name test',
            'email' => 'nametest@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->postJson(route('user.register'), $userData);

        // Verify status
        $response->assertStatus(200);

        // Verify user data
        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'email' => $userData['email']
        ]);
    }

    public function testUserRegistrationFailureByEmailAlreadyExists()
    {
        //Creating a user with a specific email
        $user = User::factory()->create(['email' => 'nametest@example.com']);
        //In this application, the user's email is unique
        $response = $this->postJson(route('user.register'), $user->toArray());

        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('email', $response->json()['errors']);
    }

    public function testUserRegistrationFailureByInvalidData()
    {
        // First, create a user with a specific email
        $userData = [
            'name' => 'name test',
            'email' => 'nametestexample.com',
        ];

        $response = $this->postJson(route('user.register'), $userData);

        // Assert that the response status is 422 (Unprocessable Entity)
        $response->assertStatus(422);

        // Assert that the response contains the expected error message for login failure
        $response->assertJsonValidationErrors(['email', 'password']);
    }

    public function testUserLoginSuccess()
    {
        // Envia uma solicitação POST para a rota de registro com os dados do usuário
        User::factory()->create([
            'email' => 'nametest2@example.com',
            'password' => 'password'
        ]);
;
        // Tenta fazer login com as credenciais do usuário recém-criado
        $response = $this->postJson(route('user.login'), [
            'email' => 'nametest2@example.com',
            'password' => 'password'
        ]);

        // Verifica se o login foi bem-sucedido
        $response->assertStatus(200);
        $this->assertArrayHasKey('access_token', $response->json());
    }

    public function testUserLoginFailure()
    {
        // First, create a user with a specific email
        User::factory()->create([
            'email' => 'nametest2@example.com',
            'password' => 'password'
        ]);

        $response = $this->postJson(route('user.login'), [
            'email' => 'nametest2@example.com',
            'password' => 'wrong_password', // Incorrect password
        ]);

        // Assert that the response status is 422 (Unprocessable Entity)
        $response->assertStatus(422);

        // Assert that the response contains the expected error message for login failure
        $response->assertJson([
            'status' => false,
            'message' => 'Invalid credentials',
        ]);
    }


}
