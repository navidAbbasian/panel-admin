<?php

use App\Http\Controllers\API\Magazine\BannerController;
use App\Http\Controllers\API\Magazine\CategoryController;
use App\Http\Controllers\API\Magazine\FaqController;
use App\Http\Controllers\API\Magazine\FaqItemController;
use App\Http\Controllers\API\Magazine\PageController;
use App\Http\Controllers\API\Magazine\PostCommentController;
use App\Http\Controllers\API\Magazine\PostController;
use App\Http\Controllers\API\Magazine\SettingController;
use App\Http\Controllers\API\Magazine\SliderController;
use App\Http\Controllers\API\Magazine\TagController;
use App\Http\Controllers\API\Shop\BrandController;
use App\Http\Controllers\API\Shop\CarouselController;
use App\Http\Controllers\API\Shop\ColorController;
use App\Http\Controllers\API\Shop\CommentController;
use App\Http\Controllers\API\Shop\ConfigController;
use App\Http\Controllers\API\Shop\ConsultController;
use App\Http\Controllers\API\Shop\CustomerListController;
use App\Http\Controllers\API\Shop\FooterController;
use App\Http\Controllers\API\Shop\FooterItemController;
use App\Http\Controllers\API\Shop\GiftOfferController;
use App\Http\Controllers\API\Shop\MenuController;
use App\Http\Controllers\API\Shop\ModeTransportationController;
use App\Http\Controllers\API\Shop\NewsletterController;
use App\Http\Controllers\API\Shop\OtherPageController;
use App\Http\Controllers\API\Shop\ProvinceController;
use App\Http\Controllers\API\Shop\RedirectController;
use App\Http\Controllers\API\Shop\SaleCategoryController;
use App\Http\Controllers\API\Shop\CategoryController as ShopCategory;
use App\Http\Controllers\API\Shop\TagController as ShopTag;
use App\Http\Controllers\API\Shop\PageController as ShopPage;
use App\Http\Controllers\API\Shop\FaqController as ShopFaq;
use App\Http\Controllers\API\Shop\TaxClassesController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RegisterController;
use Illuminate\Support\Facades\Route;

Route::post('register' , [RegisterController::class , 'register']);
Route::post('login' , [RegisterController::class , 'Login']);

Route::middleware('auth:api')->group( function (){

    Route::prefix('magazine')->group(function () {
        Route::resource('products' , ProductController::class);
        Route::resource('tags', TagController::class);
        Route::resource('sliders', SliderController::class);
        Route::resource('setting', SettingController::class);
        Route::resource('pages', PageController::class);
        Route::resource('categories' , CategoryController::class);
        Route::resource('posts', PostController::class);
        Route::resource('faqs', FaqController::class);
        Route::resource('faqsitems', FaqItemController::class);
        Route::resource('banners', BannerController::class );

        Route::controller(PostCommentController::class)->group(function () {
            Route::get('comments', 'index');
            Route::post('comments',  'store');
            Route::put('comments/{comment}','update');
            Route::get('comments/{comment}', 'show');
            Route::delete('comments/{comment}','destroy');
            Route::post('comments/{comment}/like','like');
            Route::post('comments/{comment}/dislike','dislike');
        });
    });
    Route::prefix('shop')->group(function () {
        Route::apiResource('categories' , ShopCategory::class);
        Route::apiResource('saletegories', SaleCategoryController::class);
        Route::apiResource('giftoffers', GiftOfferController::class);
        Route::apiResource('tags', ShopTag::class);
        Route::apiResource('colors', ColorController::class);
        Route::apiResource('taxclasses' , TaxClassesController::class);
        Route::apiResource('brands', BrandController::class);
        Route::apiResource('redirects', RedirectController::class);
        Route::apiResource('menus', MenuController::class);
        Route::apiResource('footers' , FooterController::class);
        Route::apiResource('footeritems', FooterItemController::class);
        Route::apiResource('carousels', CarouselController::class);
        Route::apiResource('configs', ConfigController::class);
        Route::apiResource('otherpages' , OtherPageController::class);
        Route::apiResource('pages' , ShopPage::class);
        Route::apiResource('modetransportations', ModeTransportationController::class);
        Route::apiResource('provinces' , ProvinceController::class);
        Route::apiResource('consults', ConsultController::class);

        Route::controller(ShopFaq::class)->group(function () {
           Route::get('faqs' , 'index');
           Route::post('faqs', 'store');
           Route::put('faqs/{faq}', 'update');
           Route::get('faqs/{faq}', 'show');
           Route::post('faqs/{faq}/like' , 'like');
           Route::post('faqs/{faq}/dislike' , 'dislike');
        });
        Route::controller(CommentController::class)->group(function () {
           Route::get('comments', 'index');
           Route::post('comments' , 'store');
           Route::put('comments/{comment}', 'update');
           Route::get('comments/{comment}', 'show');
           Route::post('comments/{comment}/like', 'like');
           Route::post('comments/{comment}/dislike', 'dislike');
        });
        Route::apiResource('newsletter', NewsletterController::class);
        Route::apiResource('customerlists', CustomerListController::class);
    });
});
