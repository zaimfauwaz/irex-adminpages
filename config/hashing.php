<?php

return [

    'default' => 'argon',

    'hashers' => [
        'bcrypt' => [
            'rounds' => env('BCRYPT_ROUNDS', 10),
        ],

        'argon' => [
            'memory' => env('ARGON_MEMORY', 1024),
            'threads' => env('ARGON_THREADS', 2),
            'time' => env('ARGON_TIME', 2),
        ],

        'argon2id' => [
            'memory' => env('ARGON2ID_MEMORY', 1024),
            'threads' => env('ARGON2ID_THREADS', 2),
            'time' => env('ARGON2ID_TIME', 2),
        ],
    ],

];
