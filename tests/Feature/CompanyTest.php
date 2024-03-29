<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
 
class CompanyTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function testSeeder()
    {
        $this->artisan('db:seed');

        $this->assertDatabaseHas('roles', [
            'name' => 'customer'
        ]);

        \DB::statement('ALTER TABLE roles AUTO_INCREMENT = 1');
    }
    
    public function test_admin_user_can_access_companies_index_page(): void
    {
        $user = User::factory()->admin()->create();
        var_dump($user);
        $response = $this->actingAs($user)->get(route('companies.index'));
        // var_dump($response->getContent());
        // var_dump($response->status());
 
        $response->assertOk();
    }
 
    public function test_non_admin_user_cannot_access_companies_index_page(): void
    {
        $user = User::factory()->create();
 
        $response = $this->actingAs($user)->get(route('companies.index'));
 
        $response->assertForbidden();
    }
}