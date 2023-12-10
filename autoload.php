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
        'UseCase' => [
            # Interfaces
            'UseCase',

            # Use Cases
            'RegisterUseCase'
        ],
    ],

    /**
     * Entities
     * 
     */
    'Domains' => [
        # Entities
        'Entities' => [
            'HasRequest',
            'HasRole',
            'UserDetails',
            'User',
            'Dosen',
            'Peminjam',
            'Fasilitas',
            'JamKuliah',
            'MataKuliah',
            'Jadwal',
            'Ruang',
            'RuangKelas',
            'RuangDosen',
            'Peminjaman'
        ],

        # Repository Interfaces
        'IRepositories' => [
            'Repository',
            'IUserRepository',
            'IPeminjamanRepository',
            'IRuangRepository'
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
            'AuthenticationRepository',
            'UserRepository',
            'DosenRepository',
            'RuangRepository',
            'RuangKelasRepository',
            'RuangDosenRepository',
            'PeminjamanRepository'
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
