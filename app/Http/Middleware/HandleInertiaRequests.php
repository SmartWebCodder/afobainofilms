<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'ziggy' => fn() => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'auth' => fn() => [
                'user' => $request->user()?->only('id', 'name', 'email'),
            ],
            'flash' => fn() => [
                'success' => $request->session()->get('success'),
            ],
            'booking' => fn() => [
                'whatsapp_number' => Setting::get('whatsapp_number', ''),
                'phone_number' => Setting::get('phone_number', ''),
                'contact_email' => Setting::get('contact_email', ''),
            ],
            'socials' => fn() => [
                'instagram_url' => Setting::get('instagram_url', ''),
                'youtube_url' => Setting::get('youtube_url', ''),
                'tiktok_url' => Setting::get('tiktok_url', ''),
                'facebook_url' => Setting::get('facebook_url', ''),
            ],
        ];
    }
}
