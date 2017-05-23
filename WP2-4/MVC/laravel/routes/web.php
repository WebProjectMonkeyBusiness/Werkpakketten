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

//Route::get('/', 'PostController@getIndex')->name('blog.index');
//twee manieren om te declareren

//om te runnen un cmd php artisan serve en dan de sever neme


Route::get('/', [
    'uses' => 'PostController@getIndex',
    'as' => 'blog.index'
]);


Route::get('post/{id}', [
    'uses' => 'PostController@getPost',
    'as'=> 'blog.post']);


Route::get('post/{id}/like', [
    'uses' => 'PostController@getLikePost',
    'as'=> 'blog.post.like']);


Route::get('about', function () {
    return view('other.about');
})->name('other.about');


Route::group(['prefix' => 'admin'], function() {
    Route::get('', [
        'uses' => 'PostController@getAdminIndex',
        'as' => 'admin.index'
    ]);

    Route::get('create', [
        'uses' => 'PostController@getAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::post('create', [
        'uses' => 'PostController@postAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::get('edit/{id}', [
        'uses' => 'PostController@getAdminEdit',
        'as' => 'admin.edit'
    ]);

    Route::get('delete/{id}',[
       'uses' => 'PostController@getAdminDelete',
        'as' => 'admin.delete'
    ]);

    Route::post('edit', [
        'uses' => 'PostController@postAdminUpdate',
        'as' => 'admin.update'
    ]);
});



/*Route::group(['prefix' => 'admin'], function() {
    //anders moet je in die get('') telkens nog admin. ervoor zetten
    Route::get('', function () {
        return view('admin.index');
    })->name('admin.index');

    Route::get('create', function () {
        return view('admin.create');
    })->name('admin.create');

    Route::post('create', function(\Illuminate\Http\Request $request,
    \Illuminate\Contracts\Validation\Factory $validator) {

       if($validation->fails()){
           return redirect()->back()->withErrors($validation);
       }
        return redirect()->route('admin.index')->with('info', 'Post created, Title: ' . $request->input('title'));
    })->name('admin.create');

    Route::get('edit/{id}', function ($id) {
        if($id == 1){
            $post = [
                'title' => 'Learning Laravel',
                'content' => 'This blog post will get you right on tracck with Laravel'
            ];
        } else{
            $post=[
                'title' => 'Something else',
                'content' => 'some other content'
            ];
        }

        return view('admin.edit');
    })->name('admin.edit');

    Route::post('edit', function(\Illuminate\Http\Request $request, \Illuminate\Contracts\Validation\Factory $validator) {
    //    $validation= $validator->make($request->all(), ['title' => 'required|min:5',
      //      'content' => 'required|min:10']);
        //^in de controller gestoken
        if($validation->fails()){
            return redirect()->back()->withErrors($validation);
        }
        return redirect()->route('admin.index')->with('info', 'Post edited, new Title: ' . $request->input('title'));
    })->name('admin.update');
});*/

Auth::routes();

Route::post('login',
    [
        'uses' => 'SigninController@signin',
        'as' => 'auth.signin'
    ]);
//Route::get('/home', 'HomeController@index')->name('home'); Valt weg want je gebruikt de homeauth niet
