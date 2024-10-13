<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

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
        JsonResource::withoutWrapping();
        // Vite::usePrefetchStrategy('waterfall', ['concurrency' => 3]);
        foreach (['info', 'success', 'warning', 'error'] as $type) {
            RedirectResponse::macro(
                $type,
                function ($title, $message = null) use ($type) {
                    return $this->with('flash', ['type' => $type, 'title' => $title, 'message' => $message]);
                }
            );
        }
    }
}
