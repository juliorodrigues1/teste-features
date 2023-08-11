<?php

namespace Tests\Feature\API;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class BooksControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_get_books_endpoint(): void
    {
        $books = Book::factory(3)->create();
        $response = $this->getJson('/api/books');

        $response->assertStatus(200);
        $response->assertJsonCount(3);

        $response->assertJson(function (AssertableJson $json){
           $json->whereType('0.id', 'integer');
           $json->whereType('0.title', 'string');
        });
    }

    public function test_get_single_book_endpoint(): void
    {
        $book = Book::factory(1)->createOne();
        $response = $this->getJson('/api/books/'.$book->id);

        $response->assertStatus(200);


        $response->assertJson(function (AssertableJson $json){
            $json->hasAll(['id', 'title'])->etc();

            $json->whereType('id', 'integer');
            $json->whereType('title', 'string');
        });
    }

    public function test_post_book_endpoint()
    {
        $book = Book::factory(1)->makeOne()->toArray();

        $response = $this->postJson('/api/books/', $book);

        $response->assertStatus(201);

        $response->assertJson(function (AssertableJson $json) use($book){
            $json->whereAll([
                'title' => $book['title']
            ])->etc();
        });

    }

    public function test_put_book_endpoint(){
        Book::factory(1)->createOne();

        $book = [
            'title' => "atualiza livro"
        ];
        $response = $this->putJson( '/api/books/1', $book);

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use($book){
            $json->whereAll([
                'title' => $book['title']
            ])->etc();
        });
    }


}
