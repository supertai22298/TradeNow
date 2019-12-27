<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('admins.contacts.master', function ($view) {
            $countContact = Contact::countRead();
            $countStar = Contact::countStar();
            $view->with([
                'countContact' => $countContact,
                'countStar' => $countStar,
            ]);
        });
        view()->composer(
            ['clients.layout.sidebar', 'clients.layout.header'], 
            function ($view) {
                $bestSales = Product::getBestSaleProducts();
                $categories = Category::has('products')->get();
                $home_brands = Brand::all()->take(5);
                unset($home_brands[0]);
                $view->with([
                    'categories' => $categories,
                    'bestSales' => $bestSales,
                    'home_brands' => $home_brands,
                ]);
            }
        );

    }
}
