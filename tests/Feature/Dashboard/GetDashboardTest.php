<?php

namespace Tests\Feature\Dashboard;

use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;

class GetDashboardTest
{
    use RefreshDatabase;

    /** @test */
    public function it_should_load_the_dashboard():void
    {
       $user = User::factory()->create();
		
       $this->actingAs($user);	
								
       $name = $user->name; 

       $welcome_url = 'Welcome, ' . $name;
				
       $response = $this->get('/dashboard');
     
       $response->assertSee($welcome_url)->assertSee('Access your security accounts ids');    
    }
}
