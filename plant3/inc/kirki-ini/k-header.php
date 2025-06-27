<?php

// HEADER
new \Kirki\Section(
    'header',
    [
        'title'    => 'Header',
        'priority' => 50,
    ]
);

// TOPBAR
new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings' => 'set_topbar',
        'label'    => 'Enable Top Bar?',
        'section'  => 'header',
        'default'  => false,
    ]
);
new \Kirki\Field\Multicolor(
    [
        'settings'        => 'topbar_colors',
        'label'           => 'Top Bar Colors',
        'section'         => 'header',
        'choices'         => [
            'bg'    => 'Background',
            'text'  => 'Text',
            'hover' => 'Hover',
        ],
        'alpha'           => true,
        'default'         => [
            'bg'    => '#f5f5f7',
            'text'  => '#666666',
            'hover' => '#235B95',
        ],
        'output'    => [
            [
                'choice'   => 'bg',
                'element'  => '.top-bar',
                'property' => 'background-color',
            ],
            [
                'choice'   => 'text',
                'element'  => '.top-bar, .top-bar a',
                'property' => 'color',
            ],
            [
                'choice'   => 'hover',
                'element'  => '.top-bar a:hover',
                'property' => 'color',
            ],

        ],
        'active_callback' => [
            [
                'setting'  => 'set_topbar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Dimension(
    [
        'settings'   => 'topbar_height',
        'label'      => 'Height',
        'section'    => 'header',
        'description' => 'Set to 0px to hide on each device.',
        'choices'    => [
            'accept_unitless' => false,
        ],
        'responsive' => true,
        'default'    => [
            'desktop' => '30px',
            'tablet'  => '30px',
            'mobile'  => '30px',
        ],
        'output'     => [
            [
                'element'     => '.top-bar',
                'property'    => 'height',
                'media_query' => [
                    'desktop' => '@media (min-width: 1024px)',
                    'tablet'  => '@media (min-width: 720px) and (max-width: 1023px)',
                    'mobile'  => '@media (max-width: 719px)',
                ],
            ],
            [
                'element'     => ':root',
                'property'    => '--s-topbar-height',
                'media_query' => [
                    'desktop' => '@media (min-width: 1024px)',
                    'tablet'  => '@media (min-width: 720px) and (max-width: 1023px)',
                    'mobile'  => '@media (max-width: 719px)',
                ],
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'set_topbar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'    => 'topbar_left',
        'label'       => 'Left Text',
        'section'     => 'header',
        'default'     => '',
        'tooltip'     => 'HTML and Shortcode are allowed',
        'choices'     => [
            'language' => '',
        ],
        'active_callback' => [
             [
                'setting'  => 'set_topbar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'    => 'topbar_right',
        'label'       => 'Right Text',
        'section'     => 'header',
        'default'     => '',
        'tooltip'     => 'HTML and Shortcode are allowed',
        'choices'     => [
            'language' => '',
        ],
        'active_callback' => [
             [
                'setting'  => 'set_topbar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);



// HEADER TEMPLATE
new \Kirki\Pro\Field\Headline(
    [
        'settings'    => 'kirki_pro_headline',
        'label'       => 'Header Template',
        'section'     => 'header',
    ]
);
new \Kirki\Field\Select(
    [
        'settings' => 'header_template',
        'label'    => 'Template',
        'section'  => 'header',
        'default'  => 'minimal-standard',
        'choices'  => [
            'minimal'  => 'Minimal',
            'standard' => 'Standard (Logo Left on Mobile)',
            'standard-right' => 'Standard (Logo Right on Mobile)',
            'minimal-standard' => 'Standard (Logo Center on Mobile)',
            'center'   => 'Centered Logo',
            'shop'     => 'Shop',
            'classic'  => 'Classic',
            'leftbar' => 'Leftbar',
            'widget'   => 'Widget: Header',
        ],
    ]
);
new \Kirki\Field\Generic(
    [
        'settings'    => 'header_center_info',
        'label'       => 'Centered Logo need Left & Right menu.',
        'description' => 'Please go to Appearance → Menus. Add 2 menus and assign to Left & Right menu in Display location.',
        'section'     => 'header',
        'choices'     => [
            'element'  => 'input',
            'type'     => 'hidden',
        ],
        'active_callback' => [
            [
                'setting'  => 'header_template',
                'operator' => '==',
                'value'    => 'center',
            ],
        ],
    ]
);
new \Kirki\Field\Dimension(
    [
        'settings'   => 'header_height',
        'label'      => 'Height',
        'section'    => 'header',
        'choices'    => [
            'accept_unitless' => false,
        ],
        'responsive' => true,
        'default'    => [
            'desktop' => '70px',
            'tablet'  => '60px',
            'mobile'  => '50px',
        ],
        'output'     => [
            [
                'element'     => ':root',
                'property'    => '--s-head-height',
                'media_query' => [
                    'desktop' => '@media (min-width: 1024px)',
                    'tablet'  => '@media (min-width: 720px) and (max-width: 1023px)',
                    'mobile'  => '@media (max-width: 719px)',
                ],
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'header_template',
                'operator' => '!=',
                'value'    => 'classic',
            ],
        ],
    ]
);
new \Kirki\Field\Dimension(
    [
        'settings'   => 'header_height_classic',
        'label'      => 'Height',
        'section'    => 'header',
        'choices'    => [
            'accept_unitless' => false,
        ],
        'responsive' => true,
        'default'    => [
            'desktop' => '140px',
            'tablet'  => '60px',
            'mobile'  => '50px',
        ],
        'output'     => [
            [
                'element'     => ':root',
                'property'    => '--s-head-height',
                'media_query' => [
                    'desktop' => '@media (min-width: 1024px)',
                    'tablet'  => '@media (min-width: 720px) and (max-width: 1023px)',
                    'mobile'  => '@media (max-width: 719px)',
                ],
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'header_template',
                'operator' => '==',
                'value'    => 'classic',
            ],
        ],
    ]
);
new \Kirki\Field\Dimension(
    [
        'settings'   => 'nav_height_classic',
        'label'      => 'Nav Height on Desktop',
        'section'    => 'header',
        'default'     => '50px',
        'choices'    => [
            'accept_unitless' => false,
        ],
        'output'     => [
            [
                'element'     => ':root',
                'property'    => '--s-nav-height',
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'header_template',
                'operator' => '==',
                'value'    => 'classic',
            ],
        ],

    ]
);
new \Kirki\Field\Radio_Buttonset(
    [
        'settings'    => 'header_width',
        'label'       => 'Desktop Width',
        'section'     => 'header',
        'default'     => 'full',
        'choices'     => [
            'boxed'     => 'Boxed',
            'contained' => 'Contained',
            'full'      => 'Full',
        ],
    ]
);
new \Kirki\Field\Select(
    [
        'settings'    => 'header_effect',
        'label'       => 'Effect',
        'section'     => 'header',
        'default'     => 'none',
        'choices'     => [
            'none'      => 'No Effect',
            'fixed'     => 'Fixed on every page',
            'scroll'    => 'Slide In on Home',
            'scroll_fixed'    => 'Slide In on Home, Others are fixed',
        ],
    ]
);
new \Kirki\Field\Number(
    [
        'settings'    => 'header_effect_position',
        'label'       => 'Scroll Pixel for Effect',
        'section'     => 'header',
        'default'     => 50,
        'active_callback' => [
            [
                'setting'  => 'header_effect',
                'operator' => '!=',
                'value'    => 'none',
            ]
        ],
    ]
);
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'header_overlay',
        'label'       => 'Overlay on Home? (No Background)',
        'section'     => 'header',
        'default'    => false,
        'active_callback' => [
            [
                'setting'  => 'header_template',
                'operator' => '!=',
                'value'    => 'classic',
            ]
        ],
    ]
);
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'header_hide_brand',
        'label'       => 'Hide Brand on Home?',
        'section'     => 'header',
        'default'    => false,
        'active_callback' => [
            [
                'setting'  => 'header_overlay',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'    => 'header_search_code',
        'label'       => 'Search Shortcode',
        'section'     => 'header',
        'default'     => '[fibosearch]',
        'tooltip'     => 'HTML is allowed',
        'choices'     => [
            'language' => '',
        ],
        'active_callback' => [
            [
                'setting'  => 'header_template',
                'operator' => '==',
                'value'    => 'shop',
            ],
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'    => 'header_top_right_code',
        'label'       => 'Top Right Shortcode',
        'section'     => 'header',
        'default'     => '[s_social]',
        'tooltip'     => 'HTML is allowed',
        'choices'     => [
            'language' => '',
        ],
        'active_callback' => [
            [
                'setting'  => 'header_template',
                'operator' => '==',
                'value'    => 'classic',
            ],
        ],
    ]
);
// ACTIONS
new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings' => 'set_action_left',
        'label'    => 'Set Left Icons?',
        'section'  => 'header',
        'default'  => false,
        'active_callback' => [
            [
                'setting'  => 'header_template',
                'operator' => 'in',
                'value'    => ['minimal', 'center', 'minimal-standard', 'standard-right'],
            ],
        ],
    ]
);
new \Kirki\Field\Sortable(
    [
        'settings' => 'action_left',
        'label'    => 'Left Icons',
        'section'  => 'header',
        'default'  => [ 'search' ],
        'choices'  => [
            'menu'   => 'Menu',
            'search' => 'Search',
            'member' => 'Member',
            'cart'   => 'Cart',
            'left_custom' => 'Custom',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_action_left',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'header_template',
                'operator' => 'in',
                'value'    => ['minimal', 'center', 'minimal-standard','standard-right'],
            ],
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'    => 'action_left_custom',
        'label'       => 'Custom Shortcode',
        'section'     => 'header',
        'default'     => '',
        'tooltip'     => 'HTML is allowed',
        'choices'     => [
            'language' => '',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_action_left',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'action_left',
                'operator' => 'in',
                'value'    => ['left_custom'],
            ],
            [
                'setting'  => 'header_template',
                'operator' => 'in',
                'value'    => ['minimal', 'center', 'minimal-standard','standard-right'],
            ],
        ],
    ]
);
new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings' => 'set_action_right',
        'label'    => 'Set Right Icons?',
        'section'  => 'header',
        'default'  => false,
        'active_callback' => [
            [
                'setting'  => 'header_template',
                'operator' => 'in',
                'value'    => ['minimal','standard', 'classic', 'center', 'minimal-standard'],
            ],
        ],
    ]
);
new \Kirki\Field\Sortable(
    [
        'settings' => 'action_right',
        'label'    => 'Right Icons',
        'section'  => 'header',
        'default'  => [ 'search' ],
        'choices'  => [
            'menu'   => 'Menu',
            'search' => 'Search',
            'member' => 'Member',
            'cart'   => 'Cart',
            'right_custom' => 'Custom',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_action_right',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'header_template',
                'operator' => 'in',
                'value'    => ['minimal','standard', 'minimal-standard', 'classic', 'center'],
            ],
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'    => 'action_right_custom',
        'label'       => 'Custom Shortcode',
        'section'     => 'header',
        'default'     => '',
        'tooltip'     => 'HTML is allowed',
        'choices'     => [
            'language' => '',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_action_right',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'action_right',
                'operator' => 'in',
                'value'    => ['right_custom'],
            ],
        ],
    ]
);
new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings' => 'set_action_shop',
        'label'    => 'Set Shop Icons?',
        'section'  => 'header',
        'default'  => false,
        'active_callback' => [
            [
                'setting'  => 'header_template',
                'operator' => 'in',
                'value'    => ['shop'],
            ],
        ],
    ]
);
new \Kirki\Field\Sortable(
    [
        'settings' => 'action_shop',
        'label'    => 'Shop Icons',
        'section'  => 'header',
        'default'  => [ 'member', 'cart' ],
        'choices'  => [
            'member' => 'Member',
            'cart'   => 'Cart',
            'shop_custom' => 'Custom',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_action_shop',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'header_template',
                'operator' => 'in',
                'value'    => ['shop'],
            ],
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'    => 'action_shop_custom',
        'label'       => 'Custom Shortcode',
        'section'     => 'header',
        'default'     => '',
        'tooltip'     => 'HTML is allowed',
        'choices'     => [
            'language' => '',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_action_shop',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'action_shop',
                'operator' => 'in',
                'value'    => ['shop_custom'],
            ],
            [
                'setting'  => 'header_template',
                'operator' => 'in',
                'value'    => ['shop'],
            ],
        ],
    ]
);




// SEARCH
new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings' => 'set_search_placeholder',
        'label'    => 'Set Search Placeholder?',
        'section'  => 'header',
        'default'  => false,
        'active_callback' => [
            [
                'setting'  => 'header_template',
                'operator' => '!=',
                'value'    => 'widget',
            ],
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'        => 'search_placeholder',
        'label'           => 'Search Placeholder',
        'section'         => 'header',
        'default'         => 'Enter Search Keyword',
        'active_callback' => [
            [
                'setting'  => 'header_template',
                'operator' => '!=',
                'value'    => 'widget',
            ],
            [
                'setting'  => 'set_search_placeholder',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

// COLORS
new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings' => 'set_header_colors',
        'label'    => 'Set Header Colors?',
        'section'  => 'header',
        'default'  => false,
    ]
);
new \Kirki\Field\Multicolor(
    [
        'settings'        => 'header_colors',
        'label'           => 'Header Colors',
        'section'         => 'header',
        'choices'         => [
            'bg'    => 'Background',
            'text'  => 'Text',
            'hover' => 'Hover',
        ],
        'alpha'           => true,
        'default'         => [
            'bg'    => '#ffffff',
            'text'  => '#222222',
            'hover' => '#235B95',
        ],
        'output'    => [
            [
                'choice'   => 'bg',
                'element'  => ':root',
                'property' => '--s-head-bg',
            ],
            [
                'choice'   => 'text',
                'element'  => ':root',
                'property' => '--s-head-text',
            ],
            [
                'choice'   => 'hover',
                'element'  => ':root',
                'property' => '--s-head-hover',
            ],

        ],
        'active_callback' => [
            [
                'setting'  => 'set_header_colors',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Multicolor(
    [
        'settings'        => 'dnav_colors',
        'label'           => 'Desktop Nav Colors',
        'section'         => 'header',
        'choices'         => [
            'bg'    => 'Background',
            'text'  => 'Text',
            'hover' => 'Hover',
        ],
        'alpha'           => true,
        'default'         => [
            'bg'    => '#235B95',
            'text'  => '#ffffff',
            'hover' => '#77c8ff',
        ],
        'output'          => [
            [
                'choice'   => 'bg',
                'element'  => 'body',
                'property' => '--s-nav-bg',
                'media_query' => '@media (min-width: 1024px)',
            ],
            [
                'choice'   => 'text',
                'element'  => 'body',
                'property' => '--s-nav-text',
                'media_query' => '@media (min-width: 1024px)',
            ],
            [
                'choice'   => 'hover',
                'element'  => 'body',
                'property' => '--s-nav-hover',
                'media_query' => '@media (min-width: 1024px)',
            ],

        ],
        'active_callback' => [
            [
                'setting'  => 'set_header_colors',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'header_template',
                'operator' => '==',
                'value'    => 'classic',
            ],
        ],
    ]
);
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'set_header_alt_colors',
        'label'       => 'Different Colors for Home?',
        'section'     => 'header',
        'default'     => false,
        'active_callback' => [
            [
                'setting'  => 'set_header_colors',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Multicolor(
    [
        'settings'        => 'header_alt_colors',
        'label'           => 'Header Colors for Home',
        'section'         => 'header',
        'choices'         => [
            'bg'    => 'Background',
            'text'  => 'Text',
            'hover' => 'Hover',
        ],
        'alpha'           => true,
        'default'         => [
            'bg'    => '#ffffff',
            'text'  => '#222222',
            'hover' => '#235B95',
        ],
        'output'          => [
            [
                'choice'   => 'bg',
                'element'  => 'body.home',
                'property' => '--s-head-bg',
            ],
            [
                'choice'   => 'text',
                'element'  => 'body.home',
                'property' => '--s-head-text',
            ],
            [
                'choice'   => 'hover',
                'element'  => 'body.home',
                'property' => '--s-head-hover',
            ],

        ],
        'active_callback' => [
            [
                'setting'  => 'set_header_colors',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'set_header_alt_colors',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

new \Kirki\Field\Checkbox(
    [
        'settings'    => 'header_space',
        'label'       => 'Add space below Header',
        'section'     => 'header',
        'default'     => true,
        'active_callback' => [
            [
                'setting'  => 'set_header_colors',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings' => 'set_nav',
        'label'    => 'Set Side Menu?',
        'section'  => 'header',
        'default'  => false,
    ]
);
new \Kirki\Field\Dimension(
    [
        'settings'   => 'sidenav_width',
        'label'      => 'Side Menu Width',
        'section'    => 'header',
        'default'     => '280px',
        'choices'    => [
            'accept_unitless' => false,
        ],
        'output'     => [
            [
                'element'     => ':root',
                'property'    => '--s-nav-width',
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'set_nav',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Multicolor(
    [
        'settings'        => 'sidenav_colors',
        'label'           => 'Side Menu Colors',
        'section'         => 'header',
        'choices'         => [
            'bg'    => 'Background',
            'text'  => 'Text',
            'hover' => 'Hover',
        ],
        'alpha'           => true,
        'default'         => [
            'bg'    => '#235B95',
            'text'  => '#ffffff',
            'hover' => '#77c8ff',
        ],
        'output'          => [
            [
                'choice'   => 'bg',
                'element'  => ':root',
                'property' => '--s-nav-bg',
            ],
            [
                'choice'   => 'text',
                'element'  => ':root',
                'property' => '--s-nav-text',
            ],
            [
                'choice'   => 'hover',
                'element'  => ':root',
                'property' => '--s-nav-hover',
            ],

        ],
        'active_callback' => [
            [
                'setting'  => 'set_nav',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ]
);
