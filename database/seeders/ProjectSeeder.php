<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title'        => 'Showreel One',
                'slug'         => 'showreel-one',
                'category'     => 'Showreel',
                'description'  => 'A curated collection of our finest cinematic moments — emotion, light, and movement woven into one.',
                'cover_image'  => 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776457599/afobaino-films/portfolio/showreel-one-thumb.jpg',
                'video_url'    => 'https://res.cloudinary.com/dtetfimeq/video/upload/v1776457300/afobaino-films/portfolio/showreel-one.mp4',
                'is_featured'  => true,
                'is_published' => true,
                'sort_order'   => 1,
            ],
            [
                'title'        => 'Showreel Two',
                'slug'         => 'showreel-two',
                'category'     => 'Showreel',
                'description'  => 'Our second volume — more stories, more soul. Every frame a feeling.',
                'cover_image'  => 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776457657/afobaino-films/portfolio/showreel-two-thumb.jpg',
                'video_url'    => 'https://res.cloudinary.com/dtetfimeq/video/upload/afobaino-films/portfolio/showreel-two.mp4',
                'is_featured'  => true,
                'is_published' => true,
                'sort_order'   => 2,
            ],
            [
                'title'        => 'Monika & Loric',
                'slug'         => 'monika-and-loric',
                'category'     => 'Weddings',
                'description'  => 'An intimate celebration of love — Monika & Loric\'s timeless wedding film.',
                'cover_image'  => 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776457693/afobaino-films/portfolio/monika-loric-thumb.jpg',
                'video_url'    => 'https://res.cloudinary.com/dtetfimeq/video/upload/v1776457388/afobaino-films/portfolio/monika-loric.mp4',
                'is_featured'  => true,
                'is_published' => true,
                'sort_order'   => 3,
            ],
        ];

        foreach ($projects as $data) {
            Project::updateOrCreate(
                ['slug' => $data['slug']],
                $data,
            );
        }
    }
}
