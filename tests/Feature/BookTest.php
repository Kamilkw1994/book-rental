<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{
    Book,
    Client,
};

/**
 * @coversDefaultClass \App\Http\Modules\AdminApi\Contacts\Controller
 */
class BookTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = Client::factory()->create();
    }

    /**
     * @covers ::show
     */
    public function testShow()
    {
        $book = Book::create([
            'title' => 'Test Book',
            'author' =>  'Andrzej Sapkowski',
            'year' => 1999,
            'publisher' => 'Insignis',
        ]);

        $response = $this->get("/api/books/{$book->id}");

        $response->assertSee('Test Book');
    }

    /**
     * @covers ::rent
     */
    public function testRent()
    {
        $book = Book::create([
            'title' => 'Test Book',
            'author' =>  'Andrzej Sapkowski',
            'year' => 1999,
            'publisher' => 'Insignis',
            'is_rented' => false,
        ]);

        $response = $this->post("/api/books/{$book->id}/rent", [
            'is_rented' => true,
            'client_id' => $this->client->id,
        ]);

        $book->refresh();

        $response->assertStatus(200);

        $this->assertTrue((bool)$book->is_rented);
        $this->assertEquals($this->client->id, $book->client_id);
    }

        /**
     * @covers ::return
     */
    public function testReturn()
    {
        $book = Book::create([
            'title' => 'Test Book',
            'author' =>  'Andrzej Sapkowski',
            'year' => 1999,
            'publisher' => 'Insignis',
            'is_rented' => false,
        ]);

        $response = $this->put("/api/books/{$book->id}/return", [
            'is_rented' => false,
        ]);

        $book->refresh();
        
        $response->assertStatus(200);

        $this->assertFalse((bool)$book->is_rented);
    }
}
