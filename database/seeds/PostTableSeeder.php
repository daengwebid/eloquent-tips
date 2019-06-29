<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create()->each(function ($user) {
            $post = $user->product()->save(factory(App\Product::class)->make());
            factory(App\Comment::class, 10)->create(['user_id' => $user->id, 'product_id' => $post->id]);
        });
    }
}
