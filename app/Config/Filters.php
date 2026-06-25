<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseFilters
{
    /**
     * Aliases
     */
    public array $aliases = [

        'csrf'          => CSRF::class,
        'cors'          => Cors::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,

        // Filter Login Admin
        'auth' => \App\Filters\Auth::class,

        // Filter API Token Praktikum 14
        'apiauth' => \App\Filters\ApiAuthFilter::class,
    ];

    /**
     * Required Filters
     */
    public array $required = [

        'before' => [
        ],

        'after' => [
            'toolbar',
        ],
    ];

    /**
     * Global Filters
     */
    public array $globals = [

        'before' => [
            'cors',

            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],

        'after' => [
            'secureheaders',
        ],
    ];

    /**
     * Method Filters
     */
    public array $methods = [];

    /**
     * Pattern Filters
     */
    public array $filters = [];
}