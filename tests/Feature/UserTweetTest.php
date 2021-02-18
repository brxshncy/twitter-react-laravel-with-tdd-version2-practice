<?php

namespace Tests\Feature;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserTweetTest extends TestCase
{
    use WithFaker;

    public function test_user_can_post_tweet()
    {
        $this->withoutExceptionHandling();
        Passport::actingAs(
            User::factory()->create()
        );

        $payload = [
            'tweet' => $this->faker->sentence($nbWords = 6, $variableNbWords = true)
        ];

        $response = $this->postJson(route('tweet.store'), $payload);
      
        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => ['tweet']
                ]);
    }

    public function test_user_can_see_tweets_on_feed()
    {
        $this->withoutExceptionHandling();

        $user = Passport::actingAs(
            User::factory()->create()
        );

        $response = $this->getJson(route('tweet.index', $user));
        
        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => ['tweet']
                ]);
    }

    // TODO study Laravel policy
    
    // public function test_if_user_can_view_specific_tweet()
    // {
    //     $user = Passport::actingAs(
    //         User::factory()->create()
    //     );

    //     $tweet = Tweet::inRandomOrder()->first();

    //     $response = $this->getJson(route('tweet.show', $tweet));

    //     $response->assertStatus(200)
    //             ->assertJsonStructure([
    //                 'data' => ['tweet']
    //             ]);
    // }

    // public function test_if_user_can_remove_his_tweet()
    // {
    //     $user = Passport::actingAs(
    //         User::factory()->has(Tweet::factory()->count(2))->create()
    //     );

    //     $response = $this->getjson(route('tweet.destroy', $user->tweets(), $user));

    //     $response->assertStatus(200)
    //              ->assertJsonFragment([
    //                  'message' => 'Tweet Deleted successfuly!'
    //              ]);
      
    // }
}
