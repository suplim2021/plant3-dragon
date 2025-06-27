<?php

new \Kirki\Section(
    'body',
    [
        'title'    => 'Body',
        'priority' => 60,
    ]
);

// BLOG INTRO

if (get_option('show_on_front') == 'posts') {
    new \Kirki\Pro\Field\HeadlineToggle(
        [
        'settings'    => 'set_blog_intro',
        'label'       => 'Set Blog Intro?',
        'section'     => 'body',
        'default'     => false,
        ]
    );
    new \Kirki\Field\Select(
        [
        'settings' => 'blog_intro_template',
        'label'    => 'Template',
        'section'  => 'body',
        'default'  => 'photo',
        'choices'  => [
            'photo'  => 'Text & Photo',
            'text'  => 'Text Only',
            'widget' => 'Widget: Blog Introduction',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_blog_intro',
                'operator' => '==',
                'value'    => true,
            ],
        ]
        ]
    );
    new \Kirki\Field\Editor(
        [
        'settings'    => 'blog_intro_text',
        'label'       => 'Text',
        'description' => 'Use [s_social] for social icons',
        'section'     => 'body',
        'active_callback' => [
            [
                'setting'  => 'set_blog_intro',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'blog_intro_template',
                'operator' => 'in',
                'value'    => ['photo', 'text'],
            ],
        ],
        ]
    );
    new \Kirki\Field\Multicolor(
        [
        'settings'        => 'blog_intro_colors',
        'label'           => 'Text Colors',
        'section'         => 'body',
        'choices'         => [
            'text'  => 'Text & Link',
            'hover' => 'Hover',
        ],
        'alpha'           => true,
        'default'         => [
            'text'  => '#222222',
            'hover' => '#235B95',
        ],
        'output'          => [
            [
                'choice'   => 'text',
                'element'  => '.blog-intro, .blog-intro a',
                'property' => 'color',
            ],
            [
                'choice'   => 'hover',
                'element'  => '.blog-intro a:hover',
                'property' => 'color',
            ],

        ],
        'active_callback' => [
            [
                'setting'  => 'set_blog_intro',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'blog_intro_template',
                'operator' => 'in',
                'value'    => ['photo', 'text'],
            ],
        ],
        ]
    );
    new \Kirki\Field\Radio_Image(
        [
        'settings'    => 'blog_intro_layout',
        'label'       => 'Layout',
        'section'     => 'body',
        'default'     => 'text_photo',
        'choices'     => [
            'text_photo'  => get_template_directory_uri() . '/assets/img/admin/text-photo.svg',
            'photo_text'  => get_template_directory_uri() . '/assets/img/admin/photo-text.svg',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_blog_intro',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'blog_intro_template',
                'operator' => '==',
                'value'    => 'photo',
            ],
        ],
        ]
    );
    new \Kirki\Field\Image(
        [
        'settings'    => 'blog_intro_photo',
        'label'       => 'Photo',
        'section'     => 'body',
        'choices'     => [
            'save_as' => 'id',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_blog_intro',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'blog_intro_template',
                'operator' => '==',
                'value'    => 'photo',
            ],
        ],
        ]
    );
    new \Kirki\Field\Dimensions(
        [
        'settings'    => 'blog_intro_photo_width',
        'label'       => 'Photo Width',
        'section'     => 'body',
        'responsive' => true,
        'default'     => [
            'desktop' => [
                'width' => '400px',
            ],
            'tablet'  => [
                'width' => '320px',
            ],
            'mobile'  => [
                'width' => '320px',
            ]
        ],
        'choices'     => [
            'accept_unitless' => false,
        ],
        'output'     => [
            [
                'element'     => '.blog-intro-photo img',
                'media_query' => [
                    'desktop' => '@media (min-width: 1024px)',
                    'tablet'  => '@media (min-width: 720px) and (max-width: 1023px)',
                    'mobile'  => '@media (max-width: 719px)',
                ],
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'set_blog_intro',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'blog_intro_template',
                'operator' => '==',
                'value'    => 'photo',
            ],
        ],
        ]
    );
    new \Kirki\Pro\Field\Divider(
        [
        'settings' => 'blog_intro_bg_hr',
        'section'  => 'body',
        'active_callback' => [
            [
                'setting'  => 'set_blog_intro',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'blog_intro_template',
                'operator' => 'in',
                'value'    => ['photo', 'text'],
            ],
        ],
        ]
    );
    new \Kirki\Field\Background(
        [
        'settings'    => 'blog_intro_bg',
        'label'       => 'Intro Background',
        'section'     => 'body',
        'default'     => [
            'background-color'      => '#EFE7E1',
            'background-image'      => '',
            'background-repeat'     => 'repeat',
            'background-position'   => 'center center',
            'background-size'       => 'cover',
            'background-attachment' => 'scroll',
        ],
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.blog-intro',
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'set_blog_intro',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'blog_intro_template',
                'operator' => 'in',
                'value'    => ['photo', 'text'],
            ],
        ],
        ]
    );
    new \Kirki\Pro\Field\Divider(
        [
        'settings' => 'blog_intro_bg_hr_2',
        'section'  => 'body',
        'active_callback' => [
            [
                'setting'  => 'set_blog_intro',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'blog_intro_template',
                'operator' => 'in',
                'value'    => ['photo', 'text'],
            ],
        ],
        ]
    );
    new \Kirki\Field\Dimensions(
        [
        'settings'    => 'blog_intro_padding',
        'label'       => 'Intro Padding',
        'section'     => 'body',
        'responsive' => true,
        'default'     => [
            'desktop' => [
                'padding-top'    => '48px',
                'padding-right'  => '48px',
                'padding-bottom' => '0',
                'padding-left'   => '48px',
            ],
            'tablet'  => [
                'padding-top'    => '30px',
                'padding-right'  => '30px',
                'padding-bottom' => '0',
                'padding-left'   => '30px',
            ],
            'mobile'  => [
                'padding-top'    => '16px',
                'padding-right'  => '16px',
                'padding-bottom' => '0',
                'padding-left'   => '16px',
            ],
        ],
        'output'     => [
            [
                'element'     => '.blog-intro',
                'media_query' => [
                    'desktop' => '@media (min-width: 1024px)',
                    'tablet'  => '@media (min-width: 720px) and (max-width: 1023px)',
                    'mobile'  => '@media (max-width: 719px)',
                ],
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'set_blog_intro',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'blog_intro_template',
                'operator' => 'in',
                'value'    => ['photo', 'text'],
            ],
        ],
        ]
    );
    new \Kirki\Pro\Field\Divider(
        [
        'settings' => 'blog_intro_bg_hr_3',
        'section'  => 'body',
        'active_callback' => [
            [
                'setting'  => 'set_blog_intro',
                'operator' => '==',
                'value'    => true,
            ],
        ],
        ]
    );
    new \Kirki\Field\Editor(
        [
        'settings'    => 'blog_intro_latest',
        'label'       => 'Latest Text',
        'section'     => 'body',
        'default'     => '<h2 class="text-center alignwide">' . 'Latest' . '</h2>',
        'active_callback' => [
            [
                'setting'  => 'set_blog_intro',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'blog_intro_template',
                'operator' => 'in',
                'value'    => ['photo', 'text'],
            ],
        ],
        ]
    );
}




