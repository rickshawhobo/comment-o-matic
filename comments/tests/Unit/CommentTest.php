<?php

namespace Tests\Unit;

use App\Models\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Models\Tag;
use Faker\Factory;

class CommentTest extends TestCase
{
    //use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {

        factory(User::class, 50)->create()->each(function ($user) {


            $faker = Factory::create();
            $word = $faker->word;

            $comment = factory(Comment::class)->make();
            $comment->user()->associate($user)->save();

            $tag = Tag::firstOrCreate(['name' => $word]);
            $comment->tags()->sync([$tag->id]);

        });

        $user = User::inRandomOrder()->first();
        $this->assertTrue($user->comments->count() > 0);
        $this->assertTrue($user->comments()->first()->tags->count() > 0);

    }
}
