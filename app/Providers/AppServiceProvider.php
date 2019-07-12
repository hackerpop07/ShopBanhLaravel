<?php

namespace App\Providers;

use App\Cart;
use App\ProductType;
use App\Repository\Contracts\CategoryRepositoryInterface;
use App\Repository\Contracts\ProductRepositoryInterface;
use App\Repository\Eloquent\CategoryEloquentRepository;
use App\Repository\Eloquent\ProductEloquentRepository;
use App\Services\Impl\ProductServices;
use App\Services\Services;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('header', function ($view) {
            $product_type = ProductType::all();
            $view->with(['product_type' => $product_type]);
        });
        view()->composer('header', function ($view) {
            if (Session::has('cart')) {
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with(['cart' => Session::get('cart'),
                    'product_cart' => $cart->items, 'totalPrice' => $cart->totalPrice, 'totalQty' => $cart->totalQty]);
            }
        });
        view()->composer('layout.shopping_cart', function ($view) {
            if (Session::has('cart')) {
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with(['cart' => Session::get('cart'),
                    'product_cart' => $cart->items, 'totalPrice' => $cart->totalPrice, 'totalQty' => $cart->totalQty]);
            }
        });

        $this->app->singleton(ProductRepositoryInterface::class, ProductEloquentRepository::class);
        $this->app->singleton(ProductServices::class, Services::class);
        $this->app->singleton(CategoryRepositoryInterface::class, CategoryEloquentRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //loca host thi dong
//        URL::forceScheme('https');
    }
}
