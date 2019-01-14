<?php

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

Route::get('/', 'WelcomeController@index');

Route::get('auth/login', function () {
    $credentials = [
        'email' => 'endryu@test.com',
        'password' => 'password'
    ];

    if (! auth()->attempt($credentials)) {
        return '로그인 정보가 정확하지 않았습니다.';
    }

    return redirect('protected');
});


Route::get('protected',['middleware' => 'auth', function () {
    dump(session()->all());

    return '어서오세요' .auth()->user()->name;
}]);


Route::get('auth/logout', function () {
    auth()->logout();

    return '또 봐요~';
});



Route::resource('articles', 'ArticlesController');

Route::resource('articles/create', 'ArticlesController');



Route::get('password/reset', 'Auth\ForgotPasswordController@sendLinkRequestForm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

DB::listen(function ($query){
    dump($query -> sql);
});
