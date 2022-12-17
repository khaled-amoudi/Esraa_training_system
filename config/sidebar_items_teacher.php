<?php

return [
    [
        'menu_label' => 'المدرب',
    ],
    [
        'route' => 'teacher',
        'label' => 'الرئيسية',
        'icon' => 'bi bi-house-fill',
        'active' => 'teacher',
        // 'permission_key' => 'dashboard',
    ],
    [
        'route' => 'teacher.teacher_group.index',
        'label' => 'مجموعاتي',
        'icon' => 'lni lni-vector',
        'active' => 'teacher.teacher_group',
        // 'permission_key' => 'dashboard',
    ],
    [
        'route' => 'teacher.teacher_attendance.index',
        'label' => 'حصر دوام المدرب',
        'icon' => 'lni lni-calendar',
        'active' => 'teacher.teacher_attendance',
        // 'permission_key' => 'dashboard',
    ],
];
