<?php

// OTHER

new \Kirki\Section(
    'other',
    [
        'title'    => 'Other',
        'priority' => 99,
    ]
);

new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings'    => 'set_webp',
        'label'       => 'Webp Thumbnails?',
        'description' => 'Convert Uploaded Images Thumbnails to webp?',
        'section'     => 'other',
        'default'  => false,
    ]
);

new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings'    => 'set_var',
        'label'       => 'Set Default Variables?',
        'description' => 'Override CSS Variables',
        'section'     => 'other',
        'default'  => false,
    ]
);

new \Kirki\Field\Dimension(
    [
        'settings'    => 'rounded_1',
        'label'       => 'Rounded 1',
        'description' => 'Small border-radius',
        'section'     => 'other',
        'default'     => '3px',
        'choices'     => [
            'accept_unitless' => false,
        ],
        'output'     => [
            [
                'element'     => ':root',
                'property'    => '--s-rounded-1',
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'set_var',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Dimension(
    [
        'settings'    => 'rounded_2',
        'label'       => 'Rounded 2',
        'description' => 'Large border-radius',
        'section'     => 'other',
        'default'     => '5px',
        'choices'     => [
            'accept_unitless' => false,
        ],
        'output'     => [
            [
                'element'     => ':root',
                'property'    => '--s-rounded-2',
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'set_var',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

// WRAP BODY
new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings'    => 'wrap_body',
        'label'       => 'Wrap content with #page?',
        'description' => 'For lengthy content, will slow down loading. Recommend to enable if using Adsense.',
        'section'     => 'other',
        'default'     => true,
    ]
);


// SMART SLIDER 3 PRO
new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings'    => 'ss3_license',
        'label'       => 'Own Smart Slider 3 Pro License?',
        'description' => 'Click if you would like to activate license.',
        'section'     => 'other',
        'default'     => false,
    ]
);


// ADMIN BAR
new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings'    => 'show_admin_bar',
        'label'       => 'Show Admin Bar?',
        'description' => 'Publish and exit Customizer to see a change',
        'section'     => 'other',
        'default'     => false,
    ]
);
