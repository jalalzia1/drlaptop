<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php
    if(tfuse_options('disable_tfuse_seo_tab')) {
        wp_title( '|', true, 'right' );
        bloginfo( 'name' );
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            echo " | $site_description";
    } else
        wp_title('');?>
    </title>
    <link href="//fonts.googleapis.com/css?family=Droid+Sans:400,700|Droid+Serif:400,700" rel="stylesheet">
    <?php tfuse_meta(); ?>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri() ?>" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php echo tfuse_options('feedburner_url', get_bloginfo_rss('rss2_url')); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php
        global $is_tf_blog_page;
        if ( is_singular() && get_option( 'thread_comments' ) )
                wp_enqueue_script( 'comment-reply' );

        tfuse_head();
        wp_head();
        tfuse_site_style();
    ?>
</head>
<body <?php body_class();?>>
    <div class="body_wrap" <?php tfuse_change_bg();?>>
        <div class="container">
            <?php tfuse_top_adds();?>
            <!-- header -->
            <div class="header  <?php tfuse_header_single();?>">
                <div class="logo">
                    <a href="<?php echo home_url(); ?>" title="<?php bloginfo('description'); ?>"></a>
                        <?php tfuse_type_logo();?>
                    </a>
                </div><!--/ .logo -->
                <!-- topmenu -->
                <?php  tfuse_menu('default');  ?>
            </div>
            <!--/ header -->
<?php 
    tfuse_header_content(); 
    tfuse_show_navibar();
    tfuse_category_ads();
    if($is_tf_blog_page) tfuse_category_on_blog_page();
?>