new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings'    => 'set_page',
        'label'       => 'Set Page?',
        'section'     => 'body',
        'default'  => false,
    ]
);

new \Kirki\Field\Radio_Buttonset(
    [
        'settings' => 'page_title_align',
        'label'    => 'Title Align',
        'section'  => 'body',
        'default'  => 'center',
        'choices'  => [
            'left'     => 'Left',
            'center'   => 'Center',
            // 'right'   => 'Right',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_page',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'page_show_comment',
        'label'       => 'Show Comments?',
        'section'     => 'body',
        'default'     => false,
        'active_callback' => [
            [
                'setting'  => 'set_page',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ]
);

new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings'    => 'set_single',
        'label'       => 'Set Single Post?',
        'section'     => 'body',
    ]
);
new \Kirki\Field\Select(
    [
        'settings' => 'single_title_template',
        'label'    => 'Default Title Template',
        'section'  => 'body',
        'default'  => 'default',
        'choices'  => [
            'default'  => 'Banner',
            'minimal'  => 'Minimal',
            'hero'     => 'Hero',
            'headline' => 'Headline',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_single',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'set_single_banner_height',
        'label'       => 'Limit Banner Height?',
        'section'     => 'body',
        'active_callback' => [
            [
                'setting'  => 'set_single',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'single_title_template',
                'operator' => 'in',
                'value'    => ['default'],
            ],
        ],
    ]
);
new \Kirki\Field\Dimension(
    [
        'settings'   => 'single_banner_height',
        'label'      => 'Banner Max Height',
        'section'    => 'body',
        'choices'    => [
            'accept_unitless' => false,
        ],
        'responsive' => true,
        'default'    => [
            'desktop' => '480px',
            'tablet'  => '360px',
            'mobile'  => '240px',
        ],
        'output'   => [
            [
                'element'     => '.single-pic img',
                'property'    => 'height',
                'media_query' => [
                    'desktop' => '@media (min-width: 1024px)',
                    'tablet'  => '@media (min-width: 720px) and (max-width: 1023px)',
                    'mobile'  => '@media (max-width: 719px)',
                ],
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'set_single',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'set_single_banner_height',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'   => 'single_title_template',
                'operator' => 'in',
                'value'    => ['default'],
            ],
        ],
    ]
);
new \Kirki\Field\Dimension(
    [
        'settings'   => 'single_content_width',
        'label'      => 'Content Width',
        'section'    => 'body',
        'default'     => '750px',
        'choices'    => [
            'accept_unitless' => false,
        ],
        'output'     => [
            [
                'element'     => 'body.single',
                'property'    => '--s-content-width',
                'media_query' => '@media (min-width: 720px)',
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'set_single',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'single_show_date',
        'label'       => 'Show Date?',
        'section'     => 'body',
        'default'     => true,
        'active_callback' => [
            [
                'setting'  => 'set_single',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'single_show_author',
        'label'       => 'Show Author?',
        'section'     => 'body',
        'default'     => true,
        'active_callback' => [
            [
                'setting'  => 'set_single',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ]
);
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'single_show_comment',
        'label'       => 'Show Comments?',
        'section'     => 'body',
        'default'     => false,
        'active_callback' => [
            [
                'setting'  => 'set_single',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ]
);
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'single_show_related',
        'label'       => 'Show Related Posts?',
        'section'     => 'body',
        'default'     => true,
        'active_callback' => [
            [
                'setting'  => 'set_single',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ]
);

new \Kirki\Field\Text(
    [
        'settings'        => 'single_related_title',
        'label'           => 'Related Post Title',
        'section'         => 'body',
        'default'         => 'Related Posts',
        'active_callback' => [
            [
                'setting'  => 'set_single',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'single_show_related',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ]
);

new \Kirki\Field\Number(
    [
        'settings'    => 'single_related_num',
        'label'       => 'Posts to show',
        'section'     => 'body',
        'default'     => 3,
        'active_callback' => [
            [
                'setting'  => 'set_single',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'single_show_related',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ]
);


new \Kirki\Field\Multicolor(
    [
        'settings'        => 'single_related_colors',
        'label'           => 'Colors',
        'section'         => 'body',
        'choices'         => [
            'bg'    => 'Background',
            'text'  => 'Text & Link',
            'hover' => 'Hover',
        ],
        'alpha'           => true,
        'default'         => [
            'bg'    => '#fafafc',
            'text'  => '#222222',
            'hover' => '#235B95',
        ],
        'output'          => [
            [
                'choice'   => 'bg',
                'element'  => '.single-related, .single-related .entry-info-overlap',
                'property' => 'background',
            ],
            [
                'choice'   => 'text',
                'element'  => '.single-related, .single-related a',
                'property' => 'color',
            ],
            [
                'choice'   => 'hover',
                'element'  => '.single-related .s-content:hover h2 a',
                'property' => 'color',
            ],

        ],
        'active_callback' => [
            [
                'setting'  => 'set_single',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'single_show_related',
                'operator' => '==',
                'value'    => true,
            ],

        ],
        ]
);
new \Kirki\Field\Select(
    [
        'settings' => 'single_sidebar',
        'label'    => 'Sidebar Widgets?',
        'section'  => 'body',
        'default'  => 'none',
        'choices'  => [
            'none'  => 'No Sidebar',
            'left'  => 'Left Sidebar',
            'right' => 'Right Sidebar',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_single',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings'    => 'set_archive',
        'label'       => 'Set Archive?',
        'section'     => 'body',
    ]
);
new \Kirki\Field\Number(
    [
        'settings' => 'grid_columns',
        'label'    => 'Grid Display Columns',
        'section'  => 'body',
        'responsive' => true,
        'choices'  => [
            'min'  => 1,
            'max'  => 4,
            'step' => 1,
        ],
        'default'    => [
            'desktop' => '3',
            'tablet'  => '2',
            'mobile'  => '1',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_archive',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Select(
    [
        'settings' => 'archive_sidebar',
        'label'    => 'Sidebar Widgets?',
        'section'  => 'body',
        'default'  => 'none',
        'choices'  => [
            'none'  => 'No Sidebar',
            'left'  => 'Left Sidebar',
            'right' => 'Right Sidebar',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_archive',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

// CONTENT CARD

new \Kirki\Pro\Field\HeadlineToggle(
    [
        'settings'    => 'set_content_card',
        'label'       => 'Set Content Card?',
        'section'     => 'body',
    ]
);
new \Kirki\Field\Select(
    [
        'settings' => 'content_template',
        'label'    => 'Default Content Template',
        'section'  => 'body',
        'default'  => 'default',
        'choices'  => [
            'default'  => 'Simple',
            'overlap'   => 'Overlap',
            'card'   => 'Card',
            'list'   => 'List',
            'caption'   => 'Caption',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'content_overlap_no_rounded',
        'label'       => 'No Rounded Corners',
        'section'     => 'body',
        'default'     => true,
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'content_template',
                'operator' => '==',
                'value'    => 'overlap',
            ],
        ],
    ]
);
// MAIN CATEGORY
new \Kirki\Pro\Field\Divider(
    [
        'settings' => 'content_cat_hr',
        'section'  => 'body',
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'content_cat',
        'label'       => 'Show Main Category?',
        'section'     => 'body',
        'default'     => true,
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Select(
    [
        'settings'    => 'content_cat_style',
        'label'       => 'Category Style?',
        'section'     => 'body',
        'default'     => 'f-button',
        'choices'     => [
            'f-button'  => 'Floating Button',
            'f-pill'    => 'Floating Pill',
            'i-text'    => 'Inline Text',
            'i-button'  => 'Inline Button',
            'i-pill'    => 'Inline Pill',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'content_cat',
                'operator' => '==',
                'value'    => true,
            ],
        ],
        ]
);
new \Kirki\Field\Radio_Buttonset(
    [
        'settings'    => 'main_cat',
        'label'       => 'Max categories to show',
        'section'     => 'body',
        'default'     => 'max_1',
        'choices'     => [
            'max_1'   => '1',
            'max_2'   => '2',
            'max_3'   => '3',
            'max_4'   => '4',
            'all'     => 'All',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'content_cat',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Pro\Field\Divider(
    [
        'settings' => 'content_pic_ratio_hr',
        'section'  => 'body',
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Radio_Buttonset(
    [
        'settings'    => 'content_pic_ratio',
        'label'       => 'Thumbnail Ratio',
        'description' => 'Recommend Open Graph (OG) Ratio',
        'section'     => 'body',
        'default'     => 'og',
        'choices'     => [
            'og'     => 'OG',
            '3_2'    => '3:2',
            '1_1'    => '1:1',
            '4_5'    => '4:5',
            'custom' => 'Custom',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Number(
    [
        'settings' => 'content_pic_width',
        'label'    => 'Width',
        'section'  => 'body',
        'default'  => 1200,
        'choices'  => [
            'min'  => 1,
            'step' => 1,
        ],
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'content_pic_ratio',
                'operator' => '==',
                'value'    => 'custom',
            ],
        ],
    ]
);
new \Kirki\Field\Number(
    [
        'settings' => 'content_pic_height',
        'label'    => 'Height',
        'section'  => 'body',
        'default'  => 630,
        'choices'  => [
            'min'  => 1,
            'step' => 1,
        ],
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'content_pic_ratio',
                'operator' => '==',
                'value'    => 'custom',
            ],
        ],
    ]
);
// DATE
new \Kirki\Pro\Field\Divider(
    [
        'settings' => 'content_date_hr',
        'section'  => 'body',
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'content_date',
        'label'       => 'Show Date?',
        'section'     => 'body',
        'default'     => true,
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);

// EXCERPT
new \Kirki\Pro\Field\Divider(
    [
        'settings' => 'content_excerpt_hr',
        'section'  => 'body',
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'content_excerpt',
        'label'       => 'Show Excerpt?',
        'section'     => 'body',
        'default'     => false,
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Radio_Buttonset(
    [
        'settings'    => 'content_excerpt_max',
        'label'       => 'Max Lines',
        'section'     => 'body',
        'default'     => '2',
        'choices'     => [
            '1'     => '1',
            '2'     => '2',
            '3'     => '3',
            '4'     => '4',
            'unset' => 'Unlimited',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'content_excerpt',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
// AUTHOR
new \Kirki\Pro\Field\Divider(
    [
        'settings' => 'content_author_hr',
        'section'  => 'body',
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'content_author',
        'label'       => 'Show Author?',
        'section'     => 'body',
        'default'     => false,
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Select(
    [
        'settings' => 'author_template',
        'label'    => 'Author Template',
        'section'  => 'body',
        'default'  => 'avatar',
        'choices'  => [
            'avatar'      => 'Avatar',
            'avatar_date' => 'Avatar with Date',
            'text'        => 'Text',
            'shortcode'   => 'Shortcode',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'content_author',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Code(
    [
        'settings'    => 'author_template_shortcode',
        'label'       => 'Template Shortcode',
        'section'     => 'body',
        'default'     => '[s_by] • [s_date]',
        'tooltip'     => 'HTML & SVG is allowed',
        'choices'     => [
            'language' => '',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'content_author',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'author_template',
                'operator' => '==',
                'value'    => 'shortcode',
            ],
        ],
    ]
);

// READ MORE
new \Kirki\Pro\Field\Divider(
    [
        'settings' => 'content_readmore_hr',
        'section'  => 'body',
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Checkbox(
    [
        'settings'    => 'content_readmore',
        'label'       => 'Show Read More?',
        'section'     => 'body',
        'default'     => false,
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'        => 'content_readmore_text',
        'label'           => 'Read More Text',
        'section'         => 'body',
        'default'         => 'Read More',
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'content_readmore',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
$icon_1 = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>';
$icon_2 = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>';
new \Kirki\Field\Radio_Buttonset(
    [
        'settings'    => 'content_readmore_icon',
        'label'       => 'Read More Icon',
        'section'     => 'body',
        'default'     => '',
        'choices'     => [
            ''          => 'No Icon',
            $icon_1     => $icon_1,
            $icon_2     => $icon_2,
            '→'         => '→',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'content_readmore',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Select(
    [
        'settings'    => 'content_readmore_style',
        'label'       => 'Read More Style',
        'section'     => 'body',
        'default'     => 'button',
        'choices'     => [
            'button'  => 'Button',
            'pill'    => 'Pill',
            'text'    => 'Text',
            'underline' => 'Underlined Text',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'content_readmore',
                'operator' => '==',
                'value'    => true,
            ],
        ],
        ]
);
// PLACEHOLDER
new \Kirki\Pro\Field\Divider(
    [
        'settings' => 'content_placeholder_hr',
        'section'  => 'body',
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
new \Kirki\Field\Image(
    [
        'settings'    => 'content_placeholder',
        'label'       => 'Placeholder Image',
        'tooltip'     => 'Default Featured Images',
        'section'     => 'body',
        'default'     => '',
        'choices'     => [
            'save_as' => 'id',
        ],
        'active_callback' => [
            [
                'setting'  => 'set_content_card',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ]
);
