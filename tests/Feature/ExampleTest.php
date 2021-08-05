<?php

namespace Tests\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function only_logged_in_users_can_see_dashboard(){
        $response = $this->get('/dashboard')->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_users_can_see_dashboard(){
    
        $this->actingAsAdmin();
        $response = $this->get('/dashboard')->assertOk();;
    }

    /** @test */
    public function a_user_can_be_added_using_form(){
        $this->actingAsAdmin();

        $response = $this->post('/adduser/send', $this->data() );

        $this->assertCount(2, User::all());
    }

    /** @test */
    public function a_username_is_required(){
        $this->actingAsAdmin();
        $response = $this->post('/adduser/send', array_merge($this->data(), ['username' => '']));

        $response->assertSessionHasErrors('username');
        $this->assertCount(1, User::all()); // 1 is admin
    }

     /** @test */
     public function a_username_is_atleast_4_characters_required(){
        $this->actingAsAdmin();
        $response = $this->post('/adduser/send', array_merge($this->data(), ['username' => 'abc']));

        $response->assertSessionHasErrors('username');
        $this->assertCount(1, User::all()); // 1 is admin
    }


    private function actingAsAdmin() {
        $user = User::factory()->create([
            'role' => 'admin'
        ]);
        $this->actingAs($user);
    }

    private function data(){
        return [
            'username' => 'TestUser1',
            'email' => 'testuser@gmail.com',
            'address' => 'Colombo',
            'phone' => '0719077098',
            'NIC'   => '567890456v'
        ];
    }
}
