<?php

return [
    'jwt' => [
        'algorithm' => env('JWT_ALGORITHM', 'HS256'),
        'passthrough' => ['/auth'],
        'path' => '/',
        'relaxed' => ['localhost'],
        'secret' => env('JWT_SECRET', ''),
        'secure' => env('JWT_SECURE', true),
        'ttl' => env('JWT_TOKEN_TTL')
    ]
];
