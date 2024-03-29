<?php

use App\Http\Controllers\AuthCOntroller;
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
|--------------------------------------------------------------------------
|  AUthentification routes
|--------------------------------------------------------------------------
|
| Afficher la page login pour s'authentifier
|
 */

Route::get("/login", [AuthCOntroller::class, "loginForm"])->name("loginForm");
Route::post("/login", [AuthCOntroller::class, "connect"])->name("seConnecter");
Route::delete("/logout", [AuthCOntroller::class, "logout"])->name("logout");


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
    Route::get('/{post}/edit', 'edit')->name("edit")->middleware("auth");

    // update post
    Route::post('/{post}/edit', 'update')->middleware("auth");

    // create new post (get)
    Route::get("/new-post", "create")->name("create")->middleware("auth");

    // Create new post (post)
    Route::post("/new-post", "store");

    //Pivote Table Route
    Route::get("/analyse", 'generatePivotTable')->name('pivoteTable');

    //Filter by catégorie
    Route::get("/posts/posts-{value}-{relation}", "filter")->name("filter");
});
