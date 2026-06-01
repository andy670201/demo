<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->get();

        return response()->json($news);
    }

    public function show(string $slug)
    {
        $news = News::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return response()->json($news);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'summary' => 'nullable|string',
            'image' => 'nullable|string',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $data['slug'] = Str::slug($data['title']) . '-' . time();

        if ($data['is_published'] ?? false) {
            $data['published_at'] = $data['published_at'] ?? now();
        }

        $news = News::create($data);

        return response()->json($news, 201);
    }

    public function update(Request $request, string $id)
    {
        $news = News::findOrFail($id);

        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'summary' => 'nullable|string',
            'image' => 'nullable|string',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']) . '-' . time();
        }

        $news->update($data);

        return response()->json($news);
    }

    public function adminIndex()
    {
        $news = News::orderBy('created_at', 'desc')->get();

        return response()->json($news);
    }

    public function destroy(string $id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return response()->json(['message' => '已刪除']);
    }
}
