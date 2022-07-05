<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->namespace('API\V1')->group(function () {
    /*
    |--------------------------------------------------------------------------
    |************************* Before Authentication Route *********************
    |--------------------------------------------------------------------------
    */
    Route::post('auth/signup', [App\Http\Controllers\API\V1\Auth\AuthController::class, 'signup']);
    Route::post('auth/signin', 'Auth\AuthController@signin');
    Route::post('auth/social', 'Auth\AuthController@social');

    /*
      |--------------------------------------------------------------------------
      |************************* Forgot password  ******************************
      |--------------------------------------------------------------------------
     */
    // Route::post('auth/forgot-password', [App\Http\Controllers\API\V1\Auth\ForgotPasswordController::class, 'sendResetLink']);
    // Route::post('auth/reset-password', [App\Http\Controllers\API\V1\Auth\ForgotPasswordController::class, 'resetPassword']);
    // Route::post('auth/resend-link',  [App\Http\Controllers\API\V1\Auth\ForgotPasswordController::class, 'resetPassword']);

    /*
    |--------------------------------------------------------------------------
    |************************* After Authentication Route *********************
    |--------------------------------------------------------------------------
    */

    // Route::middleware(['auth:api', 'verified'])->group(function () {
    //     Route::delete('auth/signout', 'Auth\AuthController@signOut');
    //     Route::get('profile', [App\Http\Controllers\API\V1\Profile\ProfileController::class, 'index']);
    //     Route::post('profile/update', [App\Http\Controllers\API\V1\Profile\ProfileController::class, 'update']);
    //     Route::put('auth/change-password', [App\Http\Controllers\API\V1\Auth\AuthController::class, 'passwordChange']);
    //     Route::post('profile/switch-type', [App\Http\Controllers\API\V1\Profile\ProfileController::class, 'switchUserProfile']);
    // });
});
