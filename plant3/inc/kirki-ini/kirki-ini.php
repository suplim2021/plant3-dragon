<?php

// TITLE_TAGLINE

new \Kirki\Field\Dimension(
    [
        'settings'   => 'title_size',
        'label'      => 'Font Size',
        'section'    => 'title_tagline',
        'choices'    => [
            'accept_unitless' => false,
        ],
        'responsive' => true,
        'default'    => [
            'desktop' => '24px',
            'tablet'  => '24px',
            'mobile'  => '20px',
        ],
        'output'     => [
            [
                'element'     => '.site-title',
                'property'    => 'font-size',
                'media_query' => [
                    'desktop' => '@media (min-width: 1024px)',
                    'tablet'  => '@media (min-width: 720px) and (max-width: 1023px)',
                    'mobile'  => '@media (max-width: 719px)',
                ],
            ],
        ],
    ]
);

new \Kirki\Field\Radio_Buttonset(
    [
        'settings'    => 'title_weight',
        'label'       => 'Font Weight',
        'section'     => 'title_tagline',
        'default'     => 'var(--s-heading-weight)',
        'choices'     => [
            'var(--s-heading-weight)' => 'Default',
            'normal'   => 'Normal',
            'bold'   => 'Bold',
        ],
        'output'     => [
            [
                'element'     => '.site-title',
                'property'    => 'font-weight',
            ],
        ],
    ]
);

new \Kirki\Pro\Field\Divider(
    [
        'settings' => 'title_hr_1',
        'section'  => 'title_tagline',
    ]
);
new \Kirki\Field\Code(
    [
        'settings'    => 'svg_logo',
        'label'       => 'SVG Logo',
        'description' => 'This SVG code will override image logo.',
        'section'     => 'title_tagline',
        'choices'     => [
            'language' => 'svg',
        ],
    ]
);
new \Kirki\Field\Dimension(
    [
        'settings'   => 'logo_height',
        'label'      => 'Logo Height',
        'section'    => 'title_tagline',
        'choices'    => [
            'accept_unitless' => false,
        ],
        'responsive' => true,
        'default'    => [
            'desktop' => '60px',
            'tablet'  => '40px',
            'mobile'  => '30px',
        ],
        'output'     => [
            [
                'element'     => '.site-branding img, .site-branding svg',
                'property'    => 'height',
                'media_query' => [
                    'desktop' => '@media (min-width: 1024px)',
                    'tablet'  => '@media (min-width: 720px) and (max-width: 1023px)',
                    'mobile'  => '@media (max-width: 719px)',
                ],
            ],
        ],
    ]
);
new \Kirki\Field\Checkbox(
    [
        'settings' => 'hide_title',
        'label'    => 'Hide Site Title?',
        'section'  => 'title_tagline',
        'default'  => false,
    ]
);
new \Kirki\Pro\Field\Divider(
    [
        'settings' => 'title_hr_2',
        'section'  => 'title_tagline',
    ]
);

require_once 'kirki-render.php';
// Check license has activate.
// require get_template_directory() . '/api.php';
// $plant_license = new Plant3_License_Manage(__FILE__, '', PLANT3_VERSION, 'theme', 'https://th.seedwebs.com', 'License: Plant 3', 'plant3', 'hide');

// Enable or Disble kirki field.
// $license_status = get_option('wc_am_client_plant3_activated', 'Deactivation');
// if ( $license_status == 'Activated') {
require_once 'k-brand.php';
require_once 'k-header.php';
require_once 'k-body.php';
require_once 'k-footer.php';
require_once 'k-shop.php';
require_once 'k-extensions.php';
require_once 'k-other.php';
//}
