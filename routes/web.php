<?php

use App\Actions\Tingg\GetToken;
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

Route::get('/', fn () => view('welcome'));
Route::get('/dashboard', fn() => view('dashboard'))->middleware(['auth'])->name('dashboard');

Route::get('/payments/authorize', function(GetToken $getToken){

    $data = $getToken->execute([
        'url' => config('services.tingg.url') . 'oauth/token/request',
        'client_id' => config('services.tingg.client_id'),
        'client_secret' => config('services.tingg.client_secret'),
        'grant_type' => 'client_credentials'
    ]);

    return response()->json($data);

});

require __DIR__.'/auth.php';
