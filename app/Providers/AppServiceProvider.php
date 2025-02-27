<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Policy;
use App\Models\SiteSettings;
use App\Models\Subcategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer ('*', function($view){
         
         $view->with('allCategories', Category::with('Subcategory')->get());
         $view->with('allSubcategories', Subcategory::get());
         $view->with('cartProducts', Cart::where('ip_address', request()->ip())->with('product')->get());
         $view->with('cartProductsCount', Cart::where('ip_address', request()->ip())->with('product')->count());
         $view->with('policy', Policy::first());
         $view->with('sitesettings', SiteSettings::first());

        });
    }
}
