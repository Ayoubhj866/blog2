<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostValidation;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as RequestCl;
use Illuminate\Support\Facades\DB;
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
        return \view("blog.index", ["posts" => Post::with("Category", "tags")->paginate(3)]);
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
     * Afficher la formulaire d'édition, et la remplire par les donnée du post à éditer
     *
     * @param Post $post
     * @return void
     */
    public function edit(Post $post): view
    {
        return \view("blog.edit", [
            'post' => $post, // le post à éditer
            'categories' => Category::select('id', 'name')->get(), //liste des catégories pour select
            'tags' => Tag::select('id', 'name')->get(),
        ]);
    }





    /**
     * Modifier les infos dans la base de données
     *
     * @param Post $post
     * @param StorePostValidation $request
     * @return void
     */
    public function update(Post $post, StorePostValidation $request)
    {

        $post->update($request->validated());
        $post->tags()->sync($request->tags); // associer les tags à la post

        return \redirect()->route("blog.show", ["slug" => $post->slug, "post" => $post->id])->with("success", "Post updated succesfully");
    }





    /**
     * Create new post form
     *
     * @return view
     */
    public function create(): view
    {
        return \view("blog.create",  [
            "post" => new Post(),
            "categories" => Category::select("id", "name")->get(),
            "tags" => Tag::select('id', 'name')->get()
        ]);
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
        $post->tags()->sync($request->tags);

        return \redirect()->route("blog.show", ["slug" => $post->slug, "post" => $post->id])->with("success", "Post was created successfuly");
    }




    /**
     * Afficher une table croisé dynamique
     *
     * @return View
     */
    public function generatePivotTable(): View
    {
        // Récupérer les données de la table pivot
        $pivotData = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->select('categories.name as category', DB::raw('count(posts.id) as post_count'))
            ->groupBy('categories.name')
            ->get();

        // Transformer les données pour les rendre utilisables dans la vue
        $tableData = [];
        foreach ($pivotData as $data) {
            $tableData[$data->category] = $data->post_count;
        }

        return view('blog.pivoteTable', ['tableData' => $tableData]);
    }
}
