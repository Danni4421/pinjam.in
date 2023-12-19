<?php

$container = [
    /**
     * Applications
     * 
     */
    'Applications' => [
        # Request 
        'Requests' => [
            Request::class,
            RequestContainer::class,
            AddDosenRequest::class,
            AddPeminjamanRequest::class,
            AuthenticationRequest::class,
            GetAllRuangRequest::class,
            GetDetailDosenRequest::class,
            UserRequest::class,
            RuangRequest::class,
            MataKuliahRequest::class,
            JadwalRequest::class,
            JamKuliahRequest::class,
            PeminjamanRequest::class,
            FasilitasRequest::class,
            SearchRuangRequest::class,
            UserUpdateFormRequest::class,
        ],

        # UseCase
        'UseCase' => [
            # Use Cases
            AuthenticationUseCase::class,
            UserUseCase::class,
            RuangUseCase::class,
            PeminjamanUseCase::class,
            MataKuliahUseCase::class,
            FasilitasUseCase::class,
            JadwalUseCase::class,
            JamKuliahUseCase::class,
        ],
    ],

    /**
     * Entities
     * 
     */
    'Domains' => [
        # Entities
        'Entities' => [
            HasRequest::class,
            HasRole::class,
            UserDetails::class,
            User::class,
            Dosen::class,
            Peminjam::class,
            Fasilitas::class,
            JamKuliah::class,
            MataKuliah::class,
            Jadwal::class,
            Ruang::class,
            RuangKelas::class,
            RuangDosen::class,
            Peminjaman::class
        ],

        # Repository Interfaces
        'IRepositories' => [
            Repository::class,
            IUserRepository::class,
            IPeminjamanRepository::class,
            IRuangRepository::class,
            IJadwalRepository::class
        ]
    ],

    /**
     * Helpers
     * 
     */
    'Helpers' => [
        ImageManagerHelper::class,
        MessageHelper::class
    ],

    /**
     * Infrastructures
     * 
     */
    'Infrastructures' => [
        # Database
        'Database' => [
            Database::class,
            MySQL::class
        ],

        # Repositories
        'Repositories' => [
            AuthenticationRepository::class,
            UserRepository::class,
            DosenRepository::class,
            RuangRepository::class,
            RuangKelasRepository::class,
            RuangDosenRepository::class,
            PeminjamanRepository::class,
            MataKuliahRepository::class,
            FasilitasRepository::class,
            JadwalRepository::class,
            JamKuliahRepository::class,
        ],

        # Security
        'Security' => [
            Auth::class,
            Input::class,
            Password::class
        ]
    ],

    /**
     * Interfaces
     * 
     */
    'Interfaces' => [
        # Routes
        'Routes' => [
            Route::class,
            Router::class,
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
            require_once __DIR__ . "/sources//" . $prefix . $value . '.php';
        } else {
            $prefix .= $key . "/";
            init($value, $prefix);

            if (!is_array(next($container))) {
                $prefix = '';
            }
        }

        $prefix = $currentPrefix;
    }
}

init($container);
