<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\User;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class PostTableSeeder extends Seeder {

    public function run()
    {
        // for($i=0;$i<20;$i++) {
        //     $post = Post::create([
        //         'title' => 'タイトル', 
        //         'body' => '本文',
        //         'user_id' => User::inRandomOrder()->first()['id'],
        //     ]);
        // }
        factory(App\Post::class, 20)->create();
        
    }

}
