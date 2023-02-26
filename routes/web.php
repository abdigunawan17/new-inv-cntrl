<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\{HomeSliderController, BlogCategoryController, BlogController, AboutController, ContactController, PortfolioController};
//

Route::get('/', function () {
    return view('frontend.index');
});


//admin all route
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
   Route::get('/admin/profile', 'Profile')->middleware(['auth', 'verified'])->name('admin.profile');
   Route::get('/edit/profile', 'EditProfile')->middleware(['auth', 'verified'])->name('edit.profile');
   Route::post('/store/profile', 'StoreProfile')->name('store.profile');

   Route::get('/change/password', 'ChangePassword')->name('change.password');
   Route::post('/update/password', 'UpdatePassword')->name('update.password');
});

//home all route
Route::controller(HomeSliderController::class)->group(function () {
    Route::get('/home/slide', 'HomeSlider')->middleware(['auth', 'verified'])->name('home.slide');
    Route::post('/update/slider', 'UpdateSlider')->middleware(['auth', 'verified'])->name('update.slider');
});

//portfolio all route
Route::controller(PortfolioController::class)->group(function () {
    Route::get('/all/portfolio', 'AllPortfolio')->middleware(['auth', 'verified'])->name('all.portfolio');
    Route::get('/add/portfolio', 'AddPortfolio')->middleware(['auth', 'verified'])->name('add.portfolio');
    Route::post('/store/portfolio', 'StorePortfolio')->middleware(['auth', 'verified'])->name('store.portfolio');
    Route::get('/edit/portfolio/{id}', 'EditPortfolio')->middleware(['auth', 'verified'])->name('edit.portfolio');
    Route::post('/update/portfolio', 'UpdatePortfolio')->middleware(['auth', 'verified'])->name('update.portfolio');
    Route::get('/delete/portfolio/{id}', 'DeletePortfolio')->middleware(['auth', 'verified'])->name('delete.portfolio');

    //frontend

    Route::get('/portfolio/details/{id}', 'DetailsPortfolio')->name('portfolio.details');

});


//about page all route
Route::controller(AboutController::class)->group(function () {
    Route::get('/about/page', 'AboutPage')->middleware(['auth', 'verified'])->name('about.page');
    Route::post('/update/about', 'UpdateAbout')->name('update.about');

    Route::get('/about', 'HomeAbout')->name('home.about');
});

//home all route
Route::controller(BlogCategoryController::class)->group(function () {
    Route::get('/all/blog/category', 'AllBlogCategory')->name('all.blog.category');
    Route::get('/add/blog/category', 'AddBlogCategory')->name('add.blog.category');
    Route::post('/store/blog/category', 'StoreBlogCategory')->name('store.blog.category');
    Route::get('/edit/blog/category/{id}', 'EditBlogCategory')->name('edit.blog.category');
    Route::post('/update/blog/category/{id}', 'UpdateBlogCategory')->name('update.blog.category');
    Route::get('/delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category');
    
});


//blog page all route
Route::controller(BlogController::class)->group(function () {
    Route::get('/all/blog', 'AllBlog')->name('all.blog');
    Route::get('/add/blog', 'AddBlog')->name('add.blog');
    Route::post('/store/blog', 'StoreBlog')->name('store.blog');
    Route::get('/edit/blog/{id}', 'EditBlog')->name('edit.blog');
    Route::post('/update/blog', 'UpdateBlog')->name('update.blog');
    Route::get('/delete/blog/{id}', 'DeleteBlog')->name('delete.blog');
    Route::get('/blog/detail/{id}', 'BlogDetails')->name('blog.details');

    Route::get('/category/blog/{blog_slug}', 'CategoryBlog')->name('category.post');
    Route::get('/blog', 'HomeBlog')->name('home.blog');
});

Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'Contact')->name('home.contact');
    Route::post('/store/message', 'StoreMessage')->name('home.storemessage');
    Route::get('/contact/message', 'ContactMessage')->name('contact.message');
    Route::get('/delete/message/{id}', 'DeleteMessage')->name('delete.message');
});

Route::get('/dashboard', function () {
    return view('admin.main');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';
