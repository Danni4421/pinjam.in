<?php

$container = [
    /**
     * Applications
     * 
     */
    'Applications' => [
        # Request 
        'Requests' => [
            'Request',
            'RequestContainer'
        ],

        # UseCase
        'UseCase' => [],
    ],

    /**
     * Entities
     * 
     */
    'Domains' => [
        # Entities
        'Entities' => [
            'HasRole',
            'User',
            'UserDetails'
        ],

        # Repository Interfaces
        'IRepositories' => [
            'Repository',
            'IUserRepository'
        ]
    ],

    /**
     * Helpers
     * 
     */
    'Helpers' => [
        'ImageManagerHelper',
        'MessageHelper'
    ],

    /**
     * Infrastructures
     * 
     */
    'Infrastructures' => [
        # Database
        'Database' => [
            'Database',
            'MySQL'
        ],

        # Repositories
        'Repositories' => [
            'UserRepository'
        ],

        # Security
        'Security' => [
            'Auth',
            'Input',
            'Password'
        ]
    ],

    /**
     * Interfaces
     * 
     */
    'Interfaces' => [
        # Routes
        'Routes' => [
            'Route',
            'Router',
            'web'
        ]
    ]
];

/**
 * @param array $container
 * @param string $prefix
 * 
 * @return void
 */
function init($container, $prefix = '')
{
    $currentPrefix = $prefix;

    foreach ($container as $key => $value) {
        if (!is_array($value)) {
            require_once __DIR__ . "\\sources\\" . $prefix . $value . '.php';
        } else {
            $prefix .= $key . "\\";
            init($value, $prefix);

            if (!is_array(next($container))) {
                $prefix = '';
            }
        }

        $prefix = $currentPrefix;
    }
}

init($container);
