<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogPostCommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\BlogPostTagController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'home'])->name('home.index')
    // ->middleware('auth')
;
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/secret', [HomeController::class, 'secret'])->name('home.secret')->middleware('can:home.secret');

Route::get('/about', AboutController::class);

Route::resource('posts', BlogPostController::class);
Route::get('/posts/tag/{id}', [BlogPostTagController::class, 'index'])->name('posts.tags.index');

Route::resource('posts.comments', BlogPostCommentController::class)->only(['store']);
Route::resource('users.comments', UserCommentController::class)->only(['store']);
Route::resource('users', UserController::class)->only(['show', 'edit', 'update']);

Auth::routes();

// Route::resource('/posts', PostController::class);


// Route::get('/posts', function () use ($posts) {
//     // dd(request()->all());
//     dd((int)request()->query('page', 1));
//     return view('posts.index', ['posts' => $posts]);
// });

// Route::get('/posts/{id}', function ($id) use ($posts) {


//     abort_if(!isset($posts[$id]), 404);

//     return view('posts.show', ['post' => $posts[$id]]);
// })->name('posts.show');

$posts = [
    1 => [
        'title' => 'Intro to Laravel',
        'content' => 'This is a short intro to PHP',
        'is_new' => true
    ],
    2 => [
        'title' => 'Intro to Laravel',
        'content' => 'This is a short intro to PHP',
        'is_new' => false
    ]
];

Route::get('/recent-posts/{days_ago?}', function ($days_ago = 20) {
    return 'Posts from ' . $days_ago . " days ago";
})->name('posts.recent.index');

Route::prefix('/fun')->name('fun.')->group(function () use ($posts) {
    Route::get('/responses', function () use ($posts) {
        return response($posts, 201)
            ->header('Content-Type', 'application/json')
            ->cookie('MY_COOKIE', 'Minh Tran', 3600);
    })->name('responses');

    Route::get('/redirect', function () {
        return redirect('/contact');
    })->name('redirect');

    Route::get('/back', function () {
        return back();
    })->name('back');

    Route::get('/named-route', function () {
        return redirect()->route('posts.show', ['id' => 1]);
    })->name('named-route');

    Route::get('/away', function () {
        return redirect()->away('https://google.com');
    })->name('away');

    Route::get('/json', function () use ($posts) {
        return response()->json($posts);
    })->name('json');

    Route::get('/download', function () use ($posts) {
        return response()->download(public_path('/favicon.ico'), 'test.ico');
    })->name('download');
});
