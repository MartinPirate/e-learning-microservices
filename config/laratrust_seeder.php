<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_administrator' => [
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'administrator' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'user' => [
            'profile' => 'r,u',
        ],
        'student' => [
            'profile' => 'r,u',
        ],
        'teacher' => [
            'profile' => 'r,u',
        ],
        'parent' => [
            'profile' => 'r,u',
        ],
        'school' => [
            'profile' => 'r,u',
        ],
        'counselors' => [
            'profile' => 'r,u',
        ],
        'award_manager' => [
            'profile' => 'r,u',
        ],
        'essay_writer' => [
            'profile' => 'r,u',
        ],
        'prospective_student' => [
            'profile' => 'r,u',
        ],
        'prospective_parent' => [
            'profile' => 'r,u',
        ],
        /*'role_name' => [
            'module_1_name' => 'c,r,u,d',
        ]*/
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
