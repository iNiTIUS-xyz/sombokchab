<?php

namespace Modules\DeliveryMan\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected string $moduleNamespace = 'Modules\DeliveryMan\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(): void
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapAuthApiRoutes();

        // this route will execute if no route matched
        Route::any('api/delivery-man/{any}', function () {
            return response()->json([
                'message' => 'Page Not Found.',
            ], 404);
        })->where('any', '.*');
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('DeliveryMan', '/Routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes(): void
    {
        Route::prefix('api/delivery-man/v1')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(module_path('DeliveryMan', '/Routes/api.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    private function mapAuthApiRoutes(): void
    {
        Route::prefix('api/delivery-man/v1')
            ->middleware('auth:sanctum')
            ->namespace($this->moduleNamespace)
            ->group(module_path('DeliveryMan', '/Routes/auth-api-route.php'));
    }
}
