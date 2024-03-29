<?php
return [
    'module' => [
        [
            'title' => 'Ql Nhóm Thành Viên',
            'icon' => 'fa fa-user',
            'name' => ['User','Permission'],
            'subModule' => [
                [
                    'title' => 'Ql Nhóm Thành Viên',
                    'route' => 'user.catalogue.index',
                ],
                [
                    'title' => 'Ql Thành Viên',
                    'route' => 'user.index',
                ],
                [
                    'title' => 'Ql Quyền',
                    'route' => 'permission.index',
                ],
            ]
        ],
        [
            'title' => 'Ql Bài Viết',
            'icon' => 'fa fa-file',
            'name' => ['Post'],
            'subModule' => [
                [
                    'title' => 'Ql Nhóm Bài Viết',
                    'route' => 'post.catalogue.index',
                ],
                [
                    'title' => 'Ql Bài Viết',
                    'route' => 'post.index',
                ]
            ]
        ],

        [
            'title' => 'Cấu Hình Chung',
            'icon' => 'fa fa-file',
            'name' => ['Language'],
            'subModule' => [
                [
                    'title' => 'Ql Ngôn Ngữ',
                    'route' => 'language.index',

                ],

            ]
        ]
    ]

];