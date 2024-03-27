<?php
return [
    'module' => [
        [
            'title' => 'User',
            'icon' => 'fa fa-user',
            'name' => 'User',
            'subModule' => [
                [
                    'title' => 'User Group ',
                    'route' => 'user.catalogue.index',
                ],
                [
                    'title' => 'User',
                    'route' => 'user.index',
                ]
            ]
        ],
        [
            'title' => 'Article',
            'icon' => 'fa fa-file',
            'name' => 'Article',
            'subModule' => [
                [
                    'title' => 'Article Group',
                    'route' => 'post.catalogue.index',
                ],
                [
                    'title' => 'Article',
                    'route' => 'post.index',
                ]
            ]
        ],

        [
            'title' => 'General',
            'icon' => 'fa fa-file',
            'name' => 'Language',
            'subModule' => [
                [
                    'title' => 'Language',
                    'route' => 'language.index',

                ],

            ]
        ]
    ]

];