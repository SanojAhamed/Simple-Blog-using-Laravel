<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;

class PostController extends Controller
{
    public function index(): Response
    {
        return response()->view('posts.index', [
            'posts' => Post::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    public function create(): Response
    {
        return response()->view('posts.form');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('featured_image')) {
            // Ensure the directory exists
            Storage::disk('public')->makeDirectory('images/posts/featured-images');

            $filePath = Storage::disk('public')->put('images/posts/featured-images', $request->file('featured_image'));
            $validated['featured_image'] = $filePath;
        }

        $create = Post::create($validated);

        if ($create) {
            session()->flash('notif.success', 'Post created successfully!');
            return redirect()->route('posts.index');
        }

        return abort(500);
    }

    public function show(string $id): Response
    {
        return response()->view('posts.show', [
            'post' => Post::findOrFail($id),
        ]);
    }

    public function edit(string $id): Response
    {
        return response()->view('posts.form', [
            'post' => Post::findOrFail($id),
        ]);
    }

    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        $post = Post::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('featured_image')) {
            Storage::disk('public')->delete($post->featured_image);

            $filePath = Storage::disk('public')->put('images/posts/featured-images', $request->file('featured_image'));
            $validated['featured_image'] = $filePath;
        }

        $update = $post->update($validated);

        if ($update) {
            session()->flash('notif.success', 'Post updated successfully!');
            return redirect()->route('posts.index');
        }

        return abort(500);
    }

    public function destroy(string $id): RedirectResponse
    {
        $post = Post::findOrFail($id);

        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $delete = $post->delete();

        if ($delete) {
            session()->flash('notif.success', 'Post deleted successfully!');
            return redirect()->route('posts.index');
        }

        return abort(500);
    }
}
