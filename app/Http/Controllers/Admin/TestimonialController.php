<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('sort_order')
            ->latest()
            ->paginate(15);

        return Inertia::render('Admin/Testimonials/Index', [
            'testimonials' => $testimonials,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Testimonials/Form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_name' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'quote' => ['required', 'string'],
            'sort_order' => ['integer'],
            'is_active' => ['boolean'],
        ]);

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created.');
    }

    public function edit(Testimonial $testimonial)
    {
        return Inertia::render('Admin/Testimonials/Form', [
            'testimonial' => $testimonial,
        ]);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'client_name' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'quote' => ['required', 'string'],
            'sort_order' => ['integer'],
            'is_active' => ['boolean'],
        ]);

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted.');
    }
}
