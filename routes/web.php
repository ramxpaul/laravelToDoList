<?php

use App\Http\Controllers\authLoginController;
use App\Http\Controllers\task\taskController;
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


// User Routes
Route::resource('Users',userController::class);

/*
   /Users        (GET)       >>>   Route::get('Users',[blogController :: class , 'index']);
   /Users/create (GET)       >>>   Route::get('Users/create',[blogController :: class , 'create']);
   /Users        (POST)      >>>   Route::post('Users',[blogController :: class , 'store']);
   /Users/{id}   (GET)       >>>   Route::get('Users/{id}',[blogController :: class , 'show']);
   /Users/{id}/edit (GET)    >>>   Route::get('Users/{id}/edit',[blogController :: class , 'edit']);
   /Users/{id}   (PUT)       >>>   Route::put('Users/{id}',[blogController :: class , 'update']);
   /Users/{id}   (DELETE)    >>>   Route::delete('Users/{id}',[blogController :: class , 'destroy']);
*/


######## Task Routes ###########
Route::get('Tasks',[taskController :: class , 'index']);
Route::get('Tasks/create',[taskController :: class , 'create']);
Route::post('Tasks',[taskController :: class , 'store']);
Route::get('Tasks/{id}',[taskController :: class , 'show']);
Route::get('Tasks/{id}/edit',[taskController :: class , 'edit']);
Route::put('Tasks/{id}',[taskController :: class , 'update']);
Route::delete('Tasks/{id}',[taskController :: class , 'destroy'])->middleware('dateCheck');
#############################################################################################

// Route::resource('Tasks',taskController::class);
/*
   /Tasks        (GET)       >>>   Route::get('Tasks',[blogController :: class , 'index']);
   /Tasks/create (GET)       >>>   Route::get('Tasks/create',[blogController :: class , 'create']);
   /Tasks        (POST)      >>>   Route::post('Tasks',[blogController :: class , 'store']);
   /Tasks/{id}   (GET)       >>>   Route::get('Tasks/{id}',[blogController :: class , 'show']);
   /Tasks/{id}/edit (GET)    >>>   Route::get('Tasks/{id}/edit',[blogController :: class , 'edit']);
   /Tasks/{id}   (PUT)       >>>   Route::put('Tasks/{id}',[blogController :: class , 'update']);
   /Tasks/{id}   (DELETE)    >>>   Route::delete('Tasks/{id}',[blogController :: class , 'destroy']);
*/
