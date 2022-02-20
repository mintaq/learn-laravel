<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\BlogPost;
use App\Models\User;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = BlogPost::all();
        $users = User::all();

        if ($posts->count() === 0) {
            $this->command->info('There are no blog posts, so no comments will be added');
            return;
        }

        $blogPostsCount = (int)$this->command->ask('How many comments would you like?', 1000);
        Comment::factory()->count($blogPostsCount)->make()->each(function ($comment) use ($posts, $users) {
            $comment->blog_post_id = $posts->random()->id;
            $comment->user_id = $users->random()->id;
            $comment->save();
        });
    }
}
