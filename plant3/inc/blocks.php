<?php

// Seed Webs Block Category
function plant_block_categories($categories, $post)
{
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'seedwebs',
                'title' => __('Seed Webs', 'plant'),
            ),
        )
    );
}
add_filter('block_categories_all', 'plant_block_categories', 10, 2);

// ACF BLOCKS
// block.json is not ready yet. It loads css/jss even not used.
function register_acf_block_types()
{
    acf_register_block_type(array(
        'name'              => 'post-grid',
        'title'             => __('Post Grid'),
        'description'       => __('Custom Post Grid from Seed Webs.'),
        'render_template'   => 'blocks/post-grid/block.php',
        'category'          => 'seedwebs',
        'icon'              => '<svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><g clip-rule="evenodd" fill="currentColor" fill-rule="evenodd"><path d="m.25 2c0-.9665.7835-1.75 1.75-1.75h7c.9665 0 1.75.7835 1.75 1.75v4c0 .9665-.7835 1.75-1.75 1.75h-7c-.9665 0-1.75-.7835-1.75-1.75zm1.75-.25c-.13807 0-.25.11193-.25.25v4c0 .13807.11193.25.25.25h7c.13807 0 .25-.11193.25-.25v-4c0-.13807-.11193-.25-.25-.25z"/><path d="m.25 15c0-.9665.7835-1.75 1.75-1.75h7c.9665 0 1.75.7835 1.75 1.75v4c0 .9665-.7835 1.75-1.75 1.75h-7c-.9665 0-1.75-.7835-1.75-1.75zm1.75-.25c-.13807 0-.25.1119-.25.25v4c0 .1381.11193.25.25.25h7c.13807 0 .25-.1119.25-.25v-4c0-.1381-.11193-.25-.25-.25z"/><path d="m13.25 2c0-.9665.7835-1.75 1.75-1.75h7c.9665 0 1.75.7835 1.75 1.75v4c0 .9665-.7835 1.75-1.75 1.75h-7c-.9665 0-1.75-.7835-1.75-1.75zm1.75-.25c-.1381 0-.25.11193-.25.25v4c0 .13807.1119.25.25.25h7c.1381 0 .25-.11193.25-.25v-4c0-.13807-.1119-.25-.25-.25z"/><path d="m13.25 15c0-.9665.7835-1.75 1.75-1.75h7c.9665 0 1.75.7835 1.75 1.75v4c0 .9665-.7835 1.75-1.75 1.75h-7c-.9665 0-1.75-.7835-1.75-1.75zm1.75-.25c-.1381 0-.25.1119-.25.25v4c0 .1381.1119.25.25.25h7c.1381 0 .25-.1119.25-.25v-4c0-.1381-.1119-.25-.25-.25z"/><path d="m1.5 9.75c0-.41421.33579-.75.75-.75h5.5c.41421 0 .75.33579.75.75 0 .4142-.33579.75-.75.75h-5.5c-.41421 0-.75-.3358-.75-.75z"/><path d="m1.5 22.75c0-.4142.33579-.75.75-.75h5.5c.41421 0 .75.3358.75.75s-.33579.75-.75.75h-5.5c-.41421 0-.75-.3358-.75-.75z"/><path d="m14.5 9.75c0-.41421.3358-.75.75-.75h5.5c.4142 0 .75.33579.75.75 0 .4142-.3358.75-.75.75h-5.5c-.4142 0-.75-.3358-.75-.75z"/><path d="m14.5 22.75c0-.4142.3358-.75.75-.75h5.5c.4142 0 .75.3358.75.75s-.3358.75-.75.75h-5.5c-.4142 0-.75-.3358-.75-.75z"/></g></svg>',
        'keywords'          => array( 'post', 'grid', 'postgrid', 'seed' , 'plant' ),
    ));
    acf_register_block_type(array(
        'name'              => 'post-slider',
        'title'             => __('Post Slider'),
        'description'       => __('Custom Post Slider from Seed Webs.'),
        'render_template'   => 'blocks/post-slider/block.php',
        'category'          => 'seedwebs',
        'enqueue_style'     =>  get_template_directory_uri() . '/assets/css/ext-embla.css',
        'enqueue_script'    =>  get_template_directory_uri() . '/assets/js/extension/embla.min.js' ,
        'icon'              => '<svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><g clip-rule="evenodd" fill="#000" fill-rule="evenodd"><path d="m.25 4c0-.9665.7835-1.75 1.75-1.75h20c.9665 0 1.75.7835 1.75 1.75v10c0 .9665-.7835 1.75-1.75 1.75h-20c-.9665 0-1.75-.7835-1.75-1.75zm1.75-.25c-.13807 0-.25.11193-.25.25v10c0 .1381.11193.25.25.25h20c.1381 0 .25-.1119.25-.25v-10c0-.13807-.1119-.25-.25-.25z"/><path d="m.75 19c0-.9665.7835-1.75 1.75-1.75h3c.9665 0 1.75.7835 1.75 1.75v2c0 .9665-.7835 1.75-1.75 1.75h-3c-.9665 0-1.75-.7835-1.75-1.75zm1.75-.25c-.13807 0-.25.1119-.25.25v2c0 .1381.11193.25.25.25h3c.13807 0 .25-.1119.25-.25v-2c0-.1381-.11193-.25-.25-.25z"/><path d="m8.75 19c0-.9665.7835-1.75 1.75-1.75h3c.9665 0 1.75.7835 1.75 1.75v2c0 .9665-.7835 1.75-1.75 1.75h-3c-.9665 0-1.75-.7835-1.75-1.75zm1.75-.25c-.1381 0-.25.1119-.25.25v2c0 .1381.1119.25.25.25h3c.1381 0 .25-.1119.25-.25v-2c0-.1381-.1119-.25-.25-.25z"/><path d="m16.75 19c0-.9665.7835-1.75 1.75-1.75h3c.9665 0 1.75.7835 1.75 1.75v2c0 .9665-.7835 1.75-1.75 1.75h-3c-.9665 0-1.75-.7835-1.75-1.75zm1.75-.25c-.1381 0-.25.1119-.25.25v2c0 .1381.1119.25.25.25h3c.1381 0 .25-.1119.25-.25v-2c0-.1381-.1119-.25-.25-.25z"/><path d="m17.4697 6.46967c-.2929.29289-.2929.76777 0 1.06066l1.4696 1.46967-1.4696 1.4697c-.2929.2929-.2929.7677 0 1.0606s.7677.2929 1.0606 0l2-1.99997c.2929-.29289.2929-.76777 0-1.06066l-2-2c-.2929-.29289-.7677-.29289-1.0606 0z"/><path d="m6.53033 6.46967c.29289.29289.29289.76777 0 1.06066l-1.46967 1.46967 1.46967 1.4697c.29289.2929.29289.7677 0 1.0606s-.76777.2929-1.06066 0l-2-1.99997c-.29289-.29289-.29289-.76777 0-1.06066l2-2c.29289-.29289.76777-.29289 1.06066 0z"/></g></svg>',
        'keywords'          => array( 'post', 'slider', 'seed' , 'plant' ),
    ));
    acf_register_block_type(array(
        'name'              => 'post-carousel',
        'title'             => __('Post Carousel'),
        'description'       => __('Custom Post Carousel from Seed Webs.'),
        'render_template'   => 'blocks/post-carousel/block.php',
        'category'          => 'seedwebs',
        'enqueue_style'     =>  get_template_directory_uri() . '/assets/css/ext-embla.css',
        'enqueue_script'    =>  get_template_directory_uri() . '/assets/js/extension/embla.min.js' ,
        'icon'              => '<svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><g fill="currentColor"><path clip-rule="evenodd" d="m6.25 5c0-.9665.7835-1.75 1.75-1.75h9c.9665 0 1.75.7835 1.75 1.75v10c0 .9665-.7835 1.75-1.75 1.75h-9c-.9665 0-1.75-.7835-1.75-1.75zm1.75-.25c-.13807 0-.25.11193-.25.25v10c0 .1381.11193.25.25.25h9c.1381 0 .25-.1119.25-.25v-10c0-.13807-.1119-.25-.25-.25z" fill-rule="evenodd"/><path d="m13 20c0 .5523-.4477 1-1 1s-1-.4477-1-1 .4477-1 1-1 1 .4477 1 1z"/><path d="m16 20c0 .5523-.4477 1-1 1s-1-.4477-1-1 .4477-1 1-1 1 .4477 1 1z"/><path d="m10 20c0 .5523-.44772 1-1 1s-1-.4477-1-1 .44772-1 1-1 1 .4477 1 1z"/><g clip-rule="evenodd" fill-rule="evenodd"><path d="m3.53033 7.46967c.29289.29289.29289.76777 0 1.06066l-1.46967 1.46967 1.46967 1.4697c.29289.2929.29289.7677 0 1.0606s-.76777.2929-1.06066 0l-2-2c-.292893-.2929-.292893-.76774 0-1.06063l2-2c.29289-.29289.76777-.29289 1.06066 0z"/><path d="m20.4697 7.46967c-.2929.29289-.2929.76777 0 1.06066l1.4696 1.46967-1.4696 1.4697c-.2929.2929-.2929.7677 0 1.0606s.7677.2929 1.0606 0l2-2c.2929-.2929.2929-.76774 0-1.06063l-2-2c-.2929-.29289-.7677-.29289-1.0606 0z"/></g></g></svg>',
        'keywords'          => array( 'post', 'carousel','slider', 'seed' , 'plant' ),
    ));
    if(class_exists('woocommerce')) {
        acf_register_block_type(array(
            'name'              => 'product-grid',
            'title'             => __('Product Grid'),
            'description'       => __('Custom Product Grid from Seed Webs.'),
            'render_template'   => 'blocks/product-grid/block.php',
            'category'          => 'seedwebs',
            'icon'              => '<svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><g clip-rule="evenodd" fill="currentColor" fill-rule="evenodd"><path d="m.25 2c0-.9665.7835-1.75 1.75-1.75h7c.9665 0 1.75.7835 1.75 1.75v7c0 .9665-.7835 1.75-1.75 1.75h-7c-.9665 0-1.75-.7835-1.75-1.75zm1.75-.25c-.13807 0-.25.11193-.25.25v7c0 .13807.11193.25.25.25h7c.13807 0 .25-.11193.25-.25v-7c0-.13807-.11193-.25-.25-.25z"/><path d="m.25 15c0-.9665.7835-1.75 1.75-1.75h7c.9665 0 1.75.7835 1.75 1.75v7c0 .9665-.7835 1.75-1.75 1.75h-7c-.9665 0-1.75-.7835-1.75-1.75zm1.75-.25c-.13807 0-.25.1119-.25.25v7c0 .1381.11193.25.25.25h7c.13807 0 .25-.1119.25-.25v-7c0-.1381-.11193-.25-.25-.25z"/><path d="m13.25 2c0-.9665.7835-1.75 1.75-1.75h7c.9665 0 1.75.7835 1.75 1.75v7c0 .9665-.7835 1.75-1.75 1.75h-7c-.9665 0-1.75-.7835-1.75-1.75zm1.75-.25c-.1381 0-.25.11193-.25.25v7c0 .13807.1119.25.25.25h7c.1381 0 .25-.11193.25-.25v-7c0-.13807-.1119-.25-.25-.25z"/><path d="m13.25 15c0-.9665.7835-1.75 1.75-1.75h7c.9665 0 1.75.7835 1.75 1.75v7c0 .9665-.7835 1.75-1.75 1.75h-7c-.9665 0-1.75-.7835-1.75-1.75zm1.75-.25c-.1381 0-.25.1119-.25.25v7c0 .1381.1119.25.25.25h7c.1381 0 .25-.1119.25-.25v-7c0-.1381-.1119-.25-.25-.25z"/></g></svg>',
            'keywords'          => array( 'product', 'grid', 'woocommerce', 'seed' , 'plant' ),
        ));
        acf_register_block_type(array(
            'name'              => 'product-carousel',
            'title'             => __('Product Carousel'),
            'description'       => __('Custom Product Carousel from Seed Webs.'),
            'render_template'   => 'blocks/product-carousel/block.php',
            'category'          => 'seedwebs',
            'enqueue_style'     =>  get_template_directory_uri() . '/assets/css/ext-embla.css',
            'enqueue_script'    =>  get_template_directory_uri() . '/assets/js/extension/embla.min.js' ,
            'icon'              => '<svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><g fill="currentColor"><path clip-rule="evenodd" d="m6.25 5c0-.9665.7835-1.75 1.75-1.75h9c.9665 0 1.75.7835 1.75 1.75v10c0 .9665-.7835 1.75-1.75 1.75h-9c-.9665 0-1.75-.7835-1.75-1.75zm1.75-.25c-.13807 0-.25.11193-.25.25v10c0 .1381.11193.25.25.25h9c.1381 0 .25-.1119.25-.25v-10c0-.13807-.1119-.25-.25-.25z" fill-rule="evenodd"/><path d="m13 20c0 .5523-.4477 1-1 1s-1-.4477-1-1 .4477-1 1-1 1 .4477 1 1z"/><path d="m16 20c0 .5523-.4477 1-1 1s-1-.4477-1-1 .4477-1 1-1 1 .4477 1 1z"/><path d="m10 20c0 .5523-.44772 1-1 1s-1-.4477-1-1 .44772-1 1-1 1 .4477 1 1z"/><g clip-rule="evenodd" fill-rule="evenodd"><path d="m3.53033 7.46967c.29289.29289.29289.76777 0 1.06066l-1.46967 1.46967 1.46967 1.4697c.29289.2929.29289.7677 0 1.0606s-.76777.2929-1.06066 0l-2-2c-.292893-.2929-.292893-.76774 0-1.06063l2-2c.29289-.29289.76777-.29289 1.06066 0z"/><path d="m20.4697 7.46967c-.2929.29289-.2929.76777 0 1.06066l1.4696 1.46967-1.4696 1.4697c-.2929.2929-.2929.7677 0 1.0606s.7677.2929 1.0606 0l2-2c.2929-.2929.2929-.76774 0-1.06063l-2-2c-.2929-.29289-.7677-.29289-1.0606 0z"/></g></g></svg>',
            'keywords'          => array( 'product', 'carousel','woocommerce', 'seed' , 'plant' ),
        ));
    }
    acf_register_block_type(array(
        'name'              => 'rps-spacer',
        'title'             => __('Responsive Spacer'),
        'description'       => __('Responsive Spacer from Seed Webs.'),
        'render_template'   => 'blocks/spacer/block.php',
        'category'          => 'seedwebs',
        'icon'              => '<svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><g clip-rule="evenodd" fill="currentColor" fill-rule="evenodd"><path d="m5.91433 13.75c.41421 0 .75.3358.75.75v3.0784h3.07842c.41425 0 .75005.3358.75005.75s-.3358.75-.75005.75h-3.82842c-.19892 0-.38968-.079-.53033-.2197-.14066-.1406-.21967-.3314-.21967-.5303v-3.8284c0-.4142.33578-.75.75-.75z"/><path d="m13.7498 5.9142c0 .41422.3358.75.75.75h3.0785v3.07843c0 .41417.3358.74997.75.74997s.75-.3358.75-.74997v-3.82843c0-.19891-.079-.38967-.2197-.53033-.1406-.14065-.3314-.21967-.5303-.21967h-3.8285c-.4142 0-.75.33579-.75.75z"/><path d="m16.0303 7.96967c.2929.29289.2929.76777 0 1.06066l-6.99997 6.99997c-.29289.2929-.76777.2929-1.06066 0s-.29289-.7677 0-1.0606l7.00003-7.00003c.2929-.29289.7677-.29289 1.0606 0z"/></g></svg>',
        'keywords'          => array( 'responsive', 'spacer', 'margin', 'seed' , 'plant' ),
    ));
    acf_register_block_type(array(
        'name'              => 'event-benners',
        'title'             => __('Event Banner'),
        'description'       => __('Event Banner from Seed Webs.'),
        'render_template'   => 'blocks/event-banner/block.php',
        'category'          => 'seedwebs',
        'icon'              => '<svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><g fill="currentColor"><g clip-rule="evenodd" fill-rule="evenodd"><path d="m8 1.25c.41421 0 .75.33579.75.75v3c0 .41421-.33579.75-.75.75s-.75-.33579-.75-.75v-3c0-.41421.33579-.75.75-.75z"/><path d="m16 1.25c.4142 0 .75.33579.75.75v3c0 .41421-.3358.75-.75.75s-.75-.33579-.75-.75v-3c0-.41421.3358-.75.75-.75z"/><path d="m2.25 4.5c0-.9665.7835-1.75 1.75-1.75h16c.9665 0 1.75.7835 1.75 1.75v16.5c0 .9665-.7835 1.75-1.75 1.75h-16c-.9665 0-1.75-.7835-1.75-1.75zm1.75-.25c-.13807 0-.25.11193-.25.25v16.5c0 .1381.11193.25.25.25h16c.1381 0 .25-.1119.25-.25v-16.5c0-.13807-.1119-.25-.25-.25z"/><path d="m2.25 9c0-.41421.33579-.75.75-.75h18c.4142 0 .75.33579.75.75s-.3358.75-.75.75h-18c-.41421 0-.75-.33579-.75-.75z"/></g><path d="m13 17c0 .5523-.4477 1-1 1s-1-.4477-1-1 .4477-1 1-1 1 .4477 1 1z"/><path d="m16 15c0 .5523-.4477 1-1 1s-1-.4477-1-1 .4477-1 1-1 1 .4477 1 1z"/><path d="m10 15c0 .5523-.44772 1-1 1s-1-.4477-1-1 .44772-1 1-1 1 .4477 1 1z"/></g></svg>',
        'keywords'          => array( 'banner', 'event', 'seed' , 'plant' ),
    ));
}
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'register_acf_block_types');
}
