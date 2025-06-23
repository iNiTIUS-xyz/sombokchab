<?php

namespace App\Providers;

use Blade;
use Twilio\Rest\Client;
use App\Helpers\SidebarMenuHelper;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Query\Expression;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        app()->singleton('DashboardMenu', function () {
            return new SidebarMenuHelper();
        });

        Builder::macro('joinSubLateral', function ($query, $as, $first, $operator = null, $second = null, $type = 'inner', $where = false) {
            [$query, $bindings] = $this->createSub($query);

            $expression = 'LATERAL ('.$query.') as '.$this->grammar->wrapTable($as);

            $this->addBinding($bindings, 'join');

            return $this->join(new Expression($expression), $first, $operator, $second, $type, $where);
        });

        // this will check if app environment is local then register ide heloper service provider this will help IDE like PHPSTORM for make developer life easy
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        };

        $this->app->singleton('twilio', function () {
            return new Client(
                env('TWILIO_ACCOUNT_SID'),
                env('TWILIO_AUTH_TOKEN')
            );
        });
    }

    public function boot(): void
    {
        // this method will prevent if somewhere is calling n+ query if calling then it will show error to user if script environment is local
        // Model::preventLazyLoading(! app()->isProduction());
        // this method will set varchar length 191 when new table or column added to system
        Schema::defaultStringLength(191);
        // this method will load bootstrap pagination for paginate collection
        Paginator::useBootstrap();
        // this condition will check if admin enable force ssl redirection then force for redirection
        if (get_static_option('site_force_ssl_redirection') === 'on') {
            URL::forceScheme('https');
        }

        // this two method are only for loading pagebuilder blade file and menu builder blade file
        $this->loadViewsFrom(__DIR__.'/../PageBuilder/views', 'pagebuilder');
        $this->loadViewsFrom(__DIR__.'/../MenuBuilder/CategoryMenu/views', 'categorymenu');

    }
}
