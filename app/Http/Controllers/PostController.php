<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostValidation;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as RequestCl;
use Illuminate\View\View;

class PostController extends Controller
{


    /**
     * Undocumented function
     *
     * @return void
     */
    public function index(): View | RedirectResponse
    {
        return \view("blog.index", ["posts" => Post::paginate(3)]);
    }




    /**
     * Afficher un post
     *
     * @param string $slug
     * @param Post $post
     * @return void
     */
    public function show(string $slug, Post $post)
    {
        return \view("blog.show", ["post" => $post]);
    }



    /**
     * Editer un poste
     *
     * @param Post $post
     * @return void
     */
    public function edit(Post $post): view
    {
        return \view("blog.edit", ['post' => $post]);
    }



    /**
     * Create new post form
     *
     * @return view
     */
    public function create(): view
    {
        return \view("blog.create",  ["post" => new Post()]);
    }


    /**
     *  Ajouter dans la base de donnée le nouvelle post
     *
     * @param StorePostValidation $request
     * @return void
     */
    public function store(StorePostValidation $request)
    {

        $post = Post::create($request->validated());

        return \redirect()->route("blog.show", ["slug" => $post->slug, "post" => $post->id])->with("success", "Post was created successfuly");
    }
}
