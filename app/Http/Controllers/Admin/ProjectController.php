<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::query()
            ->when($request->search, fn($q, $s) => $q->where('title', 'like', "%{$s}%"))
            ->when($request->category, fn($q, $c) => $q->where('category', $c))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return Inertia::render('Admin/Projects/Index', [
            'projects' => $projects,
            'filters' => $request->only(['search', 'category']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Projects/Form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'string'],
            'gallery' => ['nullable', 'array'],
            'youtube_url' => ['nullable', 'url'],
            'tags' => ['nullable', 'array'],
            'is_featured' => ['boolean'],
            'is_published' => ['boolean'],
        ]);

        $data['slug'] = Str::slug($data['title']);

        $existing = Project::where('slug', $data['slug'])->exists();
        if ($existing) {
            $data['slug'] .= '-' . Str::random(4);
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created.');
    }

    public function edit(Project $project)
    {
        return Inertia::render('Admin/Projects/Form', [
            'project' => $project,
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'string'],
            'gallery' => ['nullable', 'array'],
            'youtube_url' => ['nullable', 'url'],
            'tags' => ['nullable', 'array'],
            'is_featured' => ['boolean'],
            'is_published' => ['boolean'],
        ]);

        $project->update($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted.');
    }
}
