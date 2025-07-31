<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * The application's route model bindings.
     *
     * @var array<int, class-string|string>
     */
    protected $routeModelBindings = [];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            // \App\Http\Middleware\EncryptCookies::class,
            // \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            // \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            // \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            // \App\Http\Middleware\VerifyCsrfToken::class,
            // \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            // \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        // 'auth' => \App\Http\Middleware\Authenticate::class,
        // 'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        // 'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        // 'can' => \Illuminate\Auth\Middleware\Authorize::class,
        // 'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        // 'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        // 'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(function () {
                    Route::get('/', function () {
                        return redirect('/welcome');
                    });
                    Route::get('/welcome', function () {
                        return view('welcome');
                    });
                    Route::get('/dashboard', function () {
                        return view('dashboard');
                    });
                    // Route::get('/users', function () {
                    //     return view('users.index');
                    // });
                    // Route::get('/users/create', function () {
                    //     return view('users.create');
                    // });
                    // Route::get('/users/{user}', function ($user) {
                    //     return view('users.show', ['user' => $user]);
                    // });
                    // Route::get('/users/{user}/edit', function ($user) {
                    //     return view('users.edit', ['user' => $user]);
                    // });
                    // Route::post('/users', function () {
                    //     return redirect('/users');
                    // });
                    // Route::put('/users/{user}', function ($user) {
                    //     return redirect('/users/' . $user->id);
                    // });
                    // Route::delete('/users/{user}', function ($user) {
                    //     return redirect('/users');
                    // });
                });
        });
    }

    /**
     * The application's route model bindings.
     *
     * @return array<int, class-string|string>
     */
    public function routeModelBindings(): array
    {
        return $this->routeModelBindings;
    }

    /**
     * The application's route middleware groups.
     *
     * @return array<string, array<int, class-string|string>>
     */
    public function middlewareGroups(): array
    {
        return $this->middlewareGroups;
    }

    /**
     * The application's route middleware.
     *
     * @return array<string, class-string|string>
     */
    public function routeMiddleware(): array
    {
        return $this->routeMiddleware;
    }
} 