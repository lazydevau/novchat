<?php

use App\Http\Controllers\FeedsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavedSearch;
use App\Http\Controllers\Search;
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

Route::get('/js', function () {
    return view('js');
});
Route::get('/', [FeedsController::class, 'index'])->name('feeds.index');
Route::get('/feeds/{id}', [FeedsController::class, 'show'])->name('feeds.show');
Route::get('/search', [FeedsController::class, 'search'])->name('feeds.search');
Route::post('/search/save', [Search::class, 'save'])->name('search.save');
Route::get('/saved-searches', [SavedSearch::class, 'index'])->name('saved-searches.index');
//Route::get('/notifications', [Notification::class, 'save']'NotificationController@index')->name('notifications.index');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
