<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Connection;
use App\Database\Query\Grammars\MySqlGrammar;


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
       DB::extend('mysql', function ($config, $name) {
        $connection = app('db.factory')->make($config, $name);
        $connection->setQueryGrammar(new MySqlGrammar($connection));
        return $connection;
    });

    }
}
