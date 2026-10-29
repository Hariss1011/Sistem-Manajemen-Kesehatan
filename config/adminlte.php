
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Identitas Aplikasi
    |--------------------------------------------------------------------------
    */

    'title' => 'Sistem Informasi Klinik',
    'title_prefix' => '',
    'title_postfix' => ' | SISMENKES',

    'use_ico_only' => false,
    'use_full_favicon' => false,

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    */

    'logo' => '<b>SIS</b>MENKES',
    'logo_img' => null,
    'logo_img_class' => 'brand-image',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Logo Sistem Informasi Klinik',

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Logo Sistem Informasi Klinik',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader
    |--------------------------------------------------------------------------
    */

    'preloader' => [
        'enabled' => false,
        'mode' => 'cwrapper',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Memuat aplikasi',
            'effect' => 'animation__fadeIn',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Pengguna
    |--------------------------------------------------------------------------
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-success',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    */

    'layout_topnav' => null,
    'layout_boxed' => false,
    'layout_fixed_sidebar' => false,
    'layout_fixed_navbar' => false,
    'layout_fixed_footer' => false,
    'layout_dark_mode' => false,

    /*
    |--------------------------------------------------------------------------
    | Tampilan Autentikasi
    |--------------------------------------------------------------------------
    */

    'classes_auth_card' => 'card-outline card-success',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => 'text-success',
    'classes_auth_btn' => 'btn-flat btn-success',

    /*
    |--------------------------------------------------------------------------
    | Tampilan Panel
    |--------------------------------------------------------------------------
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => 'font-weight-bold',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-success elevation-2',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container-fluid',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => true,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 250,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar
    |--------------------------------------------------------------------------
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'light',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URL
    |--------------------------------------------------------------------------
    |
    | URL dashboard dipertahankan ke home sesuai konfigurasi awal.
    | Pastikan route home memang tersedia di aplikasi.
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,
    'disable_darkmode_routes' => true,

    /*
    |--------------------------------------------------------------------------
    | Laravel Asset Bundling
    |--------------------------------------------------------------------------
    */

    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'css/app.css',
    'laravel_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Navigasi
    |--------------------------------------------------------------------------
    |
    | Menu lama berisi tautan contoh admin/settings.
    | Menu role akan disusun setelah route dan view navigasi diperiksa.
    | Jangan memasukkan semua menu role ke sini tanpa pembatasan akses.
    |
    */




    'menu' => [
        [
            'text' => 'Dashboard',
            'route' => 'pasien.dashboard',
            'icon' => 'fas fa-fw fa-home',
            'can' => 'role-pasien',
        ],
        [
            'text' => 'Daftar Poli',
            'route' => 'pasien.poli.index',
            'icon' => 'fas fa-fw fa-hospital',
            'can' => 'role-pasien',
        ],

        [
            'text' => 'Dashboard',
            'route' => 'dokter.dashboard',
            'icon' => 'fas fa-fw fa-home',
            'can' => 'role-dokter',
        ],
        [
            'text' => 'Jadwal Periksa',
            'route' => 'jadwal.index',
            'icon' => 'fas fa-fw fa-calendar-alt',
            'can' => 'role-dokter',
        ],
        [
            'text' => 'Periksa Pasien',
            'route' => 'memeriksa.index',
            'icon' => 'fas fa-fw fa-stethoscope',
            'can' => 'role-dokter',
        ],
        [
            'text' => 'Riwayat Pasien',
            'route' => 'riwayat.index',
            'icon' => 'fas fa-fw fa-notes-medical',
            'can' => 'role-dokter',
        ],

        [
            'text' => 'Dashboard',
            'route' => 'admin.dashboard',
            'icon' => 'fas fa-fw fa-home',
            'can' => 'role-admin',
        ],
        [
            'text' => 'Data Pasien',
            'route' => 'admin.pasien.index',
            'icon' => 'fas fa-fw fa-users',
            'can' => 'role-admin',
        ],
        [
            'text' => 'Data Dokter',
            'route' => 'admin.dokter.index',
            'icon' => 'fas fa-fw fa-user-md',
            'can' => 'role-admin',
        ],
        [
            'text' => 'Data Poli',
            'route' => 'admin.poli.index',
            'icon' => 'fas fa-fw fa-hospital',
            'can' => 'role-admin',
        ],
        [
            'text' => 'Data Obat',
            'route' => 'admin.obat.index',
            'icon' => 'fas fa-fw fa-pills',
            'can' => 'role-admin',
        ],
    ],



    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugin
    |--------------------------------------------------------------------------
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],

        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],

        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],

        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],

        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    */

    'livewire' => false,

];
