<?php

use Illuminate\Support\Facades\Route;
use \App\Models\SubCategory;
use \Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\Blog;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;

//use \Symfony\Component\Console\Input\Input;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::get('sub', [SubcategoryController::class, 'index'])->name('sub');
/*
|--------------------------------------------------------------------------
| Web Routes
|
*/

//todo------------------------------Front END---------------------------------------------------------------------
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('blog/posts/{post}', [Blog\PostsController::class, 'show'])->name('blog.show');
Route::get('blog/category/{category}', [Blog\PostsController::class, 'category'])->name('blog.category');
Route::get('blog/tag/{tag}', [Blog\PostsController::class, 'tag'])->name('blog.tag');


//------------------------------Back END---------------------------------------------------------------------
Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

//-------------------------------Category--------------------------------------------------------------------
    Route::resource('categories', CategoriesController::class);

//-------------------------------SubCategory-----------------------------------------------------------------
    Route::resource('subcategories', SubcategoryController::class);

//----------------------------------- Json Data For Category and District------------------------------------------
    Route::get('get/subcategory/{category_id}',[PostsController::class,'getsubcategory']);
    //-------------------------------POSTS-----------------------------------------------------------------------
    Route::resource('posts', PostsController::class);
    Route::get('/trashed-posts', [PostsController::class, 'trashed'])->name('trashed-post.index');
    Route::put('/restore-posts/{id}', [PostsController::class, 'restore'])->name('restore-post');
//-------------------------------TAGS------------------------------------------------------------------------
    Route::resource('tags', TagController::class);
});


//-----------------------------------ADMIN USER------------------------------------------------------------------
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/profile', [UserController::class, 'edit'])->name('user.edit-profile');
    Route::put('/users/profile', [UserController::class, 'update'])->name('user.update-profile');
    Route::post('users/{user}/make-admin', [UserController::class, 'makeAdmin'])->name('users.make-admin');
});

