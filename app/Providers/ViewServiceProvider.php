<?php

namespace App\Providers;

use App\Models\Semester;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        // view()->composer('*', function($view){
        //     $current_semester = Semester::where('is_current_semester', 1)->first();

        //     $view->with('current_semester', $current_semester);
        // });
    }
}
