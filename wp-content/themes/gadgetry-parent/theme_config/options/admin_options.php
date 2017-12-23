<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for admin area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    'tabs' => array(
        array(
            'name' => __('General', 'tfuse'),
            'type' => 'tab',
            'id' => TF_THEME_PREFIX . '_general',
            'headings' => array(
                array(
                    'name' => __('General Settings', 'tfuse'),
                    'options' => array(/* 1 */
                        array(
                            'name' => __('Logo type', 'tfuse'),
                            'desc' => __('Choose your preferred.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_choose_logo',
                            'value' => 'text',
                            'options' =>  array('custom' => __('Custom Logo', 'tfuse'), 'text' => __('Text Logo', 'tfuse')),
                            'type' => 'select'
                        ),
                        // Custom Logo Option
                        array(
                            'name' => __('Custom Logo', 'tfuse'),
                            'desc' => __('Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo',
                            'value' => '',
                            'type' => 'upload'
                        ),
                         // Custom Logo Text Option
                        array(
                            'name' => __('Text Logo', 'tfuse'),
                            'desc' => __('Enter your text for logo', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo_text',
                            'value' => 'Gadgetry',
                            'type' => 'text'
                        ),
                        array(
                            'name' => __('Logo Subtitle', 'tfuse'),
                            'desc' => __('Enter your text for logo subtitle', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo_text_subtitle',
                            'value' => 'Just another Themefuse Theme',
                            'type' => 'text',
                            'divider' => true
                        ),
                        
                        // Custom Favicon Option
                        array(
                            'name' => __('Custom Favicon <br /> (16px x 16px)', 'tfuse'),
                            'desc' => __('Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_favicon',
                            'value' => '',
                            'type' => 'upload',
                            'divider' => true
                        ),
						//date
						array(
                            'name' => __('Disable Date', 'tfuse'),
                            'desc' => __('Disable date across the site.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_date_time',
                            'value' => 'false',
                            'type' => 'checkbox',
							'divider' => true
                        ),
                        
                        // Tracking Code Option
                        array(
                            'name' => __('Tracking Code', 'tfuse'),
                            'desc' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_google_analytics',
                            'value' => '',
                            'type' => 'textarea',
                            'divider' => true
                        ),
                        // Custom CSS Option
                        array(
                            'name' => __('Custom CSS', 'tfuse'),
                            'desc' => __('Quickly add some CSS to your theme by adding it to this block.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_css',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    ) /* E1 */
                ),
                array(
                    'name' => __('RSS', 'tfuse'),
                    'options' => array(
                        // RSS URL Option
                        array('name' => __('RSS URL', 'tfuse'),
                            'desc' => __('Enter your preferred RSS URL. (Feedburner or other)', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_feedburner_url',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true
                        ),
                        // E-Mail URL Option
                        array('name' => __('E-Mail URL', 'tfuse'),
                            'desc' => __('Enter your preferred E-mail subscription URL. (Feedburner or other)', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_feedburner_id',
                            'value' => '',
                            'type' => 'text'
                        )
                    )
                ),
                array(
                    'name' => __('Twitter', 'tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Consumer Key', 'tfuse'),
                            'desc' => __('Set your <a href="http://screencast.com/t/zHu17C7nXy1">twitter</a> application <a href="http://screencast.com/t/yb44HiF2NZ">consumer key</a>.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_twitter_consumer_key',
                            'value' => 'XW7t8bECoR6ogYtUDNdjiQ',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('Consumer Secret', 'tfuse'),
                            'desc' => __('Set your <a href="http://screencast.com/t/zHu17C7nXy1">twitter</a> application <a href="http://screencast.com/t/eaKJHG1omN">consumer secret key</a>.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_twitter_consumer_secret',
                            'value' => 'Z7UzuWU8a4obyOOlIguuI4a5JV4ryTIPKZ3POIAcJ9M',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('User Token', 'tfuse'),
                            'desc' => __('Set your <a href="http://screencast.com/t/zHu17C7nXy1">twitter</a> application <a href="http://screencast.com/t/QEEG2O4H">access token key</a>.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_twitter_user_token',
                            'value' => '1510587853-ugw6uUuNdNMdGGDn7DR4ZY4IcarhstIbq8wdDud',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('User Secret', 'tfuse'),
                            'desc' => __('Set your <a href="http://screencast.com/t/zHu17C7nXy1">twitter</a>  application <a href="http://screencast.com/t/Yv7nwRGsz">access token secret key</a>.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_twitter_user_secret',
                            'value' => '7aNcpOUGtdKKeT1L72i3tfdHJWeKsBVODv26l9C0Cc',
                            'type' => 'text'
                        )
                    )
                ),
                array(
                    'name' => __('Disable Theme settings', 'tfuse'),
                    'options' => array(
                        // Disable Image for All Single Posts
                        array('name' => __('Image on Single Post', 'tfuse'),
                            'desc' => __('Disable Image on All Single Posts? These settings may be overridden for individual articles.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_image',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable Video for All Single Posts
                        array('name' => __('Video on Single Post', 'tfuse'),
                            'desc' => __('Disable Video on All Single Posts? These settings may be overridden for individual articles.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_video',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable Comments for All Posts
                        array('name' => __('Post Comments', 'tfuse'),
                            'desc' => __('Disable Comments for All Posts? These settings may be overridden for individual articles.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_posts_comments',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable Comments for All Pages
                        array('name' => __('Page Comments', 'tfuse'),
                            'desc' => __('Disable Comments for All Pages? These settings may be overridden for individual articles.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_pages_comments',
                            'value' => 'true',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable Author Info
                        array('name' => __('Author Info', 'tfuse'),
                            'desc' => __('Disable Author Info? These settings may be overridden for individual articles.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_author_info',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable Post Meta
                        array('name' => __('Post meta', 'tfuse'),
                            'desc' => __('Disable Post meta? These settings may be overridden for individual articles.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_post_meta',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable Post Published Date
                        array('name' => __('Post Published Date', 'tfuse'),
                            'desc' => __('Disable Post Published Date? These settings may be overridden for individual articles.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_published_date',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable posts lightbox (prettyPhoto) Option
                        array('name' => 'prettyPhoto on Categories',
                            'desc' => __('Disable opening image and attachemnts in prettyPhoto on Categories listings? If YES, image link go to post.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_listing_lightbox',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable posts lightbox (prettyPhoto) Option
                        array('name' => 'prettyPhoto on Single Post',
                            'desc' => __('Disable opening image and attachemnts in prettyPhoto on Single Post?', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_single_lightbox',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable SEO
                        array('name' => __('SEO Tab', 'tfuse'),
                            'desc' => __('Disable SEO option?', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_tfuse_seo_tab',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'on_update' => 'reload_page',
                            'divider' => true
                        ),
                        // Enable Dynamic Image Resizer Option
                        array('name' => __('Dynamic Image Resizer', 'tfuse'),
                            'desc' => __('This will Disable the thumb.php script that dynamicaly resizes images on your site. We recommend you keep this enabled, however note that for this to work you need to have "GD Library" installed on your server. This should be done by your hosting server administrator.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_resize',
                            'value' => 'false',
                            'type' => 'checkbox'
                        ),
                        array('name' => __('Image from content', 'tfuse'),
                            'desc' => __('If no thumbnail is specified then the first uploaded image in the post is used.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_content_img',
                            'value' => 'false',
                            'type' => 'checkbox'
                        ),
                        // Remove wordpress versions for security reasons
                        array(
                            'name' => __('Remove Wordpress Versions', 'tfuse'),
                            'desc' => __('Remove Wordpress versions from the source code, for security reasons.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_remove_wp_versions',
                            'value' => FALSE,
                            'type' => 'checkbox'
                        )
                    )
                ),
                array(
                    'name' => __('WordPress Admin Style', 'tfuse'),
                    'options' => array(
                        // Disable Themefuse Style
                        array('name' => __('Disable Themefuse Style', 'tfuse'),
                            'desc' => __('Disable Themefuse Style', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_deactivate_tfuse_style',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'on_update' => 'reload_page'
                        )
                    )
                )
            )
        ),
        array(
            'name' => __('Homepage', 'tfuse'),
            'id' => TF_THEME_PREFIX . '_homepage',
            'headings' => array(
                array(
                    'name' => __('Homepage Population', 'tfuse'),
                    'options' => array(
                        array('name' => __('Homepage Population', 'tfuse'),
                            'desc' => ' Select which categories to display on homepage. More over you can choose to load a specific page or change the number of posts on the homepage from <a target="_blank" href="' . network_admin_url('options-reading.php') . '">here</a>',
                            'id' => TF_THEME_PREFIX . '_homepage_category',
                            'value' => '',
                            'options' => array('all' => __('From All Categories','tfuse'), 'specific' => __('From Specific Categories','tfuse'),'page' =>__('From Specific Page', 'tfuse')),
                            'type' => 'select',
                            'install' => 'cat'
                        ),
                        array(
                            'name' => __('Select specific categories to display on homepage', 'tfuse'),
                            'desc' => __('Pick one or more
                            categories by starting to type the category name.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_categories_select_categ',
                            'type' => 'multi',
                            'subtype' => 'category',
                        ),
                        // page on homepage
                        array('name' => __('Select Page', 'tfuse'),
                            'desc' => __('Select the page', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_home_page',
                            'value' => 'image',
                            'options' =>tfuse_list_page_options(),
                            'type' => 'select',
                        ),
                        array('name' => __('Use page options', 'tfuse'),
                            'desc' => __('Use page options', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_use_page_options',
                            'value' => 'false',
                            'type' => 'checkbox'
                        )
                    )
                ),
                array(
                    'name' => __('Homepage Header', 'tfuse'),
                    'options' => array(
                        // Color title 
                        array('name' => __('Title Color', 'tfuse'),
                            'desc' => __('Change post title color.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_title_color',
                            'value' => '',
                            'type' => 'colorpicker'
                        ),
                            // Navibar Color
                        array('name' => __('Custom Navibar Color', 'tfuse'),
                            'desc' => __('Choose a custom navibar color.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_color_navibar_cat',
                            'value' => '',
                            'type' => 'colorpicker'
                        ),
                        // Element of Hedear
                        array('name' => __('Element of Hedear', 'tfuse'),
                            'desc' => __('Select type of element on the header.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_element',
                            'value' => 'without',
                            'options' => array('without' => __('Without Header Element', 'tfuse'),'map' => __('Map on Header', 'tfuse'),'slider' => __('Slider on Header', 'tfuse')),
                            'type' => 'select',
                        ),
                        // Select Slider
                        $this->ext->slider->model->has_sliders() ?
                                array(
                            'name' => __('Slider', 'tfuse'),
                            'desc' => __('Select a slider for your post. The sliders are created on the', 'tfuse') . '<a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">' . __('Sliders page', 'tfuse') . '</a>.',
                            'id' => TF_THEME_PREFIX . '_select_slider',
                            'value' => '',
                            'options' => $TFUSE->ext->slider->get_sliders_dropdown(),
                            'type' => 'select'
                                ) :
                                array(
                            'name' => __('Slider', 'tfuse'),
                            'desc' => '',
                            'id' => TF_THEME_PREFIX . '_select_slider',
                            'value' => '',
                            'html' => __('No sliders created yet. You can start creating one', 'tfuse') . '<a href="' . admin_url('admin.php?page=tf_slider_list') . '">' . __('here', 'tfuse') . '</a>.',
                            'type' => 'raw'
                                )
                        ,
                        array(
                            'name' => __('Map position', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_page_map',
                            'value' => '',
                            'type' => 'maps'
                        )
                    )
                ),
                array(
                    'name' => __('Homepage Banners', 'tfuse'),
                    'options' => array(
                        //top ad
                        array('name' => __('Enable 728x90 Banner ', 'tfuse'),
                            'desc' => __('Enable the top banner ad space. Note: you can set a specific banner for all categories and posts in the <a href="', 'tfuse') . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>',
                            'id' => TF_THEME_PREFIX . '_home_top_ad_space',
                            'value' => 'false',
                            'options' => array('false' => __('No', 'tfuse'), 'true' => __('Yes', 'tfuse')),
                            'type' => 'select',
                        ),
                        array(
                            'name'=>__('Ad Image(728px x 90px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 728x90 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_top_ad_image',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_top_ad_url',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_top_ad_adsense',
                            'value' => '',
                            'type' =>'textarea',
                        ),
                        //Advertising
                        array('name' => __('Enable 125x125 Banners', 'tfuse'),
                            'desc' => __('Enable before content banner space. Note: you can set specific banners for all categories and posts in the <a href="', 'tfuse') . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>',
                            'id' => TF_THEME_PREFIX . '_home_bfcontent_ads_space',
                            'value' => 'false',
                            'options' => array('false' => __('No', 'tfuse'), 'true' => __('Yes', 'tfuse')),
                            'type' => 'select'
                        ),
                        array('name' => __('Type of Ads', 'tfuse'),
                            'desc' => __('Choose the type of your adds.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_home_bfcontent_type',
                            'value' => 'image',
                            'options' => array('image' => __('Image Type', 'tfuse'), 'adsense' => __('Adsense Type', 'tfuse')),
                            'type' => 'select'
                        ),
                        array('name' => __('No of 125x125 Ads', 'tfuse'),
                            'desc' => __('Choose the numbers of ads to display before content.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_home_bfcontent_number',
                            'value' => '7',
                            'options' => array('one' => '1', 'two' => '2' , 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7'),
                            'type' => 'select'
                        ),
                        array(
                            'name'=>__('Ad Image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image1',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url1',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code for Before Content Ads', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense1',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad Image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image2',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url2',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code for Before Content Ads', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense2',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad Image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image3',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url3',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code for Before Content Ads', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense3',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad Image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image4',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url4',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code for Before Content Ads', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense4',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad Image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image5',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url5',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code for Before Content Ads', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense5',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad Image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image6',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url6',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code for Before Content Ads', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense6',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad Image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image7',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url7',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code for Before Content Ads', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense7',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        //hook manager
                        array('name' => __('Enable 468x60 Banner ', 'tfuse'),
                            'desc' => __('Enable after content banner space. Note: you can set a specific banner for all categories and posts in the <a href="', 'tfuse') . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>',
                            'id' => TF_THEME_PREFIX . '_home_hook_space',
                            'value' => 'false',
                            'options' => array('false' => __('No', 'tfuse'), 'true' => __('Yes', 'tfuse')),
                            'type' => 'select',
                        ),
                        array(
                            'name'=>__('Ad Image(468px x 60px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 468x60 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_hook_image',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_hook_url',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_hook_adsense',
                            'value' => '',
                            'type' =>'textarea',
                        )
                    )
                ),
                array(
                    'name' => __('Homepage Shortcodes', 'tfuse'),
                    'options' => array(
                        // Top Shortcodes
                        array('name' => __('Shortcodes before Content', 'tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_top',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Bottom Shortcodes
                        array('name' => __('Shortcodes after Content', 'tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_bottom',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    )
                )
            )
        ),
        array(
            'name' => __('Blog', 'tfuse'),
            'id' => TF_THEME_PREFIX . '_blogpage',
            'headings' => array(
                array(
                    'name' => __('Blog Page Population', 'tfuse'),
                    'options' => array(
                        // Select the Blog Page
                        array('name' => __('Select Blog Page', 'tfuse'),
                            'desc' => __('Select the blog page', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_page',
                            'value' => 'image',
                            'options' => tfuse_list_page_options(),
                            'type' => 'select',
                            'divider' => true
                        ),
                        array('name' => __('Blog Page Population', 'tfuse'),
                            'desc' => ' Select which categories to display on blogpage. More over you can choose to load a specific page or change the number of posts on the blogpage from <a target="_blank" href="' . network_admin_url('options-reading.php') . '">here</a>',
                            'id' => TF_THEME_PREFIX . '_blogpage_category',
                            'value' => '',
                            'options' => array('all' => __('From All Categories','tfuse'), 'specific' => __('From Specific Categories','tfuse')),
                            'type' => 'select',
                            'install' => 'cat'
                        ),
                        array(
                            'name' => __('Select specific categories to display on blogpage', 'tfuse'),
                            'desc' => __('Pick one or more
                            categories by starting to type the category name.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_categories_select_categ_blog',
                            'type' => 'multi',
                            'subtype' => 'category',
                        )
                    )
                ),
                array(
                    'name' => __('Blog Page Header', 'tfuse'),
                    'options' => array(
                         // Color title 
                        array('name' => __('Title Color', 'tfuse'),
                            'desc' => __('Change post title color.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_title_color_blog',
                            'value' => '',
                            'type' => 'colorpicker'
                        ),
                            // Navibar Color
                        array('name' => __('Custom Navibar Color', 'tfuse'),
                            'desc' => __('Choose a custom navibar color.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_color_navibar_cat_blog',
                            'value' => '',
                            'type' => 'colorpicker'
                        ),
                        // Element of Hedear
                        array('name' => __('Element of Hedear', 'tfuse'),
                            'desc' => __('Select type of element on the header.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_element_blog',
                            'value' => 'without',
                            'options' => array('without' => __('Without Header Element', 'tfuse'),'map' => __('Map on Header', 'tfuse'),'slider' => __('Slider on Header', 'tfuse')),
                            'type' => 'select',
                        ),
                        // Select Slider
                        $this->ext->slider->model->has_sliders() ?
                                array(
                            'name' => __('Slider', 'tfuse'),
                            'desc' => __('Select a slider for your post. The sliders are created on the', 'tfuse') . '<a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">' . __('Sliders page', 'tfuse') . '</a>.',
                            'id' => TF_THEME_PREFIX . '_select_slider_blog',
                            'value' => '',
                            'options' => $TFUSE->ext->slider->get_sliders_dropdown(),
                            'type' => 'select'
                                ) :
                                array(
                            'name' => __('Slider', 'tfuse'),
                            'desc' => '',
                            'id' => TF_THEME_PREFIX . '_select_slider_blog',
                            'value' => '',
                            'html' => __('No sliders created yet. You can start creating one', 'tfuse') . '<a href="' . admin_url('admin.php?page=tf_slider_list') . '">' . __('here', 'tfuse') . '</a>.',
                            'type' => 'raw'
                                )
                        ,
                       array(
                            'name' => __('Map position', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_page_map_blog',
                            'value' => '',
                            'type' => 'maps'
                        )
                    )
                ),
                array(
                    'name' => __('Blog Page Banners', 'tfuse'),
                    'options' => array(
                        //top ad
                        array('name' => __('Enable 728x90 banner ', 'tfuse'),
                            'desc' => __('Enable the top banner ad space. Note: you can set a specific banner for all categories and posts in the <a href="', 'tfuse') . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>',
                            'id' => TF_THEME_PREFIX . '_blog_top_ad_space',
                            'value' => 'false',
                            'options' => array('false' => __('No', 'tfuse'), 'true' => __('Yes', 'tfuse')),
                            'type' => 'select',
                        ),
                        array(
                            'name'=>__('Ad image(728px x 90px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 728x90 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_top_ad_image',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_top_ad_url',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense code', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_top_ad_adsense',
                            'value' => '',
                            'type' =>'textarea',
                        ),
                        //Advertising
                        array('name' => __('Enable 125x125 banners', 'tfuse'),
                            'desc' => __('Enable before content banner space. Note: you can set specific banners for all categories and posts in the <a href="', 'tfuse') . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>',
                            'id' => TF_THEME_PREFIX . '_blog_bfcontent_ads_space',
                            'value' => 'false',
                            'options' => array('false' => __('No', 'tfuse'), 'true' => __('Yes', 'tfuse')),
                            'type' => 'select'
                        ),
                        array('name' => __('Type of ads', 'tfuse'),
                            'desc' => __('Choose the type of your adds.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_bfcontent_type',
                            'value' => 'image',
                            'options' => array('image' => __('Image Type', 'tfuse'), 'adsense' => __('Adsense Type', 'tfuse')),
                            'type' => 'select'
                        ),
                        array('name' => __('No of 125x125 ads', 'tfuse'),
                            'desc' => __('Choose the numbers of ads to display before content.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_bfcontent_number',
                            'value' => '7',
                            'options' => array('one' => '1', 'two' => '2' , 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7'),
                            'type' => 'select'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image1',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url1',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense code for before content ads', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense1',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image2',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url2',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense code for before content ads', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense2',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image3',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url3',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense code for before content ads', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense3',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image4',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url4',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense code for before content ads', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense4',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image5',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url5',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense code for before content ads', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense5',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image6',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url6',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense code for before content ads', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense6',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image7',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url7',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense code for before content ads', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense7',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        //hook manager
                        array('name' => __('Enable 468x60 banner ', 'tfuse'),
                            'desc' => __('Enable after content banner space. Note: you can set a specific banner for all categories and posts in the <a href="', 'tfuse') . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>',
                            'id' => TF_THEME_PREFIX . '_blog_hook_space',
                            'value' => 'false',
                            'options' => array('false' => __('No', 'tfuse'), 'true' => __('Yes', 'tfuse')),
                            'type' => 'select',
                        ),
                        array(
                            'name'=>__('Ad image(468px x 60px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 468x60 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_hook_image',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_hook_url',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense code', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_hook_adsense',
                            'value' => '',
                            'type' =>'textarea',
                        )
                    )
                ),
                array(
                    'name' => __('Blog Page Shortcodes', 'tfuse'),
                    'options' => array(
                        array('name' => __('Shortcodes before Content', 'tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_content_top',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Bottom Shortcodes
                        array('name' => __('Shortcodes after Content', 'tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_content_bottom',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    )
                ),
            )
        ),
        array(
            'name' => __('Theme Style', 'tfuse'),
            'id' => TF_THEME_PREFIX . '_theme_style',
            'headings' => array(
                array(
                    'name' => __('Theme Style', 'tfuse'),
                    'options' => array(
                        // Theme Stylesheet Option
                        array(
                            'name' => __('Theme Stylesheet', 'tfuse'),
                            'desc' => __('Please select your colour scheme here.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_theme_stylesheet',
                            'value' => 'default',
                            'options' =>  array('default' => 'default', 'brown' => __('Brown', 'tfuse'), 'green' => __('Green', 'tfuse'),'purple' => 'Purple','custom' => __('Custom Color Style', 'tfuse')),
                            'type' => 'select'
                        ),
                        //  Body Background
                        array('name' => __('Body Background', 'tfuse'),
                            'desc' => __('Background image for site.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_bg_site',
                            'value' => '',
                            'type' => 'upload'
                        ),
                        array('name' => __('Background Repeat', 'tfuse'),
                                'desc' => __('Select type of background repeat.', 'tfuse'),
                                'id' => TF_THEME_PREFIX . '_bg_repeat',
                                'value' => 'no-repeat',
                                'options' => array('repeat' => 'repeat','no-repeat' => 'no-repeat','repeat-x' => 'repeat-x','repeat-y' => 'repeat-y'),
                                'type' => 'select'
                        ),
                        // Theme Color
                        array('name' => __('Theme Color', 'tfuse'),
                            'desc' => __('BG Color of Header, Footer.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_bg_color',
                            'value' => '',
                            'type' => 'colorpicker'
                        ),
                        // Navibar Color
                        array('name' => __('Navibar Color', 'tfuse'),
                            'desc' => __('Select navibar color.Note: you can override it from a specific category.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_navibar_color',
                            'value' => 'same',
                            'options' =>  array('same' => __('Same as Theme Color', 'tfuse'), 'style2' => __('Style 3 (Blue)', 'tfuse'), 'custom' => __('Custom Color', 'tfuse')),
                            'type' => 'select'
                        ),
                         // Navibar Color
                        array('name' => __('Custom Navibar Color', 'tfuse'),
                            'desc' => __('Choose a custom navibar color.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_color_navibar',
                            'value' => '',
                            'type' => 'colorpicker'
                        ),
                         // Border Color
                        array('name' => __('Border Color of Active Menu Items', 'tfuse'),
                            'desc' => __('Pick the Border Color of Active Menu Items.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_color_active',
                            'value' => '',
                            'type' => 'colorpicker'
                        ),
                        // Main Title Color
                        array('name' => __('Main Title Color', 'tfuse'),
                            'desc' => __('Color of main Title , H1.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_color_title',
                            'value' => '',
                            'type' => 'colorpicker'
                        )
                    )
                )
                
            )
        ),
        array(
            'name' => __('Posts', 'tfuse'),
            'id' => TF_THEME_PREFIX . '_posts',
            'headings' => array(
                array(
                    'name' => __('Default Post Options', 'tfuse'),
                    'options' => array(
                        // Post Content
                        array('name' => __('Post Content', 'tfuse'),
                            'desc' => __('Select if you want to show the full content (use <em>more</em> tag) or the excerpt on posts listings (categories).', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_post_content',
                            'value' => 'excerpt',
                            'options' => array('excerpt' => __('The Excerpt', 'tfuse'), 'content' => __('Full Content', 'tfuse')),
                            'type' => 'select',
                            'divider' => true
                        ),
                        // Single Image Position
                        array('name' => __('Image Position', 'tfuse'),
                            'desc' => __('Select your preferred image alignment', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_single_image_position',
                            'value' => 'alignleft',
                            'type' => 'images',
                            'options' => array('alignleft' => array($url . 'left_off.png', __('Align to the left', 'tfuse')), 'alignright' => array($url . 'right_off.png', __('Align to the right', 'tfuse')))
                        ),
                        // Single Image Dimensions
                        array('name' => __('Image Resize (px)', 'tfuse'),
                            'desc' => __('These are the default width and height values. If you want to resize the image change the values with your own. If you input only one, the image will get resized with constrained proportions based on the one you specified.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_single_image_dimensions',
                            'value' => array(586, 319),
                            'type' => 'textarray',
                            'divider' => true
                        ),
                        // Video Position
                        array('name' => __('Video Position', 'tfuse'),
                            'desc' => __('Select your preferred video alignment', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_video_position',
                            'value' => 'alignleft',
                            'type' => 'images',
                            'options' => array('alignleft' => array($url . 'left_off.png', __('Align to the left', 'tfuse')), 'alignright' => array($url . 'right_off.png', __('Align to the right', 'tfuse')))
                        ),
                        // Video Dimensions
                        array('name' => __('Video Resize (px)', 'tfuse'),
                            'desc' => __('These are the default width and height values. If you want to resize the video change the values with your own. If you input only one, the video will get resized with constrained proportions based on the one you specified.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_video_dimensions',
                            'value' => array(590, 191),
                            'type' => 'textarray'
                        )
                    )
                )
            )
        ),
        
        array(
            'name' => __('Footer', 'tfuse'),
            'id' => TF_THEME_PREFIX . '_footer',
            'headings' => array(
                array(
                    'name' => __('Footer Content', 'tfuse'),
                    'options' => array(
                        array('name' => __('Change Copyright', 'tfuse'),
                            'desc' => __('Change  Footer Copyright', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_copyright',
                            'value' => '',
                            'type' => 'text'
                        )
                    )
                )
            )
        ),
        array(
            'name' => __('Ads', 'tfuse'),
            'id' => TF_THEME_PREFIX . '_adds',
            'headings' => array(
                array(
                    'name' => '728 x 90 General Ad Options',
                    'options' => array(

                        array('name' => __('Disable the ad', 'tfuse'),
                            'desc' => __('Disable the 728x90 ad across the website.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_top_ads_space',
                            'value' => 'true',
                            'type' => 'checkbox',
                        ),
                        array(
                            'name'=>__('Ad Image (728px x 90px)', 'tfuse'),
                            'desc'=>__('This banner will appear across the website if you don\'t specify otherwise from the posts categories.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_top_ads_image',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_top_ads_url',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_top_ads_adsense',
                            'value' => '',
                            'type' =>'textarea'
                        )
                    ),

                ),
                array(
                    'name' => '125 x 125 General Ad Options',
                    'options' => array(

                        array('name' => __('Disable the ad', 'tfuse'),
                            'desc' => __('Disable the 125x125 ad across the website.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_bfc_ads_space',
                            'value' => 'true',
                            'type' => 'checkbox',
                        ),
                      
                    array('name' => __('Type of ads', 'tfuse'),
                            'desc' => __('Choose the type of your adds.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_bfcontent_type1',
                            'value' => 'image',
                            'options' => array('image' => __('Image Type', 'tfuse'), 'adsense' => __('Adsense Type', 'tfuse')),
                            'type' => 'select'
                    ),
                    array('name' => __('No of 125x125 ads', 'tfuse'),
                            'desc' => __('Choose the numbers of ads to display before content.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_bfcontent_number',
                            'value' => '7',
                            'options' => array('one' => '1', 'two' => '2' , 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7'),
                            'type' => 'select'
                    ),
                    array(
                            'name'=>__('Ad image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image1',
                            'value' => '',
                            'type' =>'upload'
                    ),
                    array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url1',
                            'value' => '',
                            'type' =>'text'
                    ),
                    array(
                            'name'=>__('Adsense Code', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense1',
                            'value' => '',
                            'type' =>'textarea'
                    ),
                    array(
                            'name'=>__('Ad image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image2',
                            'value' => '',
                            'type' =>'upload'
                    ),
                    array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url2',
                            'value' => '',
                            'type' =>'text'
                    ),
                    array(
                            'name'=>__('Adsense Code', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense2',
                            'value' => '',
                            'type' =>'textarea'
                    ),
                    array(
                            'name'=>__('Ad image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image3',
                            'value' => '',
                            'type' =>'upload'
                    ),
                    array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url3',
                            'value' => '',
                            'type' =>'text'
                    ),
                    array(
                            'name'=>__('Adsense Code', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense3',
                            'value' => '',
                            'type' =>'textarea'
                    ),
                    array(
                            'name'=>__('Ad image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image4',
                            'value' => '',
                            'type' =>'upload'
                    ),
                    array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url4',
                            'value' => '',
                            'type' =>'text'
                    ),
                    array(
                            'name'=>__('Adsense Code', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense4',
                            'value' => '',
                            'type' =>'textarea'
                    ),
                    array(
                            'name'=>__('Ad image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image5',
                            'value' => '',
                            'type' =>'upload'
                    ),
                    array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url5',
                            'value' => '',
                            'type' =>'text'
                    ),
                    array(
                            'name'=>__('Adsense Code', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense5',
                            'value' => '',
                            'type' =>'textarea'
                    ),
                    array(
                            'name'=>__('Ad image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image6',
                            'value' => '',
                            'type' =>'upload'
                    ),
                    array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url6',
                            'value' => '',
                            'type' =>'text'
                    ),
                    array(
                            'name'=>__('Adsense Code', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense6',
                            'value' => '',
                            'type' =>'textarea'
                    ),
                    array(
                            'name'=>__('Ad image (125px x 125px)', 'tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image7',
                            'value' => '',
                            'type' =>'upload'
                    ),
                    array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url7',
                            'value' => '',
                            'type' =>'text'
                    ),
                    array(
                            'name'=>__('Adsense Code', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense7',
                            'value' => '',
                            'type' =>'textarea'
                    ),

                    )
                ),
                array(
                    'name' => '468 x 60 General Ad Options',
                    'options' => array(

                        array('name' => __('Disable the ad', 'tfuse'),
                            'desc' => __('Disable the 468x60 ad across the website.', 'tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_ads_space',
                            'value' => 'true',
                            'type' => 'checkbox',
                        ),
                        array(
                            'name'=>__('Ad Image (468px x 60px)', 'tfuse'),
                            'desc'=>__('This banner will appear across the website if you don\'t specify otherwise from the posts categories.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_hook_image_admin',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL', 'tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_hook_url_admin',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code', 'tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
                            'id'=> TF_THEME_PREFIX . '_hook_adsense_admin',
                            'value' => '',
                            'type' =>'textarea'
                        )
						
                    )
                )
            )
        )
    )
);

?>