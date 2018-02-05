<?php

return [
    'jwt' => [
        'algorithm' => env('JWT_ALGORITHM', 'HS256'),
        'passthrough' => envStringToArray(env('JWT_PASSTHROUGH'), ''),
        'path' => envStringToArray(env('JWT_PATH', '/')),
        'relaxed' => envStringToArray(env('JWT_RELAXED', 'localhost')),
        'secret' => env('JWT_SECRET', ''),
        'secure' => env('JWT_SECURE', true),
        'ttl' => env('JWT_TOKEN_TTL')
    ]
];
