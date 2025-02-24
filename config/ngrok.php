<?php
return [
    /*
     * Path ke executable ngrok
     */
    'executable_path' => env('NGROK_PATH', 'ngrok'),

    /*
     * Token autentikasi ngrok (opsional)
     */
    'auth_token' => env('NGROK_AUTH_TOKEN'),

    /*
     * Port yang akan di-tunnel
     */ 
    'port' => env('NGROK_PORT', 8000),

    /*
     * Region untuk tunnel (default: us)
     */
    'region' => env('NGROK_REGION', 'us'),

    /*
     * Subdomain untuk tunnel (hanya untuk akun berbayar)
     */
    'subdomain' => env('NGROK_SUBDOMAIN'),

    /*
     * Domain untuk tunnel (hanya untuk akun berbayar)
     */
    'hostname' => env('NGROK_HOSTNAME'),
];
