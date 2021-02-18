<?php

namespace Tests\Feature;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
use Tests\TestCase;

class TweetCommentTest extends TestCase
{


    use WithFaker;

    public function test_user_can_comment_tweet()
    {
            $this->withoutExceptionHandling();


            $tweet = Tweet::findOrFail(12);

            $user = User::inRandomOrder()->first();
            
            Passport::actingAs(
                $user
            );

            $payload = [
                'user_id' => $user->id,
                'tweet_id' => $tweet->id,
                'comment' => $this->faker->sentence($nbWords = 6, $variableNbWords = true)
            ];

            $response = $this->postJson(route('comment.store'), $payload);

            $response->assertStatus(200)
                    ->assertJsonStructure([
                        'data' => ['comment']
                    ]);
                    

    }

    public function test_user_can_view_comment_count()
    {
        $this->withoutExceptionHandling();

        $user = Auth::loginUsingId(91);

        Passport::actingAs(
            $user
        );

        $response = $this->getJson(route('tweet.index'));

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => ['tweet', 'comments_count']
                 ]);

    }

        public function test_user_can_view_comment_count_on_specific_tweet()
        {
            $this->withoutExceptionHandling();

            $user = Auth::loginUsingId(91);

            $tweet = Tweet::findOrFail(12);

            Passport::actingAs(
                $user
            );

            $response = $this->getJson(route('tweet.show', $tweet));
            
            $response->assertStatus(200)
                    ->assertJsonStructure([
                        'data' => ['tweet', 'comments_count']
                    ]);
        }
}
