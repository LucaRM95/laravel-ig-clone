<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//use App\Models\Image;

/*
    $images = Image::all();
    foreach($images as $image){
        echo $image->image_path.'<br>';
        echo $image->description.'<br>';
        echo $image->user->name.' '.$image->user->surname.'<br>';

        if(count($image->comments) >= 1){
            echo "<h4>Comentarios</h4>"; 
            foreach($image->comments as $comment){
                echo $comment->user->name.' '.$comment->user->surname.': ';
                echo $comment->content.'<br>'; 
            }
        }

        echo 'LIKES: '.count($image->likes);
        echo '<hr>';
    } 
    die();
*/

Route::get('/', function(){
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/search', [App\Http\Controllers\UserController::class, 'search_view'])->name('search_view');
Route::post('/search/user', [App\Http\Controllers\UserController::class, 'search'])->name('search');

Route::get('/user/configuracion', [App\Http\Controllers\UserController::class, 'config'])->name('config');
Route::get('/user/avatar/{filename}', [App\Http\Controllers\UserController::class, 'getImage'])->name('avatar');
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('update');
Route::get('/user/profile/{id}', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');

Route::get('/create-post', [App\Http\Controllers\ImageController::class, 'create'])->name('create');
Route::get('/image/delete/{id}', [App\Http\Controllers\ImageController::class, 'delete'])->name('delete_image');
Route::get('/image/edit/{id}', [App\Http\Controllers\ImageController::class, 'edit'])->name('edit');
Route::post('/image/update', [App\Http\Controllers\ImageController::class, 'update'])->name('update');
Route::get('/image/explore', [App\Http\Controllers\ImageController::class, 'explore'])->name('explore');

Route::get('/image/file/{filename}', [App\Http\Controllers\ImageController::class, 'getImage'])->name('image');
Route::get('/image/{id}', [App\Http\Controllers\ImageController::class, 'detail'])->name('detail');
Route::post('/image/save', [App\Http\Controllers\ImageController::class, 'upload'])->name('upload');

Route::post('/comment/save', [App\Http\Controllers\CommentController::class, 'save'])->name('save');
Route::get('/comment/delete/{id}', [App\Http\Controllers\CommentController::class, 'delete'])->name('delete');

Route::get('/like/{image_id}', [App\Http\Controllers\LikeController::class, 'like'])->name('like');
Route::get('/dislike/{image_id}', [App\Http\Controllers\LikeController::class, 'dislike'])->name('dislike');
Route::get('/likes', [App\Http\Controllers\LikeController::class, 'index'])->name('likes');

// Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('update');

// Route::group(['prefix' => 'frutas'], function() {
    
// });
