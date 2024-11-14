<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Table Columns
    |--------------------------------------------------------------------------
    */

    'column.name' => 'Peran',
    'column.guard_name' => 'Situs',
    'column.roles' => 'Peran',
    'column.permissions' => 'Izin',
    'column.updated_at' => 'Tanggal diubah',

    /*
    |--------------------------------------------------------------------------
    | Form Fields
    |--------------------------------------------------------------------------
    */

    'field.name' => 'Peran',
    'field.guard_name' => 'Situs',
    'field.permissions' => 'Izin',
    'field.select_all.name' => 'Pilih Semua',
    'field.select_all.message' => 'Aktifkan semua izin yang <span class="text-primary font-medium">Tersedia</span> untuk Peran ini.',

    /*
    |--------------------------------------------------------------------------
    | Navigation & Resource
    |--------------------------------------------------------------------------
    */

    'nav.group' => 'Manajemen User',
    'nav.role.label' => 'Role',
    'nav.role.icon' => 'heroicon-o-shield-check',
    'resource.label.role' => 'Peran',
    'resource.label.roles' => 'Peran',

    /*
    |--------------------------------------------------------------------------
    | Section & Tabs
    |--------------------------------------------------------------------------
    */

    'section' => 'Entitas',
    'resources' => 'Sumber Daya',
    'widgets' => 'Widget',
    'pages' => 'Halaman',
    'custom' => 'Izin Kustom',

    /*
    |--------------------------------------------------------------------------
    | Messages
    |--------------------------------------------------------------------------
    */

    'forbidden' => 'Kamu tidak punya izin akses',

    /*
    |--------------------------------------------------------------------------
    | Resource Permissions' Labels
    |--------------------------------------------------------------------------
    */

    'resource_permission_prefixes_labels' => [
        'view' => 'Lihat',
        'view_any' => 'Lihat Semua',
        'create' => 'Buat',
        'update' => 'Perbarui',
        'delete' => 'Hapus',
        'delete_any' => 'Hapus Semua',
        'force_delete' => 'Hapus Paksa',
        'force_delete_any' => 'Hapus Paksa Semua',
        'restore' => 'Pulihkan',
        'replicate' => 'Duplikasi',
        'reorder' => 'Susun Ulang',
        'restore_any' => 'Pulihkan Semua',
    ],
];
