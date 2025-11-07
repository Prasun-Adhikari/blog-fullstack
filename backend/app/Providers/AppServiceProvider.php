<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

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
        // Register a custom REGEXP function for SQLite if using SQLite connection
        if (DB::connection()->getPdo() instanceof \PDO && DB::connection()->getDriverName() === 'sqlite') {
            // The 'regexp' function in SQLite will map to this PHP closure
            DB::connection()->getPdo()->sqliteCreateFunction('regexp', function ($pattern, $value) {
                // preg_match requires the pattern to be enclosed in delimiters (e.g., '/')
                // and you can add flags like 'i' for case-insensitivity.
                // Here, we assume the pattern from SQL won't include delimiters,
                // so we add them.
                return preg_match('/' . $pattern . '/iu', $value); // 'iu' for case-insensitive and unicode support
            });
        }
    }
}
