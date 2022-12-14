<?php

return [
    [
        'menu_label' => 'اللوحة الرئيسية للمسؤول',
    ],
    [
        'route' => 'dashboard',
        'label' => 'الرئيسية',
        'icon' => 'bi bi-house-fill',
        'active' => 'dashboard.dashboard',
        // 'permission_key' => 'dashboard',
    ],
    [
        'route' => 'dashboard.year.index',
        'label' => 'إدارة السنوات الدراسية',
        'icon' => 'lni lni-calendar',
        'active' => 'dashboard.year.*',
        // 'permission_key' => 'course',
    ],
    [
        'route' => 'dashboard.student.index',
        'label' => 'إدارة الطلاب',
        'icon' => 'lni lni-users',
        // 'fa-solid fa-people-group'
        'active' => 'dashboard.student.*',
        // 'permission_key' => 'course',
    ],
    [
        'route' => 'dashboard.course.index',
        'label' => 'إدارة المساقات',
        'icon' => 'lni lni-book',
        'active' => 'dashboard.course.*',
        // 'permission_key' => 'course',
    ],
    [
        'route' => 'dashboard.teacher.index',
        'label' => 'إدارة المدربين',
        'icon' => 'bi bi-person-lines-fill',
        'active' => 'dashboard.teacher.*',
        // 'permission_key' => 'course',
    ],
    [
        'route' => 'dashboard.group.index',
        'label' => 'إدارة المجموعات',
        'icon' => 'lni lni-vector',
        'active' => 'dashboard.group.*',
        // 'permission_key' => 'course',
    ],

    [
        'menu_title' => 'الأرشيف',
        'menu_title_icon' => 'lni lni-trash',
        'active' => 'dashboard.*',
        // 'permission_key_group' => 'trash',
        'menu_title_list' => [
            [
                'route' => 'dashboard.course.trash',
                'label' => 'أرشيف المساقات',
                'active' => 'dashboard.course.*',
                'icon' => 'bi bi-circle',
                // 'permission_key' => 'course trash',
            ],
            [
                'route' => 'dashboard.group.trash',
                'label' => 'أرشيف المجموعات',
                'active' => 'dashboard.group.*',
                'icon' => 'bi bi-circle',
                // 'permission_key' => 'group trash',
            ],
            [
                'route' => 'dashboard.teacher.trash',
                'label' => 'أرشيف المدربين',
                'active' => 'dashboard.teacher.*',
                'icon' => 'bi bi-circle',
                // 'permission_key' => 'teacher trash',
            ]
        ]
    ]
];
