<?php

namespace Jiri\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Jiri\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/web/base.php');
            require base_path('routes/web/admin.php');
            require base_path('routes/web/event.php');
            require base_path('routes/web/project.php');
            require base_path('routes/web/student.php');
            require base_path('routes/web/users.php');
            require base_path('routes/web/meetings.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
         Route::group([
             'prefix' => 'api',
             'middleware' => 'api',
             'namespace' => $this->namespace,
         ], function ($router) {
             require base_path('routes/api/event.php');
             require base_path('routes/api/implementation.php');
             require base_path('routes/api/meeting.php');
             require base_path('routes/api/performance.php');
             require base_path('routes/api/project.php');
             require base_path('routes/api/user.php');
             require base_path('routes/api/weight.php');
             require base_path('routes/api/score.php');
             require base_path('routes/api/student.php');
             require base_path('routes/api/auth.php');
         });
    }
}
