<?php

// BRAND

new \Kirki\Panel(
    'brand',
    [
        'title' => 'Branding',
        'priority' => 40,
    ]
);

new \Kirki\Section(
    'colors',
    [
        'title' => 'Colors',
        'panel' => 'brand',
    ]
);
new \Kirki\Section(
    'fonts',
    [
        'title' => 'Fonts',
        'panel' => 'brand',
    ]
);
new \Kirki\Section(
    'icons',
    [
        'title' => 'Icons',
        'panel' => 'brand',
    ]
);
new \Kirki\Section(
    'social',
    [
        'title' => 'Social',
        'panel' => 'brand',
    ]
);

// BRAND - COLORS
new \Kirki\Field\Multicolor(
    [
        'settings' => 'colors_brand',
        'label'    => 'Brand Colors',
        'section'  => 'colors',
        'choices'  => [
            'color-1' => 'Color 1',
            'color-2' => 'Color 2',
            'color-3' => 'Color 3',
            'color-4' => 'Color 4',
            'color-5' => 'Color 5',
            'color-6' => 'Color 6',
        ],
        'alpha'    => true,
        'default'  => [
            'color-1' => '#235B95',
            'color-2' => '#4E9FD6',
            'color-3' => '#47BE9D',
            'color-4' => '#67D88F',
            'color-5' => '#FFA900',
            'color-6' => '#FF4D00',
        ],
        'output'   => [
            [
                'choice'   => 'color-1',
                'element'  => ':root',
                'property' => '--s-color-1',
            ],
            [
                'choice'   => 'color-2',
                'element'  => ':root',
                'property' => '--s-color-2',
            ],
            [
                'choice'   => 'color-3',
                'element'  => ':root',
                'property' => '--s-color-3',
            ],
            [
                'choice'   => 'color-4',
                'element'  => ':root',
                'property' => '--s-color-4',
            ],
            [
                'choice'   => 'color-5',
                'element'  => ':root',
                'property' => '--s-color-5',
            ],
            [
                'choice'   => 'color-6',
                'element'  => ':root',
                'property' => '--s-color-6',
            ],
        ],
    ]
);
new \Kirki\Field\Multicolor(
    [
        'settings' => 'colors_content',
        'label'    => 'Text, Background, Border',
        'section'  => 'colors',
        'choices'  => [
            'text-1' => 'Text 1',
            'text-2' => 'Text 2',
            'bg-1'   => 'BG 1',
            'bg-2'   => 'BG 2',
            'border-1'   => 'Border 1',
            'border-2'   => 'Border 2',
        ],
        'alpha'    => true,
        'default'  => [
            'text-1' => '#222222',
            'text-2' => '#71767f',
            'bg-1'   => '#ffffff',
            'bg-2'   => '#f5f5f7',
            'border-1'   => '#d5d5d7',
            'border-2'   => '#e5e5e7',
        ],
        'output'   => [
            [
                'choice'   => 'text-1',
                'element'  => ':root',
                'property' => '--s-text-1',
            ],
            [
                'choice'   => 'text-2',
                'element'  => ':root',
                'property' => '--s-text-2',
            ],
            [
                'choice'   => 'bg-1',
                'element'  => ':root',
                'property' => '--s-bg-1',
            ],
            [
                'choice'   => 'bg-2',
                'element'  => ':root',
                'property' => '--s-bg-2',
            ],
            [
                'choice'   => 'border-1',
                'element'  => ':root',
                'property' => '--s-border-1',
            ],
            [
                'choice'   => 'border-2',
                'element'  => ':root',
                'property' => '--s-border-2',
            ],

        ],
    ]
);
// BRAND - FONTS
new \Kirki\Pro\Field\Headline(
    [
        'settings' => 'fonts_body',
        'label'    => 'Body Font',
        'section'  => 'fonts',
        'tooltip'  => 'CSS Class: _body, CSS Var: --s-body',
    ]
);
new \Kirki\Field\Radio_Buttonset(
    [
        'settings' => 'fonts_body_source',
        'label'    => 'Source',
        'section'  => 'fonts',
        'default'  => 'system',
        'choices'  => [
            'system' => 'System',
            'google' => 'Google',
            'adobe'  => 'Adobe',
            'upload' => 'Upload',
        ],
    ]
);
new \Kirki\Field\Select(
    [
        'settings'        => 'fonts_body_system',
        'label'           => 'Font Family',
        'section'         => 'fonts',
        'default'         => '-apple-system,"Helvetica Neue",sans-serif',
        'choices'         => [
            '-apple-system,"Helvetica Neue",sans-serif' => 'Sans Serif: Helvetica Neue',
            '"Times New Roman",serif'                   => 'Serif: Times New Roman',
            'Monaco,Courier,monospace'                  => 'Monospace: Monaco',
        ],
        'active_callback' => [
            [
                'setting'  => 'fonts_body_source',
                'operator' => '==',
                'value'    => 'system',
            ],
        ],
        'output'          => [
            [
                'element'  => ':root',
                'property' => '--s-body',
            ],
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'        => 'fonts_body_google',
        'label'           => 'Font Family',
        'description'     => wp_kses(
            sprintf(
                'Use font name from <a href="%1$s" target="_blank">fonts.google.com</a>, such as 
            <strong>Roboto</strong>, <strong>Open Sans</strong> (case-sensitive).',
                esc_url('https://fonts.google.com/')
            ),
            [
                'a'      => [
                    'href'   => [],
                    'target' => [],
                ],
                'strong' => [],
            ]
        ),
        'section'         => 'fonts',
        'default'         => 'Sarabun',
        'active_callback' => [
            [
                'setting'  => 'fonts_body_source',
                'operator' => '==',
                'value'    => 'google',
            ],
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'        => 'fonts_body_adobe_code',
        'label'           => 'Code start with <link ...',
        'section'         => 'fonts',
        'choices'         => [
            'language' => 'html',
        ],
        'active_callback' => [
            [
                'setting'  => 'fonts_body_source',
                'operator' => '==',
                'value'    => 'adobe',
            ],
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'        => 'fonts_body_adobe',
        'label'           => 'Font Family (Only 1 name)',
        'section'         => 'fonts',
        'active_callback' => [
            [
                'setting'  => 'fonts_body_source',
                'operator' => '==',
                'value'    => 'adobe',
            ],
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'        => 'fonts_body_upload',
        'label'           => 'Font Family',
        'section'         => 'fonts',
        'active_callback' => [
            [
                'setting'  => 'fonts_body_source',
                'operator' => '==',
                'value'    => 'upload',
            ],
        ],
    ]
);
new \Kirki\Pro\Field\Divider(
    [
        'settings'        => 'fonts_body_hr_1',
        'section'         => 'fonts',
        'active_callback' => [
            [
                'setting'  => 'fonts_body_source',
                'operator' => '==',
                'value'    => 'upload',
            ],
        ],
    ]
);
new \Kirki\Field\Upload(
    [
        'settings'        => 'fonts_body_file_normal',
        'label'           => 'NORMAL: Font File (.woff2)',
        'section'         => 'fonts',
        'active_callback' => [
            [
                'setting'  => 'fonts_body_source',
                'operator' => '==',
                'value'    => 'upload',
            ],
        ],
    ]
);
new \Kirki\Field\Select(
    [
        'settings' => 'fonts_body_weight_normal',
        'label'    => 'NORMAL: Font Weight',
        'section'  => 'fonts',
        'default'  => '400',
        'choices'  => [
            '300' => '300: Light',
            '400' => '400: Regular',
            '500' => '500: Medium',
            '600' => '600: Semi Bold',
            '700' => '700: Bold',
        ],
        'output'   => [
            [
                'element'  => 'body',
                'property' => 'font-weight',
            ],
        ],
    ]
);
new \Kirki\Pro\Field\Divider(
    [
        'settings'        => 'fonts_body_hr_2',
        'section'         => 'fonts',
        'active_callback' => [
            [
                'setting'  => 'fonts_body_source',
                'operator' => '==',
                'value'    => 'upload',
            ],
        ],
    ]
);
new \Kirki\Field\Upload(
    [
        'settings'        => 'fonts_body_file_strong',
        'label'           => 'STRONG: Font File (.woff2)',
        'section'         => 'fonts',
        'active_callback' => [
            [
                'setting'  => 'fonts_body_source',
                'operator' => '==',
                'value'    => 'upload',
            ],
        ],
    ]
);
new \Kirki\Field\Select(
    [
        'settings' => 'fonts_body_weight_strong',
        'label'    => 'STRONG: Font Weight',
        'section'  => 'fonts',
        'default'  => '700',
        'choices'  => [
            '300' => '300: Light',
            '400' => '400: Regular',
            '500' => '500: Medium',
            '600' => '600: Semi Bold',
            '700' => '700: Bold',
        ],
        'output'   => [
            [
                'element'  => 'strong',
                'property' => 'font-weight',
            ],
        ],
    ]
);
new \Kirki\Pro\Field\Divider(
    [
        'settings' => 'fonts_body_hr_3',
        'section'  => 'fonts',
    ]
);
new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings' => 'fonts_head_title',
        'label'    => 'Set Heading Font?',
        'section'  => 'fonts',
        'default'  => false,
        'tooltip'  => 'CSS Class: _h, CSS Var: --s-heading',
    ]
);
new \Kirki\Field\Radio_Buttonset(
    [
        'settings'        => 'fonts_head_source',
        'label'           => 'Source',
        'section'         => 'fonts',
        'default'         => 'system',
        'choices'         => [
            'system' => 'System',
            'google' => 'Google',
            'adobe'  => 'Adobe',
            'upload' => 'Upload',
        ],
        'active_callback' => [
            [
                'setting'  => 'fonts_head_title',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Select(
    [
        'settings'        => 'fonts_head_system',
        'label'           => 'Font Family',
        'section'         => 'fonts',
        'default'         => '-apple-system,"Helvetica Neue",sans-serif',
        'choices'         => [
            '-apple-system,"Helvetica Neue",sans-serif' => 'Sans Serif: Helvetica Neue',
            '"Times New Roman",serif'                   => 'Serif: Times New Roman',
            'Monaco,Courier,monospace'                  => 'Monospace: Monaco',
        ],
        'active_callback' => [
            [
                'setting'  => 'fonts_head_source',
                'operator' => '==',
                'value'    => 'system',
            ],
            [
                'setting'  => 'fonts_head_title',
                'operator' => '==',
                'value'    => true,
            ],
        ],
        'output'          => [
            [
                'element'  => ':root',
                'property' => '--s-heading',
            ],
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'        => 'fonts_head_google',
        'label'           => 'Font Family',
        'description'     => wp_kses(
            sprintf(
                'Use font name from <a href="%1$s" target="_blank">fonts.google.com</a>, such as 
            <strong>Roboto</strong>, <strong>Open Sans</strong> (case-sensitive).',
                esc_url('https://fonts.google.com/')
            ),
            [
                'a'      => [
                    'href'   => [],
                    'target' => [],
                ],
                'strong' => [],
            ]
        ),
        'section'         => 'fonts',
        'default'         => 'IBM Plex Sans Thai',
        'active_callback' => [
            [
                'setting'  => 'fonts_head_source',
                'operator' => '==',
                'value'    => 'google',
            ],
            [
                'setting'  => 'fonts_head_title',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'        => 'fonts_head_adobe_code',
        'label'           => 'Code start with <link ...',
        'section'         => 'fonts',
        'choices'         => [
            'language' => 'html',
        ],
        'active_callback' => [
            [
                'setting'  => 'fonts_head_source',
                'operator' => '==',
                'value'    => 'adobe',
            ],
            [
                'setting'  => 'fonts_head_title',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'        => 'fonts_head_adobe',
        'label'           => 'Font Family (Only 1 name)',
        'section'         => 'fonts',
        'active_callback' => [
            [
                'setting'  => 'fonts_head_source',
                'operator' => '==',
                'value'    => 'adobe',
            ],
            [
                'setting'  => 'fonts_head_title',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'        => 'fonts_head_upload',
        'label'           => 'Font Family',
        'section'         => 'fonts',
        'active_callback' => [
            [
                'setting'  => 'fonts_head_source',
                'operator' => '==',
                'value'    => 'upload',
            ],
            [
                'setting'  => 'fonts_head_title',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Upload(
    [
        'settings'        => 'fonts_head_file',
        'label'           => 'Font File (.woff2)',
        'section'         => 'fonts',
        'active_callback' => [
            [
                'setting'  => 'fonts_head_source',
                'operator' => '==',
                'value'    => 'upload',
            ],
            [
                'setting'  => 'fonts_head_title',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Select(
    [
        'settings'        => 'fonts_head_weight',
        'label'           => 'Font Weight',
        'section'         => 'fonts',
        'default'         => '700',
        'choices'         => [
            '300' => '300: Light',
            '400' => '400: Regular',
            '500' => '500: Medium',
            '600' => '600: Semi Bold',
            '700' => '700: Bold',
        ],
        'active_callback' => [
            [
                'setting'  => 'fonts_head_title',
                'operator' => '==',
                'value'    => true,
            ],
        ],
        'output'          => [
            [
                'element'  => ':root',
                'property' => '--s-heading-weight',
            ],
        ],
    ]
);

new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings' => 'fonts_alt_head_title',
        'label'    => 'Set Alt Heading Font?',
        'section'  => 'fonts',
        'default'  => false,
        'tooltip'  => 'CSS Class: _h_alt, _heading_alt; CSS Var: --s-heading-alt, --s-heading-alt-weight',
    ]
);
new \Kirki\Field\Radio_Buttonset(
    [
        'settings'        => 'fonts_alt_head_source',
        'label'           => 'Source',
        'section'         => 'fonts',
        'default'         => 'system',
        'choices'         => [
            'system' => 'System',
            'google' => 'Google',
            'adobe'  => 'Adobe',
            'upload' => 'Upload',
        ],
        'active_callback' => [
            [
                'setting'  => 'fonts_alt_head_title',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Select(
    [
        'settings'        => 'fonts_alt_head_system',
        'label'           => 'Font Family',
        'section'         => 'fonts',
        'default'         => '-apple-system,"Helvetica Neue",sans-serif',
        'choices'         => [
            '-apple-system,"Helvetica Neue",sans-serif' => 'Sans Serif: Helvetica Neue',
            '"Times New Roman",serif'                   => 'Serif: Times New Roman',
            'Monaco,Courier,monospace'                  => 'Monospace: Monaco',
        ],
        'active_callback' => [
            [
                'setting'  => 'fonts_alt_head_source',
                'operator' => '==',
                'value'    => 'system',
            ],
            [
                'setting'  => 'fonts_alt_head_title',
                'operator' => '==',
                'value'    => true,
            ],
        ],
        'output'          => [
            [
                'element'  => ':root',
                'property' => '--s-heading-alt',
            ],
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'        => 'fonts_alt_head_google',
        'label'           => 'Font Family',
        'description'     => wp_kses(
            sprintf(
                'Use font name from <a href="%1$s" target="_blank">fonts.google.com</a>, such as 
                <strong>Roboto</strong>, <strong>Open Sans</strong> (case-sensitive).',
                esc_url('https://fonts.google.com/')
            ),
            [
                'a'      => [
                    'href'   => [],
                    'target' => [],
                ],
                'strong' => [],
            ]
        ),
        'section'         => 'fonts',
        'default'         => 'Prompt',
        'active_callback' => [
            [
                'setting'  => 'fonts_alt_head_source',
                'operator' => '==',
                'value'    => 'google',
            ],
            [
                'setting'  => 'fonts_alt_head_title',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'        => 'fonts_alt_head_adobe_code',
        'label'           => 'Code start with <link ...',
        'section'         => 'fonts',
        'choices'         => [
            'language' => 'html',
        ],
        'active_callback' => [
            [
                'setting'  => 'fonts_alt_head_source',
                'operator' => '==',
                'value'    => 'adobe',
            ],
            [
                'setting'  => 'fonts_alt_head_title',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'        => 'fonts_alt_head_adobe',
        'label'           => 'Font Family (Only 1 name)',
        'section'         => 'fonts',
        'active_callback' => [
            [
                'setting'  => 'fonts_alt_head_source',
                'operator' => '==',
                'value'    => 'adobe',
            ],
            [
                'setting'  => 'fonts_alt_head_title',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'        => 'fonts_alt_head_upload',
        'label'           => 'Font Family',
        'section'         => 'fonts',
        'active_callback' => [
            [
                'setting'  => 'fonts_alt_head_source',
                'operator' => '==',
                'value'    => 'upload',
            ],
            [
                'setting'  => 'fonts_alt_head_title',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Upload(
    [
        'settings'        => 'fonts_alt_head_file',
        'label'           => 'Font File (.woff2)',
        'section'         => 'fonts',
        'active_callback' => [
            [
                'setting'  => 'fonts_alt_head_source',
                'operator' => '==',
                'value'    => 'upload',
            ],
            [
                'setting'  => 'fonts_alt_head_title',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Select(
    [
        'settings'        => 'fonts_alt_head_weight',
        'label'           => 'Font Weight',
        'section'         => 'fonts',
        'default'         => '700',
        'choices'         => [
            '300' => '300: Light',
            '400' => '400: Regular',
            '500' => '500: Medium',
            '600' => '600: Semi Bold',
            '700' => '700: Bold',
        ],
        'active_callback' => [
            [
                'setting'  => 'fonts_alt_head_title',
                'operator' => '==',
                'value'    => true,
            ],
        ],
        'output'          => [
            [
                'element'  => ':root',
                'property' => '--s-heading-alt-weight',
            ],
        ],
    ]
);
// BRAND - ICONS

new \Kirki\Field\Radio_Buttonset(
    [
        'settings'    => 'icon_user',
        'label'       => 'User',
        'section'     => 'icons',
        'default'     => 'user',
        'choices'     => [
            'user'              => plant_icon_svg('user'),
            'user-line'         => plant_icon_svg('user-line'),
            'user-solid'        => plant_icon_svg('user-solid'),
            'user-circle'       => plant_icon_svg('user-circle'),
            'user-circle-alt'   => plant_icon_svg('user-circle-alt'),
            'custom'            => plant_icon_svg('custom')
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'        => 'icon_user_custom',
        'label'           => 'User SVG',
        'section'         => 'icons',
        'choices'         => [
            'language' => 'svg',
        ],
        'active_callback' => [
            [
                'setting'  => 'icon_user',
                'operator' => '==',
                'value'    => 'custom',
            ],
        ],
    ]
);
new \Kirki\Field\Radio_Buttonset(
    [
        'settings'    => 'icon_cart',
        'label'       => 'Cart',
        'section'     => 'icons',
        'default'     => 'cart',
        'choices'     => [
            'cart'              => plant_icon_svg('cart'),
            'cart-line'         => plant_icon_svg('cart-line'),
            'cart-solid'        => plant_icon_svg('cart-solid'),
            'basket'            => plant_icon_svg('basket'),
            'basket-alt'        => plant_icon_svg('basket-alt'),
            'custom'            => plant_icon_svg('custom')
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'        => 'icon_cart_custom',
        'label'           => 'Cart SVG',
        'section'         => 'icons',
        'choices'         => [
            'language' => 'svg',
        ],
        'active_callback' => [
            [
                'setting'  => 'icon_cart',
                'operator' => '==',
                'value'    => 'custom',
            ],
        ],
    ]
);
new \Kirki\Field\Radio_Buttonset(
    [
        'settings'    => 'icon_filter',
        'label'       => 'Filter',
        'section'     => 'icons',
        'default'     => 'filter',
        'choices'     => [
            'filter'              => plant_icon_svg('filter'),
            'filter-alt'          => plant_icon_svg('filter-alt'),
            'custom'            => plant_icon_svg('custom')
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'        => 'icon_filter_custom',
        'label'           => 'Filter SVG',
        'section'         => 'icons',
        'choices'         => [
            'language' => 'svg',
        ],
        'active_callback' => [
            [
                'setting'  => 'icon_filter',
                'operator' => '==',
                'value'    => 'custom',
            ],
        ],
    ]
);
new \Kirki\Field\Radio_Buttonset(
    [
        'settings'    => 'icon_folder',
        'label'       => 'Categories',
        'section'     => 'icons',
        'default'     => 'folder',
        'choices'     => [
            'folder'              => plant_icon_svg('folder'),
            'folder-alt'          => plant_icon_svg('folder-alt'),
            'custom'            => plant_icon_svg('custom')
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'        => 'icon_folder_custom',
        'label'           => 'Categories SVG',
        'section'         => 'icons',
        'choices'         => [
            'language' => 'svg',
        ],
        'active_callback' => [
            [
                'setting'  => 'icon_folder',
                'operator' => '==',
                'value'    => 'custom',
            ],
        ],
    ]
);
new \Kirki\Field\Radio_Buttonset(
    [
        'settings'    => 'icon_tag',
        'label'       => 'Tags',
        'section'     => 'icons',
        'default'     => 'tag',
        'choices'     => [
            'tag'              => plant_icon_svg('tag'),
            'tag-alt'          => plant_icon_svg('tag-alt'),
            'custom'            => plant_icon_svg('custom')
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'        => 'icon_tag_custom',
        'label'           => 'Tags SVG',
        'section'         => 'icons',
        'choices'         => [
            'language' => 'svg',
        ],
        'active_callback' => [
            [
                'setting'  => 'icon_tag',
                'operator' => '==',
                'value'    => 'custom',
            ],
        ],
    ]
);
new \Kirki\Field\Radio_Buttonset(
    [
        'settings'    => 'icon_date',
        'label'       => 'Date',
        'section'     => 'icons',
        'default'     => 'date',
        'choices'     => [
            'date'              => plant_icon_svg('date'),
            'date-alt'          => plant_icon_svg('date-alt'),
            'custom'            => plant_icon_svg('custom')
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'        => 'icon_date_custom',
        'label'           => 'Date SVG',
        'section'         => 'icons',
        'choices'         => [
            'language' => 'svg',
        ],
        'active_callback' => [
            [
                'setting'  => 'icon_date',
                'operator' => '==',
                'value'    => 'custom',
            ],
        ],
    ]
);
new \Kirki\Field\Radio_Buttonset(
    [
        'settings'    => 'icon_time',
        'label'       => 'Time',
        'section'     => 'icons',
        'default'     => 'time',
        'choices'     => [
            'time'              => plant_icon_svg('time'),
            'time-alt'          => plant_icon_svg('time-alt'),
            'custom'            => plant_icon_svg('custom')
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'        => 'icon_time_custom',
        'label'           => 'Time SVG',
        'section'         => 'icons',
        'choices'         => [
            'language' => 'svg',
        ],
        'active_callback' => [
            [
                'setting'  => 'icon_time',
                'operator' => '==',
                'value'    => 'custom',
            ],
        ],
    ]
);


// BRAND - SOCIAL
new \Kirki\Field\Sortable(
    [
        'settings' => 'social',
        'label'    => 'Social Network',
        'tooltip'  => 'Shortcode: [s_social]',
        'section'  => 'social',
        'default'  => [ 'facebook', 'line' ],
        'choices'  => [
            'facebook'  => 'Facebook',
            'line'      => 'Line',
            'twitter'   => 'X (Twitter)',
            'messenger' => 'Messenger',
            'instagram' => 'Instagram',
            'youtube'   => 'Youtube',
            'tiktok'    => 'TikTok',
            'pinterest' => 'Pinterest',
            'linkedin'  => 'LinkedIn',
            'custom_1'  => 'Custom 1',
            'custom_2'  => 'Custom 2',
            'custom_3'  => 'Custom 3',
        ],
    ]
);
new \Kirki\Field\Dimension(
    [
        'settings'   => 'social_size',
        'label'      => 'Icon Size',
        'section'    => 'social',
        'choices'    => [
            'accept_unitless' => false,
        ],
        'responsive' => true,
        'default'    => [
            'desktop' => '24px',
            'tablet'  => '24px',
            'mobile'  => '26px',
        ],
        'output'     => [
            [
                'element'     => '.s_social svg',
                'property'    => 'width',
                'media_query' => [
                    'desktop' => '@media (min-width: 1024px)',
                    'tablet'  => '@media (min-width: 720px) and (max-width: 1023px)',
                    'mobile'  => '@media (max-width: 719px)',
                ],
            ],
        ],
    ]
);
new \Kirki\Field\URL(
    [
        'settings'        => 'social_facebook',
        'label'           => 'Facebook URL',
        'section'         => 'social',
        'description'     => 'Example: https://fb.com/seedwebs',
        'active_callback' => [
            [
                'setting'  => 'social',
                'operator' => 'in',
                'value'    => [ 'facebook' ],
            ],
        ],
    ]
);
new \Kirki\Field\URL(
    [
        'settings'        => 'social_line',
        'label'           => 'Line URL',
        'section'         => 'social',
        'description'     => 'Example: https://line.me/R/ti/p/@seedwebs',
        'active_callback' => [
            [
                'setting'  => 'social',
                'operator' => 'in',
                'value'    => [ 'line' ],
            ],
        ],
    ]
);
new \Kirki\Field\URL(
    [
        'settings'        => 'social_twitter',
        'label'           => 'X (Twitter) URL',
        'section'         => 'social',
        'description'     => 'Example: https://twitter.com/seedwebs',
        'active_callback' => [
            [
                'setting'  => 'social',
                'operator' => 'in',
                'value'    => [ 'twitter' ],
            ],
        ],
    ]
);
new \Kirki\Field\URL(
    [
        'settings'        => 'social_messenger',
        'label'           => 'Messenger URL',
        'section'         => 'social',
        'description'     => 'Example: https://m.me/seedwebs',
        'active_callback' => [
            [
                'setting'  => 'social',
                'operator' => 'in',
                'value'    => [ 'messenger' ],
            ],
        ],
    ]
);
new \Kirki\Field\URL(
    [
        'settings'        => 'social_instagram',
        'label'           => 'Instagram URL',
        'section'         => 'social',
        'description'     => 'Example: https://instagram.com',
        'active_callback' => [
            [
                'setting'  => 'social',
                'operator' => 'in',
                'value'    => [ 'instagram' ],
            ],
        ],
    ]
);
new \Kirki\Field\URL(
    [
        'settings'        => 'social_youtube',
        'label'           => 'YouTube URL',
        'section'         => 'social',
        'description'     => 'Example: https://youtube.com/',
        'active_callback' => [
            [
                'setting'  => 'social',
                'operator' => 'in',
                'value'    => [ 'youtube' ],
            ],
        ],
    ]
);
new \Kirki\Field\URL(
    [
        'settings'        => 'social_tiktok',
        'label'           => 'TikTok URL',
        'section'         => 'social',
        'description'     => 'Example: https://tiktok.com/',
        'active_callback' => [
            [
                'setting'  => 'social',
                'operator' => 'in',
                'value'    => [ 'tiktok' ],
            ],
        ],
    ]
);
new \Kirki\Field\URL(
    [
        'settings'        => 'social_pinterest',
        'label'           => 'Pinterest URL',
        'section'         => 'social',
        'description'     => 'Example: https://www.pinterest.com/',
        'active_callback' => [
            [
                'setting'  => 'social',
                'operator' => 'in',
                'value'    => [ 'pinterest' ],
            ],
        ],
    ]
);

new \Kirki\Field\URL(
    [
        'settings'        => 'social_linkedin',
        'label'           => 'LinkedIn URL',
        'section'         => 'social',
        'description'     => 'Example: https://www.linkedin.com/',
        'active_callback' => [
            [
                'setting'  => 'social',
                'operator' => 'in',
                'value'    => [ 'linkedin' ],
            ],
        ],
    ]
);




// Loop n = 1 to 3
$i = 1;
while ($i <= 3) {
    new \Kirki\Field\URL(
        [
            'settings'        => 'social_custom_' . $i,
            'label'           => 'Custom ' . $i . ' URL',
            'section'         => 'social',
            'active_callback' => [
                [
                    'setting'  => 'social',
                    'operator' => 'in',
                    'value'    => [ 'custom_' . $i ],
                ],
            ],
        ]
    );
    new \Kirki\Field\Code(
        [
            'settings'    => 'social_icon_custom_' . $i,
            'label'       => 'Custom ' . $i . ' SVG',
            'section'     => 'social',
            'choices'     => [
                'language' => '',
            ],
            'active_callback' => [
                [
                     'setting'  => 'social',
                    'operator' => 'in',
                    'value'    => [ 'custom_' . $i ],
                ],
            ],
        ]
    );
    $i++;
}
