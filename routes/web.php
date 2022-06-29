<?php

use App\Http\Controllers\authLoginController;
use App\Http\Controllers\user\userController;
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
    return view('welcome');
});


###### AUTH ROUTES ######
Route :: get('login',[authLoginController :: class , 'login']);
Route :: post('DOLogin',[authLoginController :: class , 'doLogin']);
Route :: get('logout',[authLoginController :: class , 'Logout']);
#########################
// user routes
Route::resource('Users',userController::class);

/*
   /Users        (GET)       >>>   Route::get('Blogs',[blogController :: class , 'index']);
   /Users/create (GET)       >>>   Route::get('Blogs/create',[blogController :: class , 'create']);
   /Users        (POST)      >>>   Route::post('Blogs',[blogController :: class , 'store']);
   /Users/{id}   (GET)       >>>   Route::get('Blogs/{id}',[blogController :: class , 'show']);
   /Users/{id}/edit (GET)    >>>   Route::get('Blogs/{id}/edit',[blogController :: class , 'edit']);
   /Users/{id}   (PUT)       >>>   Route::put('Blogs/{id}',[blogController :: class , 'update']);
   /Users/{id}   (DELETE)    >>>   Route::delete('Blogs/{id}',[blogController :: class , 'destroy']);
*/
