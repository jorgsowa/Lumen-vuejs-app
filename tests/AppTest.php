<?php

use App\Models\Color;
use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AppTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample(): void
    {
        $this->get('/');

        $this->assertResponseOk();

        $this->assertStringContainsString('Colors app', $this->response->getContent());
    }

    public function testAuthorizationFailed(): void
    {
        $this->get('/api/color');

        $this->assertResponseStatus(401);
    }

    public function testAuthorizationSuccess(): void
    {
        $user = $this->createUserWithApiHeaders();

        $this->get('/api/color', $user['headers']);

        $this->assertResponseOk();
    }

    protected function createUserWithApiHeaders(): array
    {
        $user = User::factory()->create();

        $headersWithApiToken = ['Authorization' => 'Bearer ' . $user->api_token];

        return ['entity' => $user, 'headers' => $headersWithApiToken];
    }

    public function testApiGetColors(): void
    {
        $user = $this->createUserWithApiHeaders();

        $this->get('/api/color', $user['headers'])->seeJsonStructure([0 => ['id',
            'name',
            'hex']]);
    }

    public function testApiCreateColorSuccess(): void
    {
        $user = $this->createUserWithApiHeaders();

        $data = [
            'name' => 'Marigold',
            'hex' => 'eaa221',
        ];

        $this->post('/api/color/create', $data, $user['headers'])->assertResponseStatus(201);
    }

    public function testApiCreateColorFailed(): void
    {
        $user = $this->createUserWithApiHeaders();

        $data = [
            'name' => '',
            'hex' => '',
        ];

        $this->post('/api/color/create', $data, $user['headers'])->assertResponseStatus(400);

        $data = [
            'name' => 'Marigold',
            'hex' => 'ea1',
        ];

        $this->post('/api/color/create', $data, $user['headers'])->assertResponseStatus(400);
    }

    public function testApiDeleteColorSuccess(): void
    {
        $user = $this->createUserWithApiHeaders();

        $color = Color::factory()->create();

        $this->delete("/api/color/{$color->id}", headers: $user['headers'])->assertResponseOk();
    }

    public function testApiDeleteColorFailed(): void
    {
        $user = $this->createUserWithApiHeaders();

        $this->delete("/api/color/0", headers: $user['headers'])->assertResponseStatus(400);
    }
}
