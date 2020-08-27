<?php

Route::get('site-bakimda', function () {
    return view('front.offline');
});


/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('isLogin')->group(function () {
        Route::get('giris', 'Back\AuthController@login')->name('login');
        Route::post('giris', 'Back\AuthController@loginPost')->name('login.post');
    });

    Route::middleware('isAdmin')->group(function () {
        Route::get('cikis', 'Back\AuthController@logout')->name('logout');
        // Makale Routes
        Route::get('makaleler/silinenler', 'Back\ArticleController@trashed')->name('makaleler.trashed');
        Route::resource('makaleler', 'Back\ArticleController');
        Route::get('deletearticle/{id}', 'Back\ArticleController@delete')->name('makaleler.delete');
        Route::get('harddeletearticle/{id}', 'Back\ArticleController@hardDelete')->name('makaleler.delete.hard');
        Route::get('recoverarticle/{id}', 'Back\ArticleController@recover')->name('makaleler.recover');
        Route::get('switch', 'Back\ArticleController@switch')->name('switch');
        // Kategori Routes
        Route::get('kategoriler', 'Back\CategoryController@index')->name('category.index');
        Route::post('kategori/create', 'Back\CategoryController@create')->name('category.create');
        Route::post('kategori/update', 'Back\CategoryController@update')->name('category.update');
        Route::post('kategori/delete', 'Back\CategoryController@delete')->name('category.delete');
        Route::get('kategori/status', 'Back\CategoryController@switch')->name('category.switch');
        Route::get('kategori/getData', 'Back\CategoryController@getData')->name('category.getdata');
        // Pages Routes
        Route::get('sayfalar', 'Back\PageController@index')->name('page.index');
        Route::get('sayfalar/olustur', 'Back\PageController@create')->name('page.create');
        Route::post('sayfalar/olustur', 'Back\PageController@post')->name('page.create.post');
        Route::get('sayfalar/guncelle/{id}', 'Back\PageController@update')->name('page.edit');
        Route::post('sayfalar/guncelle/{id}', 'Back\PageController@updatePost')->name('page.edit.post');
        Route::get('sayfa/sil/{id}', 'Back\PageController@delete')->name('page.delete');
        Route::get('sayfa/siralama', 'Back\PageController@orders')->name('page.orders');
        Route::get('sayfalar/switch', 'Back\PageController@switch')->name('page.switch');

        // Configs Routes
        Route::get('ayarlar', 'Back\ConfigController@index')->name('config.index');
        Route::post('ayarlar/update', 'Back\ConfigController@update')->name('config.update');

        Route::get('panel', 'Back\Dashboard@index')->name('dashboard');
    });
});

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'Front\Homepage@index')->name('homepage');
Route::get('/sayfa', 'Front\Homepage@index');
Route::get('/iletisim', 'Front\Homepage@contact')->name('contact');
Route::post('/iletisim', 'Front\Homepage@contactpost')->name('contact.post');
Route::get('/kategori/{category}', 'Front\Homepage@category')->name('category');
Route::get('/{category}/{slug}', 'Front\Homepage@single')->name('single');
Route::get('/{sayfa}', 'Front\Homepage@page')->name('page');

