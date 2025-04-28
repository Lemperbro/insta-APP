<?php

namespace Database\Seeders;

use App\Models\Auth\User;
use App\Models\Content\Post;
use Illuminate\Database\Seeder;
use App\Models\Content\PostLike;

use App\Models\Content\PostImage;
use App\Models\Content\PostComment;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $images = [
            '2025/04/post/5uoept2cq5n36il6zru10yv6ia3uv00gf4t7oxwdsw215gcrpo0ovyao.webp',
            '2025/04/post/mt8i8pk10sa2lu9s3ekbh0eycncmz6hc2y8ip9ujhw36z37l7cpkte.webp',
            '2025/04/post/r6csufrlyqtvgayyr664vt3sgn32vwkr835ke4lv0p4qettziph59529o.webp',
            '2025/04/post/r609itc8y5impg2f7z6bscwcufsgfrq6kdoz4tx1l32m627zvrl54lqqdqu76z.webp',
            '2025/04/post/zlakbi5f10l38hr7esldvwj9tlb35xibcp66h1da10e62qo3rowwg6j10p.webp',
        ];


        for ($i = 0; $i < 20; $i++) {
            $user = User::inRandomOrder()->first();

            $post = Post::create([
                'title' => fake()->sentence(),
                'content' => fake()->paragraph(),
                'userable_type' => User::class,
                'userable_id' => $user->id,
            ]);


            
            $imageCount = rand(1, 3);
            $selectedImages = array_rand($images, $imageCount);
        
            if (!is_array($selectedImages)) {
                $selectedImages = [$selectedImages];
            }
            
            foreach ($selectedImages as $imageIndex) {
                PostImage::create([
                    'image' => $images[$imageIndex],
                    'postable_type' => Post::class,
                    'postable_id' => $post->id
                ]);
            }


            $likeCount = rand(5, 15);
            $likeUsers = User::inRandomOrder()->limit($likeCount)->get();

            foreach ($likeUsers as $likeUser) {
                PostLike::create([
                    'postable_type' => Post::class,
                    'postable_id' => $post->id,
                    'user_id' => $likeUser->id
                ]);
            }

            $commentCount = rand(3, 8);
            $commentUsers = User::inRandomOrder()->limit($commentCount)->get();

            foreach ($commentUsers as $commentUser) {
                PostComment::create([
                    'content' => fake()->sentence(),
                    'postable_type' => Post::class,
                    'postable_id' => $post->id,
                    'user_id' => $commentUser->id
                ]);
            }
        }
    }
}
