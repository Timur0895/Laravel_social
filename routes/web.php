<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UpdateProfileController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
  if (Auth::user()) {
    Auth::user()->update([
      'active_status' => true
    ]);
  };

  $users = User::all();
  $posts = Post::notReply();

  return view('home')->with([
    'users' => $users,
    'posts' => $posts
  ]);
});

Route::post('/', [HomeController::class, "logout"])->middleware('auth')->name("Logout");

Route::get("/news", [NewsController::class, "index"])->middleware('auth')->name("news");
Route::get("/news/{category}/", [NewsController::class, "getCategory"])->middleware('auth')->name("getCategory");
Route::get("/search", [SearchController::class, "getSearch"])->middleware('auth')->name("getSearch");


Route::get("/friends", [FriendsController::class, "index"])->middleware('auth')->name("friends");
Route::get("/friends/add/{usermail}", [FriendsController::class, "getAdd"])->middleware('auth')->name("addFriend");
Route::get("/friends/accept/{usermail}", [FriendsController::class, "getAccept"])->middleware('auth')->name("acceptFriend");
Route::post("/friends/delete/{usermail}", [FriendsController::class, "postDelete"])->middleware('auth')->name("deleteFriend");
Route::get('/friend/{usermail}', [FriendsController::class, 'getProfile'])->middleware('auth')->name('getProfile');


Route::get("/chatify", [ChatController::class, "index"])->middleware('auth')->name("chatify");
Route::get("/chat/{id}", [ChatController::class, "chatProfile"])->middleware('auth')->name("chatProfile");
Route::post("/chat/{id}/send", [ChatController::class, "sendMessage"])->middleware('auth')->name("sendMessage");
Route::post("/chat/{id}/favorite", [ChatController::class, "makeFavorite"])->middleware('auth')->name('makeFavorite');
Route::post("/chat/deleted/dialog/{id}/", [ChatController::class, "deletedialog"])->middleware('auth')->name('deleteDialog');


Route::resource("/profile", ProfileController::class)->middleware('auth');
Route::get('/update', [UpdateProfileController::class, 'profile'])->name('editProfile')->middleware('auth');
Route::post('/update', [UpdateProfileController::class, 'update'])->name('updateProfile')->middleware('auth');


Route::post('/status/{statusId}/reply', [StatusController::class, 'postReply'])->name('postReply')->middleware('auth');
Route::post('/status/delete/{statusId}/reply', [StatusController::class, 'deleteReply'])->name('deleteReply')->middleware('auth');

Route::get('/status/{statusId}/like', [StatusController::class, 'getLike'])->name('getLike')->middleware('auth');
Route::post('/status/{statusId}/like', [StatusController::class, 'deleteLike'])->name('deleteLike')->middleware('auth');
Route::post('/readed/{id}', [StatusController::class, 'readNotify'])->name('readNotify')->middleware('auth');

Route::post('/color', [ColorController::class, 'setColor'])->name('setColor')->middleware('auth');
Route::post('/text', [ColorController::class, 'textColor'])->name('textColor')->middleware('auth');


Auth::routes();


Route::get('/admin', [IndexController::class, 'index']);
Route::post('/admin', [IndexController::class, 'login'])->name('loginAdmin');
Route::get('/admin/dashboard', [IndexController::class, 'dashboard'])->name('dashboard');
Route::get('/admin/dashboard/user-{id}/', [IndexController::class, 'getUser'])->name('getUser');





Route::get('/admin/categories', [CategoriesController::class, 'index'])->name('adminCategories');
Route::post('/admin/categories', [CategoriesController::class, 'addCategory'])->name('addCategory');
Route::post('/admin/categories/update-{id}/', [CategoriesController::class, 'updateCategory'])->name('updateCategory');
Route::post('/admin/categories/{slug}/', [CategoriesController::class, 'deleteCategory'])->name('deleteCategory');
Route::get('/admin/categories/{id}/', [CategoriesController::class, 'editCategory'])->name('editCategory');

