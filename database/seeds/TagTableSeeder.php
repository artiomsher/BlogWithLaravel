<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$t = new Tag;
        $t->title = "Laravel";
        $t->save();
        $t->posts()->attach(1);
        $t->posts()->attach(6);*/ 
        // commented to prevent duplications for mass seedings

		factory(App\Tag::class,20)->create();
        // attach tags to posts randomly (30% chance)
        foreach(App\Post::all() as $post) {
        	foreach (App\Tag::all() as $tag) {
        			if(rand(1,100)>70) {
        				$post->tags()->attach($tag->id);
        			}
        	}
        	$post->save();
        }
    }
}
