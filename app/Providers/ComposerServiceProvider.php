<?php

namespace App\Providers;

use App\Models\Contact;
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
    }
}