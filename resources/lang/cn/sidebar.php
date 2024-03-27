<?php
return [
    'module' => [
        [
            'title' => '管理群组成员',
            'icon' => 'fa fa-user',
            'name' => '使用者',
            'subModule' => [
                [
                    'title' => '管理群组成员',
                    'route' => 'user.catalogue.index',
                ],
                [
                    'title' => '管理會員',
                    'route' => 'user.index',
                ]
            ]
        ],
        [
            'title' => '文章管理',
            'icon' => 'fa fa-file',
            'name' => '郵政',
            'subModule' => [
                [
                    'title' => '管理文章組',
                    'route' => 'post.catalogue.index',
                ],
                [
                    'title' => '文章管理',
                    'route' => 'post.index',
                ]
            ]
        ],

        [
            'title' => '通用配置',
            'icon' => 'fa fa-file',
            'name' => '語言',
            'subModule' => [
                [
                    'title' => '語言管理',
                    'route' => 'language.index',

                ],

            ]
        ]
    ]

];