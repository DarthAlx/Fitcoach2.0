<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    Collection::macro('sortByDate', function ($column = 'created_at', $order = SORT_DESC) {
		    /* @var $this Collection */
		    return $this->sortBy(function ($datum) use ($column) {
			    return strtotime($datum->$column);
		    }, SORT_REGULAR, $order == SORT_DESC);
	    });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
