<?php

namespace Tests\Feature;

use App\Models\Business;
use Tests\TestCase;

class BusinessControllerTest extends TestCase
{
    public function test_get_businesses()
    {
        $response = $this->get('/business');

        $response->assertStatus(200);
        $response->assertViewHas('businesses');
        $response->assertSee('Business');

    }

    public function test_can_create_new_business()
    {
        $response = $this->get('/business/create')->assertStatus(200);
        $response->assertSee('Add New Business');

        $this->post('/business', [
            'name' => 'Test Test Test',
            'price' => '10000',
            'city' => 'Test'
        ])->assertRedirect('/business');

        $test_id = Business::latest()->first()->id;
        $model_biz = Business::find($test_id);
        $model_biz_title = $model_biz->name;
        $this->assertEquals('Test Test Test', $model_biz_title);
        $model_biz->delete();
    }

    public function test_for_failed_create_business()
    {
        $response = $this->post('/business', [
            'name' => 'Test',
            'price' => '9999',
            'city' => ''
        ]);

        $response->assertSessionHasErrors(['name', 'price', 'city']);
    }

    public function test_it_checks_for_invalid_name()
    {
        $this->postJson('/business', ['name' => ''])
            ->assertStatus(422)
            ->assertJsonStructure(['message', 'errors' => ['name']]);

        $this->postJson('/business', ['name' => str_repeat("a", 9)])
            ->assertStatus(422)
            ->assertJsonStructure(['message', 'errors' => ['name']]);

        $this->postJson('/business', ['name' => str_repeat("a", 51)])
            ->assertStatus(422)
            ->assertJsonStructure(['message', 'errors' => ['name']]);
    }

    public function test_it_checks_for_invalid_price()
    {
        $this->postJson('/business', ['price' => ''])
            ->assertStatus(422)
            ->assertJsonStructure(['message', 'errors' => ['price']]);

        $this->postJson('/business', ['price' => str_repeat("1", 9999)])
            ->assertStatus(422)
            ->assertJsonStructure(['message', 'errors' => ['price']]);

        $this->postJson('/business', ['price' => 10000001])
            ->assertStatus(422)
            ->assertJsonStructure(['message', 'errors' => ['price']]);
    }

    public function test_it_checks_for_invalid_city()
    {
        $this->postJson('/business', ['city' => ''])
            ->assertStatus(422)
            ->assertJsonStructure(['message', 'errors' => ['city']]);
    }

    public function test_get_business()
    {
        $business = Business::factory()->create([
            'name' => str_repeat("a", 10),
            'price' => str_repeat("1", 5),
            'city' => 'Test',
        ]);
        $response = $this->get('business/' . $business->id);
        $response->assertSee('Name:');
        $response->assertSee(str_repeat("a", 10));
        $business->delete();
    }


    public function test_update_business(){
        $business = Business::factory()->create([
            'name' => str_repeat("a", 10),
            'price' => str_repeat("1", 5),
            'city' => 'Test1',
        ]);

        $this->get("/business/{$business->id}/edit")
            ->assertStatus(200)
            ->assertViewHas('business');

        $this->put("/business/{$business->id}", [
            'name' => str_repeat("b", 10),
            'price' => str_repeat("2", 5),
            'city' => 'Test2',
        ])
            ->assertRedirect('/business');

        $response = $this->get('business/' . $business->id);
        $response->assertSee(str_repeat("b", 10));
        $response->assertSee(str_repeat("2", 5));
        $response->assertSee('Test2');

        $business->delete();
    }


    public function test_for_failed_update_business()
    {
        $business = Business::factory()->create([
            'name' => str_repeat("a", 10),
            'price' => str_repeat("1", 5),
            'city' => 'Test1',
        ]);
        $response = $this->put("/business/{$business->id}", [
            'name' => str_repeat("b", 9),
            'price' => str_repeat("2", 4),
            'city' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'price', 'city']);

        $business->delete();
    }

    public function test_delete_business(){
        $business = Business::factory()->create([
            'name' => str_repeat("a", 10),
            'price' => str_repeat("1", 5),
            'city' => 'Test',
        ]);
        $response = $this->delete('/business/'.$business->id);
        $response->assertRedirect('/business');
    }

}
