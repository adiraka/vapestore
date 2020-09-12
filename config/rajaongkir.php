<?php

return [
    /*
     * Atur API key yang dibutuhkan untuk mengakses API Raja Ongkir.
     * Dapatkan API key dengan mengakses halaman panel akun Anda.
     */
    'api_key' => env('RAJAONGKIR_API_KEY', 'dc4d42586677c95c1dbc9e628c256271'),

    /*
     * Atur tipe akun sesuai paket API yang Anda pilih di Raja Ongkir.
     * Pilihan yang tersedia: ['starter', 'basic', 'pro'].
     */
    'package' => env('RAJAONGKIR_PACKAGE', 'starter'),
];
