<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new Post;
        $a->content="Some Content";
        $a->title="Some title";
        $a->user_id='1';
        $a->save();

        factory(Post::class, 5)->create();

    }
}
