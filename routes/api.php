<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['prefix' => 'v1'], function () {

    Route::group(['middleware' => 'auth:api'], function () {
        //        Complete Registration as Customer
        Route::post('/customer/register', 'Auth\CRegisterCustomer@Complete_Register');

        //        Complete Registration as Freelancer
        Route::post('/freelancer/register', 'Auth\CRegisterFreelancer@Complete_Register');

        Route::post('logout', 'Auth\LoginController@logout');
        Route::get('/user', function (Request $request) {return $request->user();});
        Route::patch('settings/profile', 'Settings\ProfileController@update');
        Route::patch('settings/password', 'Settings\PasswordController@update');
    });

    Route::group(['middleware' => 'guest:api'], function () {
        Route::post('login', 'Auth\LoginController@login');
        Route::post('register', 'Auth\RegisterController@register');

        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    });


});
Route::fallback(function(){
    return response()->json([
        'message' => 'صفحه مورد نظر پیدا نشد. در صورت اطمینان از صحت اطلاعات با پشتیبانی تماس بگیرید'], 404);
});
