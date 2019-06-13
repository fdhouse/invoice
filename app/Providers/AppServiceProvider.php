<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        if(request()->input('sql') == 'show'){
            DB::listen(function ($query) {
                $sql = vsprintf(str_replace("?", "'%s'", $query->sql), $query->bindings);
                dump('SQL语句：'.$sql.'    参数：'.json_encode($query->bindings).'   耗时：'.$query->time.'ms');
            });
        };
    }
}
