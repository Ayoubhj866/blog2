<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/**
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});




/**
 |
 |
 ||--------------------------------------------------------------------------
 | POST ROUTES
 ||--------------------------------------------------------------------------
 |
 */
Route::prefix("/blog")->controller(PostController::class)->name("blog.")->group(function () {

    // list of posts
    Route::get("/", "index")->name("index");

    //show post
    Route::get('/{slug}-{post}', "show")->where(['slug' => '[a-z0-9\-]+', 'post' => '[0-9]+',])->name("show");

    // edite post
    Route::get('/{post}/edit', 'edit')->name("edit");

    // update post
    Route::post('/{post}/edit', 'update');

    // create new post (get)
    Route::get("/new-post", "create")->name("create");

    // Create new post (post)
    Route::post("/new-post", "store");

    //Pivote Table Route
    Route::get("/analyse", 'generatePivotTable')->name('pivoteTable');

    //Filter by catégorie
    Route::get("/posts/posts-{value}-{relation}", "filter")->name("filter");
});
