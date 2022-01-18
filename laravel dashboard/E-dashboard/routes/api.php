<?php
use App\Http\Controllers\apis\ProductController;
use App\Http\Controllers\apis\AuthController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix'=>'products'],function(){
    Route::get('index',[ProductController::class,'index']);
    Route::get('create',[ProductController::class,'create']);
    Route::get('edit/{id}',[ProductController::class,'edit']);
    Route::post('store',[ProductController::class,'store']);
    Route::post('update',[ProductController::class,'update']);
    Route::post('delete/{id}',[ProductController::class,'destroy']);
});

Route::group(['prefix'=>'users'],function(){
    Route::post('login',[AuthController::class,'login']);
    Route::post('register',[AuthController::class,'register']);
    Route::post('send-code',[AuthController::class,'sendCode']);
    Route::post('verify-code',[AuthController::class,'verifyCode']);
    Route::get('profile',[AuthController::class,'profile']);
    Route::post('send-code-forget',[AuthController::class,'sendCodeForget']);
    Route::post('verify-code-forget',[AuthController::class,'verifyCodeForget']);
    Route::post('set-new-password',[AuthController::class,'setNewPassword']);
    Route::post('logout',[AuthController::class,'logout']);
    
});

