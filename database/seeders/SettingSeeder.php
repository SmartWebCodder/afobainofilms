<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_title' => 'Afobaino Films',
            'tagline' => 'Premium Wedding Cinematography & Photography',
            'contact_email' => 'hello@afobainofilms.com',
            'whatsapp_number' => '+1234567890',
            'phone_number' => '+1234567890',
            'instagram_url' => 'https://www.instagram.com/afobainofilms/',
            'youtube_url' => 'https://www.youtube.com/@afobainofilms646',
            'tiktok_url' => '',
            'facebook_url' => '',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }
    }
}
