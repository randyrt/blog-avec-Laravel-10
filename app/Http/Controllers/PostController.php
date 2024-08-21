<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;
use App\Http\Requests\SearchFormRequest;

class PostController extends Controller
{

    /**
     * Summary of postsView
     * @param array $filters
     * @return \Illuminate\View\View
     */
    protected function postsView(array $filters): View
    {
        return view('posts.index', ['posts' => Post::filters($filters)->latest()->paginate(10)]);
    }


    /**
     * Summary of index
     * @param \App\Http\Requests\SearchFormRequest $request
     * @return \Illuminate\View\View
     */
    public function index(SearchFormRequest $request): View
    {
        return $this->postsView($request->search ? ['search' => $request->search] : []);
    }


    /**
     * Summary of postByCategory
     * @param \App\Models\Category $category
     * @return \Illuminate\View\View
     */
    public function postByCategory(Category $category): View
    {
        return $this->postsView(['category' => $category]);
    }

    /**
     * Summary of postBytag
     * @param \App\Models\Tag $tag
     * @return \Illuminate\View\View
     */
    public function postBytag(Tag $tag): View
    {
        return $this->postsView(['tag' => $tag]);
    }

    /**
     * Summary of show
     * @param \App\Models\Post $post
     * @return \Illuminate\View\View
     */
    public function show(Post $post): View
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }
}



