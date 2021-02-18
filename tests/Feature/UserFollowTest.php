<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Laravel\Passport\Passport;

class UserFollowTest extends TestCase
{
    public function test_if_user_can_follow()
    {
        $this->withoutExceptionHandling();

        $user = Passport::actingAs(
            User::factory()->create()
        );

        $follow_user = User::inRandomOrder()->first();

        $payload = [
            'user_id' => $user->id,
            'follow_user_id' => $follow_user->id
        ];

        $response = $this->postJson(route('follow.store'), $payload);

        $response->assertStatus(200)
                ->assertJsonFragment([
                    'message' => 'You are following the user'
                ]);
    }

    public function test_if_user_cannot_follow_the_already_followed_user()
    {
        $this->withoutExceptionHandling();

        $user = Passport::actingAs(
            User::findOrFail(91)
        );

        $payload = [
            'user_id' => $user->id,
            'follow_user_id' => 58
        ];

        $response = $this->postJson(route('follow.store'), $payload);

        $response->assertStatus(200)
                ->assertJsonFragment([
                    'message' => 'User Already followed'
                ]);
    }

    public function test_if_current_logged_in_user_can_view_list_of_users_that_has_not_been_followed()
    {

        $this->withoutExceptionHandling();

        Passport::actingAs(
            Auth::loginUsingId(91)
        );

        $response = $this->getJson(route('who.to.follow.users'));

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => ['users']
                ]);
    }
}
