<?php

new \Kirki\Section(
    'footer',
    [
        'title'    => 'Footer',
        'priority' => 90,
    ]
);
// FOOTER WIDGET
new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings' => 'set_footer_widget',
        'label'    => 'Enable Footer Widget?',
        'description' => 'Go to Appearance → Widgets → Footer, and add some widgets.',
        'section'  => 'footer',
        'default'  => false,
    ]
);
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'set_footer_widget_full',
        'label'    => 'Full Width?',
        'section'  => 'footer',
        'default'  => true,
        'active_callback' => [
            [
                'setting'  => 'set_footer_widget',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
// COLORS
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'set_footer_widget_colors',
        'label'    => 'Set Colors?',
        'section'  => 'footer',
        'default'  => false,
        'active_callback' => [
            [
                'setting'  => 'set_footer_widget',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Multicolor(
    [
        'settings'        => 'footer_widget_colors',
        'label'           => 'Colors',
        'section'         => 'footer',
        'choices'         => [
            'bg'    => 'Background',
            'text'  => 'Text',
            'hover' => 'Hover',
        ],
        'alpha'           => true,
        'default'         => [
            'bg'    => '#f7f7f9',
            'text'  => '#222222',
            'hover' => '#235B95',
        ],
        'output'          => [
            [
                'choice'   => 'bg',
                'element'  => '.footer-widgets',
                'property' => 'background',
            ],
            [
                'choice'   => 'text',
                'element'  => '.footer-widgets,.footer-widgets a:not(.wp-element-button)',
                'property' => 'color',
            ],
            [
                'choice'   => 'hover',
                'element'  => '.footer-widgets a:hover',
                'property' => 'color',
            ],

        ],
        'active_callback' => [
            [
                'setting'  => 'set_footer_widget',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'set_footer_widget_colors',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'set_footer_widget_padding',
        'label'    => 'Set Padding?',
        'section'  => 'footer',
        'default'  => false,
        'active_callback' => [
            [
                'setting'  => 'set_footer_widget',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Dimensions(
    [
        'settings'    => 'footer_widget_padding',
        'label'       => 'Padding',
        'section'     => 'footer',
        'responsive' => true,
        'default'     => [
            'desktop' => [
                'padding-top'    => '48px',
                'padding-bottom' => '48px',
            ],
            'tablet'  => [
                'padding-top'    => '30px',
                'padding-bottom' => '30px',
            ],
            'mobile'  => [
                'padding-top'    => '16px',
                'padding-bottom' => '16px',
            ],
        ],
        'output'     => [
            [
                'element'     => '.footer-widgets',
                'media_query' => [
                    'desktop' => '@media (min-width: 1024px)',
                    'tablet'  => '@media (min-width: 720px) and (max-width: 1023px)',
                    'mobile'  => '@media (max-width: 719px)',
                ],
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'set_footer_widget',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'set_footer_widget_padding',
                'operator' => '==',
                'value'    => true,
            ],
        ],
        ]
);

// FOOTER BAR
new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings' => 'set_footer_bar',
        'label'    => 'Enable Footer Bar?',
        'section'  => 'footer',
        'default'  => true,
    ]
);
$text = '©[s_current_year] All rights reserved.';
new \Kirki\Field\Code(
    [
        'settings'        => 'footer_bar_text',
        'label'           => 'Text',
        'section'         => 'footer',
        'tooltip'         => 'HTML & Shortcode is allowed',
        'choices'     => [
            'language' => '',
        ],
        'default'         => $text,
        'active_callback' => [
            [
                'setting'  => 'set_footer_bar',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ]
);
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'footer_bar_text_uppercase',
        'label'    => 'Uppercase Text?',
        'section'  => 'footer',
        'default'  => true,
        'active_callback' => [
            [
                'setting'  => 'set_footer_bar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'        => 'footer_bar_icons',
        'label'           => 'Social Icons',
        'section'         => 'footer',
        'tooltip'         => 'HTML & Shortcode is allowed',
        'default'         => '[s_social]',
        'choices'     => [
            'language' => '',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_footer_bar',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ]
);
// COLORS
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'set_footer_bar_colors',
        'label'    => 'Set Footer Bar Colors?',
        'section'  => 'footer',
        'default'  => false,
        'active_callback' => [
            [
                'setting'  => 'set_footer_bar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Multicolor(
    [
        'settings'        => 'footer_bar_colors',
        'label'           => 'Footer Bar Colors',
        'section'         => 'footer',
        'choices'         => [
            'bg'    => 'Background',
            'text'  => 'Text',
            'hover' => 'Hover',
        ],
        'alpha'           => true,
        'default'         => [
            'bg'    => '#f5f5f7',
            'text'  => '#222222',
            'hover' => '#235B95',
        ],
        'output'          => [
            [
                'choice'   => 'bg',
                'element'  => '.footer-bar',
                'property' => '--s-bg-2',
            ],
            [
                'choice'   => 'text',
                'element'  => '.footer-bar',
                'property' => '--s-text-1',
            ],
            [
                'choice'   => 'hover',
                'element'  => '.footer-bar',
                'property' => '--s-color-1',
            ],

        ],
        'active_callback' => [
            [
                'setting'  => 'set_footer_bar',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'set_footer_bar_colors',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
