<?php

new \Kirki\Panel(
    'extensions',
    [
        'title' => 'Extensions',
        'priority' => 98,
    ]
);
new \Kirki\Section(
    'css_js',
    [
        'title' => 'Scripts & Styles',
        'panel' => 'extensions',
    ]
);
new \Kirki\Section(
    'sales_page',
    [
        'title' => 'Sales Page',
        'panel' => 'extensions',
    ]
);
new \Kirki\Section(
    'chat_buttons',
    [
        'title' => 'Chat Buttons',
        'panel' => 'extensions',
    ]
);
new \Kirki\Section(
    'cookie_consent',
    [
        'title' => 'Cookie Consent',
        'panel' => 'extensions',
    ]
);
new \Kirki\Section(
    'rellax',
    [
        'title' => 'Parallax Effect',
        'panel' => 'extensions',
    ]
);
new \Kirki\Section(
    'lightgallery',
    [
        'title' => 'Lightbox Gallery',
        'panel' => 'extensions',
    ]
);

if (class_exists('WooCommerce')) {
    new \Kirki\Section(
        'woo_postcode_filter',
        [
            'title' => 'WooCommerce Thai Postcode',
            'panel' => 'extensions',
        ]
    );
}

// CSS JS
new \Kirki\Pro\Field\Headline(
    [
        'settings'    => 'h_code_fe',
        'label'       => 'Frontend',
        'section'     => 'css_js',
    ]
);
new \Kirki\Field\Code(
    [
        'settings'    => 'fe_code_css',
        'label'       => 'Frontend CSS',
        'section'     => 'css_js',
        'choices'     => [
            'language' => 'css',
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'    => 'fe_code_header',
        'label'       => 'Header Script',
        'description' => 'Output this HTML code before </head>',
        'section'     => 'css_js',
        'choices'     => [
            'language' => 'html',
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'    => 'fe_code_footer',
        'label'       => 'Footer Script',
        'description' => 'Output this HTML code before </body>',
        'section'     => 'css_js',
        'choices'     => [
            'language' => 'html',
        ],
    ]
);
new \Kirki\Pro\Field\Headline(
    [
        'settings'    => 'h_code_be',
        'label'       => 'Backend (wp-admin)',
        'section'     => 'css_js',
    ]
);
new \Kirki\Field\Code(
    [
        'settings'    => 'be_code_css',
        'label'       => 'Backend CSS',
        'section'     => 'css_js',
        'choices'     => [
            'language' => 'css',
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'    => 'be_code_js',
        'label'       => 'Backend JS',
        'section'     => 'css_js',
        'choices'     => [
            'language' => 'js',
        ],
    ]
);

// CHAT BUTTONS
new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings'    => 'buttons_enable',
        'label'       => 'Enable Chat Buttons?',
        'description' => 'Publish and refresh to see the result.',
        'section'     => 'chat_buttons',
        'default'  => false,
    ]
);
new \Kirki\Field\Radio_Buttonset(
    [
        'settings' => 'buttons_icon',
        'label'    => 'Chat Icon',
        'section'  => 'chat_buttons',
        'default'  => 'chat',
        'choices'  => [
            'chat'      => '<svg fill="none" height="24" viewBox="0 0 40 40" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m17.3333 4c-8.09998 0-14.66664 5.96933-14.66664 13.3333 0 3.7822 1.74417 7.1837 4.52864 9.6068-.39939 1.308-1.23251 2.6088-2.76302 3.7682-.00086.0009-.00173.0018-.0026.0026-.12624.048-.23492.1333-.31165.2444s-.11789.243-.11804.378c0 .1768.07024.3464.19526.4714.12503.1251.2946.1953.47141.1953.04555-.0006.09093-.0058.13541-.0156 2.58676-.0076 4.79384-1.1125 6.54953-2.4974.8331.3389 1.7027.6182 2.6093.8125-.4053-1.1467-.6276-2.3675-.6276-3.6328 0-6.6174 5.9814-12 13.3334-12 1.8426 0 3.5992.3385 5.1979.9505-.928-6.55201-7.0726-11.6172-14.5313-11.6172zm9.3334 13.3333c-2.829 0-5.5421.9834-7.5425 2.7337s-3.1242 4.1243-3.1242 6.5997c0 2.4753 1.1238 4.8493 3.1242 6.5996 2.0004 1.7504 4.7135 2.7337 7.5425 2.7337 1.3638-.0019 2.7146-.2326 3.9791-.6797 1.6352 1.1423 3.614 1.9895 5.8802 1.9974.0462.0102.0934.0154.1407.0156.1768 0 .3463-.0702.4714-.1952.125-.1251.1952-.2946.1952-.4714-.0002-.1365-.0423-.2695-.1205-.3813s-.1889-.1968-.317-.2437c-1.2202-.9265-2.0023-1.9462-2.4713-2.9844 1.8641-1.7285 2.9044-4.0141 2.9088-6.3906 0-2.4754-1.1238-4.8494-3.1242-6.5997s-4.7135-2.7337-7.5424-2.7337z" fill="currentColor"/></svg>',
            'question'  => '<svg fill="none" height="24" viewBox="0 0 40 40" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m8.33334 11.7949c0-1.5319.47793-3.08583 1.42316-4.66183.9452-1.57599 2.3365-2.87646 4.1526-3.91243s3.9403-1.55395 6.3724-1.55395c2.2515 0 4.2482.42981 5.9687 1.30047 1.7311.85963 3.0587 2.03887 4.0039 3.5267.9453 1.48783 1.4126 3.09688 1.4126 4.83824 0 1.3776-.2655 2.5789-.8072 3.6038-.5416 1.036-1.1789 1.9287-1.9117 2.6781-.7434.7494-2.0604 2.0168-3.9827 3.7912-.531.4959-.9558.9368-1.2744 1.3225-.3187.3747-.5523.7274-.7116 1.036-.1593.3196-.2762.6282-.3611.9478-.085.3196-.2124.8706-.3824 1.6641-.2973 1.6752-1.2213 2.5238-2.7719 2.5238-.8072 0-1.4869-.2755-2.0392-.8265-.5522-.5511-.8284-1.3666-.8284-2.4467 0-1.3556.2018-2.5348.6054-3.5267s.9452-1.8625 1.6143-2.612c.6691-.7494 1.5719-1.6421 2.7083-2.678.9983-.9038 1.7099-1.5871 2.1559-2.0499.4461-.4629.8178-.9699 1.1152-1.543.308-.562.4567-1.1792.4567-1.8405 0-1.2894-.4673-2.38049-1.3913-3.27318-.924-.8927-2.1241-1.33354-3.5791-1.33354-1.71 0-2.9738.45186-3.781 1.34456-.8071.89269-1.4975 2.21516-2.0497 3.95656-.5311 1.8294-1.5294 2.7331-3.0056 2.7331-.8709 0-1.60374-.3196-2.20911-.9588-.59475-.6171-.90275-1.3004-.90275-2.0499zm11.39586 26.5385c-.9452 0-1.7736-.3197-2.4852-.9589s-1.0621-1.5319-1.0621-2.6781c0-1.0139.3399-1.8735 1.0302-2.5678.6797-.6944 1.5294-1.036 2.5171-1.036.9771 0 1.8055.3527 2.4746 1.036.6691.6943.9983 1.5539.9983 2.5678 0 1.1352-.3505 2.0169-1.0514 2.6671-.701.6502-1.5081.9699-2.4215.9699z" fill="currentColor"/></svg>',
            'comment'   => '<svg fill="none" height="24" viewBox="0 0 40 40" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m8.75001 5.83331c-2.97661 0-5.41667 2.44005-5.41667 5.41669v14.1666c0 2.9767 2.44006 5.4167 5.41667 5.4167h1.24999v4.5833c0 1.6384 2.0228 2.6492 3.3333 1.6667l8.3334-6.25h9.5833c2.9766 0 5.4167-2.44 5.4167-5.4167v-14.1666c0-2.97664-2.4401-5.41669-5.4167-5.41669zm0 2.5h22.49999c1.6251 0 2.9167 1.29162 2.9167 2.91669v14.1666c0 1.6251-1.2916 2.9167-2.9167 2.9167h-10c-.2706.0001-.5339.0881-.7503.2507l-7.9997 5.9993v-5c0-.3315-.1317-.6494-.3661-.8838-.2345-.2344-.5524-.3662-.8839-.3662h-2.49999c-1.62505 0-2.91667-1.2916-2.91667-2.9167v-14.1666c0-1.62507 1.29162-2.91669 2.91667-2.91669zm4.16669 5.83169c-.1657-.0023-.3301.0283-.4838.09-.1537.0618-.2936.1535-.4116.2698s-.2116.2549-.2756.4077c-.0639.1529-.0968.3169-.0968.4825 0 .1657.0329.3297.0968.4825.064.1528.1576.2914.2756.4077s.2579.208.4116.2698.3181.0924.4838.09h14.1666c.1657.0024.3301-.0282.4839-.09.1537-.0618.2936-.1535.4115-.2698.118-.1163.2117-.2549.2756-.4077s.0968-.3168.0968-.4825c0-.1656-.0329-.3296-.0968-.4825-.0639-.1528-.1576-.2914-.2756-.4077-.1179-.1163-.2578-.208-.4115-.2698-.1538-.0617-.3182-.0923-.4839-.09zm0 5.8334c-.1657-.0024-.3301.0282-.4838.09-.1537.0617-.2936.1534-.4116.2698-.118.1163-.2116.2548-.2756.4077-.0639.1528-.0968.3168-.0968.4825 0 .1656.0329.3296.0968.4824.064.1529.1576.2914.2756.4078.118.1163.2579.208.4116.2697.1537.0618.3181.0924.4838.0901h10.8333c.1657.0023.3301-.0283.4838-.0901.1537-.0617.2936-.1534.4116-.2697.118-.1164.2116-.2549.2756-.4078.0639-.1528.0968-.3168.0968-.4824 0-.1657-.0329-.3297-.0968-.4825-.064-.1529-.1576-.2914-.2756-.4077-.118-.1164-.2579-.2081-.4116-.2698-.1537-.0618-.3181-.0924-.4838-.09z" fill="currentColor"/></svg>',
            'talk'      => '<svg fill="none" height="24" viewBox="0 0 40 40" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m6.66668 5c-1.83334 0-3.33334 1.5-3.33334 3.33333v17.98827c0 .7417.89753 1.1142 1.42253.5892l3.57747-3.5775h14.99996c1.8334 0 3.3334-1.5 3.3334-3.3333v-11.66667c0-1.83333-1.5-3.33333-3.3334-3.33333zm23.33332 8.3333v6.6667c0 3.6817-2.985 6.6667-6.6667 6.6667h-10v1.6666c0 1.8334 1.5 3.3334 3.3334 3.3334h15l3.5775 3.5774c.525.525 1.4225.1525 1.4225-.5892v-17.9882c0-1.8334-1.5-3.3334-3.3334-3.3334z" fill="currentColor"/></svg>',
            'custom'    => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.25 11.5C7.6625 11.5 8 11.8375 8 12.25C8 12.6625 7.6625 13 7.25 13M7.25 11.5C6.8375 11.5 6.5 11.8375 6.5 12.25C6.5 12.6625 6.8375 13 7.25 13M7.25 11.5V13M11.75 11.5C12.1625 11.5 12.5 11.8375 12.5 12.25C12.5 12.6625 12.1625 13 11.75 13M11.75 11.5C11.3375 11.5 11 11.8375 11 12.25C11 12.6625 11.3375 13 11.75 13M11.75 11.5V13M16.75 11.5C17.1625 11.5 17.5 11.8375 17.5 12.25C17.5 12.6625 17.1625 13 16.75 13M16.75 11.5C16.3375 11.5 16 11.8375 16 12.25C16 12.6625 16.3375 13 16.75 13M16.75 11.5V13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>'
        ],
        'active_callback' => [
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Image(
    [
        'settings'    => 'buttons_custom_image',
        'label'       => 'Custom Icon Image',
        'tooltip'     => 'Size: 80px Square',
        'section'     => 'chat_buttons',
        'default'     => '',
        'active_callback' => [
            [
                'setting'  => 'buttons_icon',
                'operator' => '==',
                'value'    => 'custom',
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Color(
    [
        'settings'    => 'buttons_icon_color',
        'label'       => 'Chat Icon Background',
        'section'     => 'chat_buttons',
        'default'  => '#0A7CFF',
        'transport' => 'auto',
        'output' => [
            [
                'element'  => '#s-chat',
                'property' => '--s-accent',
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_icon_message',
        'label'       => 'Chat Message',
        'section'     => 'chat_buttons',
        'default'  => 'Message us',
        'active_callback' => [
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Sortable(
    [
        'settings'    => 'buttons_channels',
        'label'       => 'Channels',
        'section'     => 'chat_buttons',
        'default'     => [
            'messenger',
            'line',
            'mobile'
        ],
        'choices'     => [
            'messenger'         => 'Facebook Messenger',
            'facebook'          => 'Facebook Page',
            'twitter'           => 'X (Twitter)',
            'line'              => 'Line',
            'phone'             => 'Phone',
            'mobile'            => 'Mobile',
            'email'             => 'Email',
            'custom_1'          => 'Custom 1',
            'custom_2'          => 'Custom 2',
            'custom_3'          => 'Custom 3',
            'custom_4'          => 'Custom 4',
        ],
        'active_callback' => [
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings' => 'buttons_use_chat_plugin',
        'label'    => 'Messenger - Use Chat Plugin?',
        'section'  => 'chat_buttons',
        'default'  => false,
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['messenger'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_messenger_url',
        'label'       => 'Messenger URL',
        'description' => 'Example: https://m.me/seedwebs',
        'section'     => 'chat_buttons',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['messenger'],
            ],
            [
                'setting'  => 'buttons_use_chat_plugin',
                'operator' => '==',
                'value'    => false,
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings' => 'buttons_messenger_tooltip',
        'label'    => 'Messenger Tooltip',
        'section'  => 'chat_buttons',
        'default'  => 'Messenger',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['messenger'],
            ],
            [
                'setting'  => 'buttons_use_chat_plugin',
                'operator' => '==',
                'value'    => false,
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_messenger_id',
        'label'       => 'Messenger: Facebook Page ID',
        'description' => 'Please read https://docs.seedwebs.com/article/51-chat-buttons-plant.',
        'section'     => 'chat_buttons',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['messenger'],
            ],
            [
                'setting'  => 'buttons_use_chat_plugin',
                'operator' => '==',
                'value'    => '1',
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_line_url',
        'label'       => 'Line URL',
        'description' => 'Example: https://line.me/R/ti/p/@seedwebs',
        'section'     => 'chat_buttons',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['line'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_line_tooltip',
        'label'       => 'Line Tooltip',
        'section'     => 'chat_buttons',
        'default'     => 'Line',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['line'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_facebook_url',
        'label'       => 'Facebook Page URL',
        'description' => 'Example: https://fb.com/seedwebs',
        'section'     => 'chat_buttons',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['facebook'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings' => 'buttons_facebook_tooltip',
        'label'    => 'Facebook Tooltip',
        'section'  => 'chat_buttons',
        'default'  => 'Facebook',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['facebook'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_mobile_url',
        'label'       => 'Mobile No.',
        'description' => 'Example: 081-234-5678',
        'section'     => 'chat_buttons',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['mobile'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings' => 'buttons_mobile_tooltip',
        'label'    => 'Mobile Tooltip',
        'section'  => 'chat_buttons',
        'default'  => 'Mobile',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['mobile'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_phone_url',
        'label'       => 'Phone No.',
        'description' => 'Example: 02-123-4567',
        'section'     => 'chat_buttons',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['phone'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_phone_tooltip',
        'label'       => 'Phone Tooltip',
        'section'     => 'chat_buttons',
        'default'     => 'Phone',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['phone'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_twitter_url',
        'label'       => 'X (Twitter) URL',
        'description' => 'Example: https://twitter.com/seedwebs',
        'section'     => 'chat_buttons',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['twitter'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_twitter_tooltip',
        'label'       => 'X (Twitter) Tooltip',
        'section'     => 'chat_buttons',
        'default'     => 'X (Twitter)',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['twitter'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_email_url',
        'label'       => 'Email',
        'description' => 'Example: support@seedwebs.com',
        'section'     => 'chat_buttons',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['email'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_email_tooltip',
        'label'       => 'Email Tooltip',
        'section'     => 'chat_buttons',
        'default'     => 'Email',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['email'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Image(
    [
        'settings'    => 'buttons_custom_1_icon',
        'label'       => 'Custom 1 Icon',
        'tooltip'     => 'Size: 120px Square',
        'section'     => 'chat_buttons',
        'default'     => '',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['custom_1'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_custom_1_url',
        'label'       => 'Custom 1 URL',
        'section'     => 'chat_buttons',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['custom_1'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_custom_1_tooltip',
        'label'       => 'Custom 1 Tooltip',
        'section'     => 'chat_buttons',
        'default'     => 'Custom 1',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['custom_1'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Image(
    [
        'settings'    => 'buttons_custom_2_icon',
        'label'       => 'Custom 2 Icon',
        'tooltip'     => 'Size: 120px Square',
        'section'     => 'chat_buttons',
        'default'     => '',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['custom_2'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_custom_2_url',
        'label'       => 'Custom 2 URL',
        'section'     => 'chat_buttons',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['custom_2'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_custom_2_tooltip',
        'label'       => 'Custom 2 Tooltip',
        'section'     => 'chat_buttons',
        'default'     => 'Custom 2',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['custom_2'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Image(
    [
        'settings'    => 'buttons_custom_3_icon',
        'label'       => 'Custom 3 Icon',
        'tooltip'     => 'Size: 120px Square',
        'section'     => 'chat_buttons',
        'default'     => '',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['custom_3'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_custom_3_url',
        'label'       => 'Custom 3 URL',
        'section'     => 'chat_buttons',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['custom_3'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_custom_3_tooltip',
        'label'       => 'Custom 3 Tooltip',
        'section'     => 'chat_buttons',
        'default'     => 'Custom 3',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['custom_3'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Image(
    [
        'settings'    => 'buttons_custom_4_icon',
        'label'       => 'Custom 4 Icon',
        'tooltip'     => 'Size: 120px Square',
        'section'     => 'chat_buttons',
        'default'     => '',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['custom_4'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_custom_4_url',
        'label'       => 'Custom 4 URL',
        'section'     => 'chat_buttons',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['custom_4'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => 'buttons_custom_4_tooltip',
        'label'       => 'Custom 4 Tooltip',
        'section'     => 'chat_buttons',
        'default'     => 'Custom 4',
        'active_callback' => [
            [
                'setting'  => 'buttons_channels',
                'operator' => 'in',
                'value'    => ['custom_4'],
            ],
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings'    => 'buttons_on_landing_page',
        'label'       => 'Show on Landing Page?',
        'description'    => 'For Page Template: Landing',
        'section'     => 'chat_buttons',
        'default'     => false,
        'priority'    => 20,
        'active_callback' => [
            [
                'setting'  => 'buttons_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);

// COOKIE CONSENT
new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings'    => 'consent_enable',
        'label'       => 'Enable Cookie Consent?',
        'section'     => 'cookie_consent',
        'default'  => false,
    ]
);
new \Kirki\Field\Textarea(
    [
        'settings' => 'consent_message',
        'label'    => 'Message',
        'section'  => 'cookie_consent',
        'default'  => (get_locale() == 'th') ?
        'เว็บไซต์นี้ใช้คุกกี้ (Cookies) เพื่อพัฒนาประสบการณ์ของผู้ใช้ให้ดียิ่งขึ้น ตาม' :
        'We use cookies to enhance your browsing experience according to our',
        'active_callback' => [
            [
                'setting'  => 'consent_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings' => 'policy_Link',
        'label'    => 'Privacy Policy Link',
        'section'  => 'cookie_consent',
        'default'  => '/privacy/',
        'active_callback' => [
            [
                'setting'  => 'consent_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings' => 'policy_Link_text',
        'label'    => 'Privacy Policy Link Text',
        'section'  => 'cookie_consent',
        'default'  => (get_locale() == 'th') ? 'นโยบายความเป็นส่วนตัว' : 'Privacy Policy.',
        'active_callback' => [
            [
                'setting'  => 'consent_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings' => 'accept_text',
        'label'    => 'Accept Text',
        'section'  => 'cookie_consent',
        'default'  => (get_locale() == 'th') ? 'ยอมรับ' : 'ACCEPT',
        'active_callback' => [
            [
                'setting'  => 'consent_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings' => 'reject_text',
        'label'    => 'Reject Text',
        'section'  => 'cookie_consent',
        'default'  => (get_locale() == 'th') ? 'ไม่ยอมรับ' : 'REJECT',
        'active_callback' => [
            [
                'setting'  => 'consent_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Radio_Buttonset(
    [
        'settings' => 'consent_position',
        'label'    => 'Position',
        'section'  => 'cookie_consent',
        'default'  => 'system',
        'default'  => 'left',
        'choices'  => [
            'left' => 'Left',
            'right' => 'Right',
        ],
        'active_callback' => [
            [
                'setting'  => 'consent_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings' => 'analytics',
        'label'    => 'Google Analytics Tracking ID',
        'description' => 'Example: G-AB12CD34EF',
        'section'  => 'cookie_consent',
        'active_callback' => [
            [
                'setting'  => 'consent_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings' => 'facebook_pixel',
        'label'    => 'Facebook Pixel ID',
        'description' => 'Example: 990123456789012',
        'section'  => 'cookie_consent',
        'active_callback' => [
            [
                'setting'  => 'consent_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings' => 'googletagmanager',
        'label'    => 'Google Tag Manager',
        'description' => 'Example: G-FH87DE17XF',
        'section'  => 'cookie_consent',
        'active_callback' => [
            [
                'setting'  => 'consent_enable',
                'operator' => '==',
                'value'    => '1',
            ]
        ],
    ]
);

// PARALLAX
new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings'    => 'rellax_enable',
        'label'       => 'Enable Rellax.js?',
        'description' => 'From: dixonandmoe.com/rellax.',
        'section'     => 'rellax',
        'default'  => false,
    ]
);

// LIGHTGALLERY
new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings'    => 'lightgallery_enable',
        'label'       => 'Enable lightGallery.js?',
        'description' => 'From: ightgalleryjs.com.',
        'section'     => 'lightgallery',
        'default'  => false,
    ]
);
