<?php

// WOOCOMMERCE
if (class_exists('WooCommerce')) {
    new \Kirki\Section(
        'shop',
        [
        'title'    => 'More Shop Settings',
        'panel'    => 'woocommerce',
        'priority' => 83,
        ]
    );
    new \Kirki\Pro\Field\Headline(
        [
        'settings'    => 'shop_archive_headline',
        'label'       => 'Shop Page',
        'section'     => 'shop',
        ]
    );
    new \Kirki\Field\Select(
        [
        'settings'        => 'shop_bar',
        'label'           => 'Shop Sidebar',
        'section'         => 'shop',
        'default'         => 'left',
        'choices'         => [
            false       => 'No Sidebar',
            'right'     => 'Right',
            'left'      => 'Left',
        ],
        ]
    );
    new \Kirki\Field\Toggle(
        [
            'settings'    => 'shop_stickybar',
            'label'       => 'Sticky Sidebar?',
            'description' => 'On Desktop, recommended if sidebar is short.',
            'section'     => 'shop',
            'type'        => 'toggle',
            'default'     => false,
            'active_callback' => [
                [
                'setting'  => 'shop_bar',
                'operator' => '!=',
                'value'    => false,
                ],
            ],
        ]
    );

    new \Kirki\Field\Toggle(
        [
        'settings'    => 'shop_custom_page',
        'label'       => 'Custom Shop Page?',
        'description' => 'Show only page content, disable products list on Shop page.',
        'section'     => 'shop',
        'type'        => 'toggle',
        'default'     => false,
        ]
    );
    new \Kirki\Field\Toggle(
        [
        'settings'    => 'shop_hide_add_to_cart',
        'label'       => 'Remove Add to Cart in Product Grid?',
        'description' => 'Publish and reload page.',
        'section'     => 'shop',
        'type'        => 'toggle',
        'default'     => false,
        ]
    );
    new \Kirki\Field\Toggle(
        [
        'settings'    => 'shop_hide_filter_button',
        'label'       => 'Remove Filter Button on Mobile?',
        'description' => 'Always show Shop Sidebar on mobile.',
        'section'     => 'shop',
        'type'        => 'toggle',
        'default'     => false,
        'active_callback' => [
            [
            'setting'  => 'shop_bar',
            'operator' => '!=',
            'value'    => false,
            ],
        ],
        ]
    );
    new \Kirki\Pro\Field\Headline(
        [
        'settings'    => 'shop_single_headline',
        'label'       => 'Single Product Page',
        'section'     => 'shop',
        ]
    );
    new \Kirki\Field\Toggle(
        [
        'settings'    => 'shop_breadcrumb_center',
        'label'       => 'Breadcrumb - Align Center?',
        'description' => 'On Archive & Product Pages',
        'section'     => 'shop',
        'type'        => 'toggle',
        'default'     => false,
        ]
    );
    new \Kirki\Field\Toggle(
        [
        'settings'    => 'shop_hide_tab',
        'label'       => 'Remove Product Tabs?',
        'description' => 'On Product Page',
        'section'     => 'shop',
        'type'        => 'toggle',
        'default'     => true,
        ]
    );
    new \Kirki\Field\Toggle(
        [
        'settings'    => 'shop_hide_review',
        'label'       => 'Remove Product Review?',
        'description' => 'Publish and reload page.',
        'section'     => 'shop',
        'type'        => 'toggle',
        'default'     => true,
        ]
    );
    new \Kirki\Field\Toggle(
        [
        'settings'    => 'shop_hide_related',
        'label'       => 'Remove Related Products?',
        'description' => 'Publish and reload page.',
        'section'     => 'shop',
        'type'        => 'toggle',
        'default'     => false,
        ]
    );
    new \Kirki\Field\Toggle(
        [
        'settings'    => 'shop_enable_add_to_line',
        'label'       => 'Enable Chat on LINE?',
        'description' => 'Add "Chat on LINE" button.',
        'section'     => 'shop',
        'type'        => 'toggle',
        'default'     => false,
        ]
    );
    new \Kirki\Field\Text(
        [
            'settings' => 'add_to_line_button_text',
            'label'    => 'Chat on LINE Button Text',
            'section'  => 'shop',
            'default'  => 'Chat on LINE',
            'active_callback' => [
                [
                    'setting'  => 'shop_enable_add_to_line',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    );
    new \Kirki\Field\Text(
        [
            'settings' => 'line_contact_link',
            'label'    => 'Line OA Accont',
            'description'     => 'Example: @seedwebs',
            'section'  => 'shop',
            'default'  => '',
            'active_callback' => [
                [
                    'setting'  => 'shop_enable_add_to_line',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    );
    new \Kirki\Pro\Field\Headline(
        [
        'settings'    => 'shop_checkout_headline',
        'label'       => 'Checkout Page',
        'section'     => 'shop',
        ]
    );
    new \Kirki\Field\Toggle(
        [
        'settings'    => 'shop_th_style',
        'label'       => 'Use Thai Style?',
        'description' => 'Require Address 2 (แขวง/ตำบล).',
        'section'     => 'shop',
        'default'     => true,
        ]
    );
    new \Kirki\Field\Toggle(
        [
        'settings'    => 'shop_address_filter',
        'label'       => 'Thai Address from Postal Code',
        'description' => 'Hide other fields. Show only Postal Code.',
        'section'     => 'shop',
        'default'     => false,
        ]
    );
    new \Kirki\Field\Text(
        [
            'settings' => 'shop_billing_filter_position',
            'label'    => 'Billing Position',
            'description'     => 'Use #billing_address_1_field to show after this field.',
            'section'  => 'shop',
            'default'  => '#billing_address_1_field',
            'active_callback' => [
                [
                    'setting'  => 'shop_address_filter',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    );
    new \Kirki\Field\Text(
        [
            'settings' => 'shop_shipping_filter_position',
            'label'    => 'Shipping Position',
            'description'     => 'Use #shipping_address_1_field to show after this field.',
            'section'  => 'shop',
            'default'  => '#shipping_address_1_field',
            'active_callback' => [
                [
                    'setting'  => 'shop_address_filter',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    );
    new \Kirki\Field\Text(
        [
            'settings' => 'shop_filter_label_text_before',
            'label'    => 'Label Text Before',
            'description'     => '',
            'section'  => 'shop',
            'default'  => 'ที่อยู่และรหัสไปรษณีย์',
            'active_callback' => [
                [
                    'setting'  => 'shop_address_filter',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    );
    new \Kirki\Field\Text(
        [
            'settings' => 'shop_filter_label_text_after',
            'label'    => 'Label Text After',
            'description'     => '',
            'section'  => 'shop',
            'default'  => 'รหัสไปรษณีย์',
            'active_callback' => [
                [
                    'setting'  => 'shop_address_filter',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    );
    new \Kirki\Pro\Field\Headline(
        [
        'settings'    => 'shop_myaccount_headline',
        'label'       => 'My Account Page',
        'section'     => 'shop',
        ]
    );
    new \Kirki\Field\Toggle(
        [
        'settings'    => 'shop_hide_downloads',
        'label'       => 'Hide Downloads Menu',
        'description' => 'Publish and reload page.',
        'section'     => 'shop',
        'type'        => 'toggle',
        'default'     => true,
        ]
    );
    new \Kirki\Field\Code(
        [
        'settings'    => 'shop_dashboard_begin',
        'label'       => 'Dashboard Begin',
        'tooltip'     => 'HTML & Shortcode allowed',
        'section'     => 'shop',
        'default'     => '',
        'choices'     => [
            'language' => '',
        ],
        ]
    );
    new \Kirki\Field\Editor(
        [
        'settings'    => 'shop_announcement',
        'label'       => 'Dashboard Announcement',
        'section'     => 'shop',
        'default'     => '',
        ]
    );
    new \Kirki\Field\Code(
        [
        'settings'    => 'shop_dashboard_end',
        'label'       => 'Dashboard End',
        'tooltip'     => 'HTML & Shortcode allowed',
        'section'     => 'shop',
        'default'     => '[s_myaccount]',
        'choices'     => [
            'language' => '',
        ],
        ]
    );
    new \Kirki\Field\Toggle(
        [
        'settings'    => 'shop_hide_recent_order',
        'label'       => 'Hide Recent Order',
        'description' => 'Hide recent order on dashboad page.',
        'section'     => 'shop',
        'type'        => 'toggle',
        'default'     => false,
        ]
    );
    new \Kirki\Pro\Field\Headline(
        [
        'settings'    => 'shop_other_headline',
        'label'       => 'Other Settings',
        'section'     => 'shop',
        ]
    );
    new \Kirki\Field\Toggle(
        [
        'settings'    => 'shop_remove_css',
        'label'       => 'Remove Default CSS?',
        'description' => 'Publish and reload page.',
        'section'     => 'shop',
        'default'     => true,
        ]
    );
    new \Kirki\Field\Toggle(
        [
        'settings'    => 'shop_remove_cart_ajax',
        'label'       => 'Remove Cart Ajax Count ?',
        'description' => 'Count in cart will update on reload website only.',
        'section'     => 'shop',
        'default'     => false,
        ]
    );
}
