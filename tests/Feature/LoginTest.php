<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    // If you use this trait, Laravel will automatically reset the database after this test finishes.
    // It's very useful so your tests don't mess up your actual database.
    // use RefreshDatabase; 

    /**
     * Test if the login page loads successfully.
     */
    public function test_login_page_is_accessible(): void
    {
        // 1. Arrange: Prepare any data if needed (Not needed for a simple page load)

        // 2. Act: Make a GET request to the login route (assuming your login route is /login)
        $response = $this->get('/login');

        // 3. Assert: Verify the response is 200 OK
        $response->assertStatus(200);
    }
}
