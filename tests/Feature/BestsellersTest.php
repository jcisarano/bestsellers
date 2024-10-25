<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class BestsellersTest extends TestCase
{
    public function test_ideal_case(): void
    {
        Http::fake(['*' => Http::response(['book' => 'info'], 200, ['Headers'])]);

        $response = $this->get(route('1.nyt.best-sellers'));
        $response->assertStatus(200);
    }

    public function test_remote_fail()
    {
        Http::fake(['*' => Http::response("Testing remote 404", 404)]);

        $response = $this->get(route('1.nyt.best-sellers'));
        $response->assertStatus(502);
    }

    public function test_single_isbn_length_bad_len(): void
    {
        Http::fake(['*' => Http::response(['book' => 'info'], 200, ['Headers'])]);

        $response = $this->get(route('1.nyt.best-sellers', ['isbn'=>'1']));
        $response->assertStatus(422);
    }
    
    public function test_single_isbn_length_correct_10(): void
    {
        Http::fake(['*' => Http::response(['book' => 'info'], 200, ['Headers'])]);
        
        $response = $this->get(route('1.nyt.best-sellers', ['isbn'=>'1234567890']));
        $response->assertStatus(200);
    }
    
    public function test_single_isbn_length_correct_13(): void
    {
        Http::fake(['*' => Http::response(['book' => 'info'], 200, ['Headers'])]);
        $response = $this->get(route('1.nyt.best-sellers', ['isbn'=>'1234567890123']));
        $response->assertStatus(200);
    }
    
    public function test_multiple_isbn_correct(): void
    {
        Http::fake(['*' => Http::response(['book' => 'info'], 200, ['Headers'])]);
        $response = $this->get(route('1.nyt.best-sellers', ['isbn'=>'1234567890123;1234567890;1234567890123']));
        $response->assertStatus(200);
    }
    
    public function test_multiple_isbn_bad_len(): void
    {
        Http::fake(['*' => Http::response(['book' => 'info'], 200, ['Headers'])]);
        $response = $this->get(route('1.nyt.best-sellers', ['isbn'=>'123;1234567890;1234567890123']));
        $response->assertStatus(422);
    }
    
    public function test_multiple_isbn_bad_delimiter(): void
    {
        Http::fake(['*' => Http::response(['book' => 'info'], 200, ['Headers'])]);
        $response = $this->get(route('1.nyt.best-sellers', ['isbn'=>'1234567890123,1234567890,1234567890123']));
        $response->assertStatus(422);
    }
    
    public function test_offset_correct(): void 
    {
        Http::fake(['*' => Http::response(['book' => 'info'], 200, ['Headers'])]);
        $response = $this->get(route('1.nyt.best-sellers', ['offset'=>'20']));
        $response->assertStatus(200);
    }
    
    public function test_zero_offset(): void
    {
        Http::fake(['*' => Http::response(['book' => 'info'], 200, ['Headers'])]);
        $response = $this->get(route('1.nyt.best-sellers', ['offset'=>'0']));
        $response->assertStatus(200);
    }

    public function test_offset_not_integer(): void 
    {
        Http::fake(['*' => Http::response(['book' => 'info'], 200, ['Headers'])]);
        $response = $this->get(route('1.nyt.best-sellers', ['offset'=>'aaa']));
        $response->assertStatus(422);
    }

    public function test_offset_not_multiple_of_20(): void
    {
        Http::fake(['*' => Http::response(['book' => 'info'], 200, ['Headers'])]);
        $response = $this->get(route('1.nyt.best-sellers', ['offset'=>'27']));
        $response->assertStatus(422);
    }
}
