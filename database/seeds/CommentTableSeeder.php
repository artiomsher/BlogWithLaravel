<?php

use Illuminate\Database\Seeder;
use App\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$u = new Comment;
        $u->content = "John content";
        $u->user_id = '1';
        $u->post_id = '1';
        $u->save();
        factory(Comment::class, 5)->create();
    }
}
