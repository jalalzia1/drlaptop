<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for categories area.             */
/* ----------------------------------------------------------------------------------- */

$options = array(
    // Color title 
    array('name' => __('Title Color', 'tfuse'),
        'desc' => __('Change post title color.', 'tfuse'),
        'id' => TF_THEME_PREFIX . '_title_color_cat',
        'value' => '',
        'type' => 'colorpicker'
    ),
        // Navibar Color
    array('name' => __('Custom Navibar Color', 'tfuse'),
        'desc' => __('Choose a custom navibar color.', 'tfuse'),
        'id' => TF_THEME_PREFIX . '_custom_color_navibar_cat_categ',
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
		'desc' => '',
        'id' => TF_THEME_PREFIX . '_page_map',
        'value' => '',
        'type' => 'maps'
    ),
    
    //top ad
    array('name' => __('Enable 728x90 banner ', 'tfuse'),
            'desc' => __('Enable the top banner ad space. Note: you can set a specific banner for all categories and posts in the <a href="', 'tfuse') . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>',
            'id' => TF_THEME_PREFIX . '_top_ad_space',
            'value' => 'false',
            'options' => array('false' => __('No', 'tfuse'), 'true' => __('Yes', 'tfuse')),
            'type' => 'select',
    ),
    array(
            'name'=>__('Ad image(728px x 90px)', 'tfuse'),
            'desc'=>__('Enter the URL to the ad image 728x90 location', 'tfuse'),
            'id'=> TF_THEME_PREFIX . '_top_ad_image',
            'value' => '',
            'type' =>'upload'
    ),
    array(
            'name'=>__('Ad URL', 'tfuse'),
            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
            'id'=> TF_THEME_PREFIX . '_top_ad_url',
            'value' => '',
            'type' =>'text'
    ),
    array(
            'name'=>__('Adsense code', 'tfuse'),
            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
            'id'=> TF_THEME_PREFIX . '_top_ad_adsense',
            'value' => '',
            'type' =>'textarea',
    ),
    //125x125 banner
    array('name' => __('Enable 125x125 banners', 'tfuse'),
            'desc' => __('Enable before content banner space. Note: you can set specific banners for all categories and posts in the <a href="', 'tfuse') . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>',
            'id' => TF_THEME_PREFIX . '_bfcontent_ads_space',
            'value' => 'false',
            'options' => array('false' => __('No', 'tfuse'), 'true' => __('Yes', 'tfuse')),
            'type' => 'select'
    ),
    array('name' => __('Type of ads', 'tfuse'),
            'desc' => __('Choose the type of your adds.', 'tfuse'),
            'id' => TF_THEME_PREFIX . '_bfcontent_type',
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
            'name'=>__('Adsense code for before content ads', 'tfuse'),
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
            'name'=>__('Adsense code for before content ads', 'tfuse'),
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
            'name'=>__('Adsense code for before content ads', 'tfuse'),
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
            'name'=>__('Adsense code for before content ads', 'tfuse'),
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
            'name'=>__('Adsense code for before content ads', 'tfuse'),
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
            'name'=>__('Adsense code for before content ads', 'tfuse'),
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
            'name'=>__('Adsense code for before content ads', 'tfuse'),
            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense7',
            'value' => '',
            'type' =>'textarea'
    ),
    //468x60 banner
    array('name' => __('Enable 468x60 banner ', 'tfuse'),
            'desc' => __('Enable after content banner space. Note: you can set a specific banner for all categories and posts in the <a href="', 'tfuse') . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>',
            'id' => TF_THEME_PREFIX . '_hook_space',
            'value' => 'false',
            'options' => array('false' => __('No', 'tfuse'), 'true' => __('Yes', 'tfuse')),
            'type' => 'select',
    ),
    array(
            'name'=>__('Ad image(468px x 60px)', 'tfuse'),
            'desc'=>__('Enter the URL to the ad image 468x60 location', 'tfuse'),
            'id'=> TF_THEME_PREFIX . '_hook_image',
            'value' => '',
            'type' =>'upload'
    ),
    array(
            'name'=>__('Ad URL', 'tfuse'),
            'desc'=>__('Enter the URL where this ad points to.', 'tfuse'),
            'id'=> TF_THEME_PREFIX . '_hook_url',
            'value' => '',
            'type' =>'text'
    ),
    array(
            'name'=>__('Adsense code', 'tfuse'),
            'desc'=>__('Enter your adsense code (or other ad network code) here.', 'tfuse'),
            'id'=> TF_THEME_PREFIX . '_hook_adsense',
            'value' => '',
            'type' =>'textarea',
    ),
    
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
   
);

?>