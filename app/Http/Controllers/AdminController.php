<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Http\Requests\PostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Summary of save
     * @param array $data
     * @param \App\Models\Post|null $post
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function save(array $data, Post $post = null): RedirectResponse
    {
        if (isset($data['thumbnail'])) {
            if (isset($post->thumbnail)) {
                Storage::delete($post->thumbnail);
            }
            $data['thumbnail'] = $data['thumbnail']->store('thumbnails');
        }


        $data['excerpt'] = Str::limit($data['content'], 50);

        $post = Post::updateOrCreate(['id' => $post?->id], $data);
        $post->tags()->sync($data['tag_ids'] ?? null);

        return to_route('posts.show', ['post' => $post])
            ->with('status', $post->wasRecentlyCreated ? 'Félicitation, votre post a été bien publié !' :
                'Félicitation, votre post a été bien publié !');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request): RedirectResponse
    {
        return $this->save($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        return $this->save($request->validated(), $post);
    }


    protected function showForm(Post $post = new Post): View
    {
        return view(
            'admin.posts.form',
            [
                'post' => $post,
                'categories' => Category::orderBy('name')->get(),
                'tags' => Tag::orderBy('name')->get()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return $this->showForm();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        return $this->showForm($post);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view(
            'admin.posts.index',
            ['posts' => Post::without('category', 'tags')->latest()->paginate(10)]
        );
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse|Post
    {
        Storage::delete($post->thumbnail);

        $post->delete();

        return to_route('admin.posts.index')->with('status', 'Post supprimé avec success');
    }
}
