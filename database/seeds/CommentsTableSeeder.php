<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i<=5; $i++){
            DB::table('comments')->insert([
                'post_id' => $i,
                'author' => 'aaron',
                'text' => 'comment voor post' . $i . '.',
                'title' => 'comment',
                'created_at' => now(),
            ]);
        }

        factory(App\Comment::class, 300)->create();

    }
}
