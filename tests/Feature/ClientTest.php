<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{
    Client,
};

/**
 * @coversDefaultClass \App\Controller
 */
class ClientTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @covers ::Store
     */
    public function testStore()
    {
        $response = $this->post('/api/clients', [
            'first_name' => 'Andrzej',
            'last_name' => 'Sapkowski',
        ]);

        $this->assertCount(26, Client::all());
    }

    /**
     * @covers ::Show
     */
    public function testShow()
    {
        $client = Client::create([
            'first_name' => 'Andrzej',
            'last_name' => 'Sapkowski',
        ]);

        $response = $this->get("/api/clients/{$client->id}");

        $response->assertSee('Andrzej');
    }

    /**
     * @covers ::Destroy
     */
    public function testDestroy()
    {
        $client = Client::create([
            'first_name' => 'Andrzej',
            'last_name' => 'Sapkowski',
        ]);

        $response = $this->delete("/api/clients/{$client->id}");

        $this->assertCount(25, Client::all());
    }
}
