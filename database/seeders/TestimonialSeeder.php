<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'Isabella & Julian',
                'location' => 'Lake Como, September 2023',
                'quote' => 'Working with Afobaino was unlike any experience we have had. He did not just record our wedding; he captured the soul of the day. Watching our film feels like reliving our favorite dream over and over again.',
                'sort_order' => 1,
            ],
            [
                'client_name' => 'Adaeze & Chukwuemeka',
                'location' => 'Lagos, December 2024',
                'quote' => 'Every frame told a story we did not even know existed. Afobaino saw beauty in the smallest moments — a glance, a whisper, a tear. Our wedding film is a masterpiece we will treasure forever.',
                'sort_order' => 2,
            ],
            [
                'client_name' => 'Sarah & Marcus',
                'location' => 'Santorini, June 2024',
                'quote' => 'From our first conversation, we knew Afobaino understood our vision. The final film exceeded every expectation — cinematic, emotional, and breathtakingly beautiful.',
                'sort_order' => 3,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::create(array_merge($t, ['is_active' => true]));
        }
    }
}
