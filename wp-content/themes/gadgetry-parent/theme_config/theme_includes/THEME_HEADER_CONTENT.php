<?php

if ( ! function_exists( 'tfuse_get_header_content' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override tfuse_slider_type() in a child theme, add your own tfuse_slider_type to your child theme's
 * functions.php file.
 */

    function tfuse_get_header_content()
    {
        global $TFUSE, $post, $header_map ,$is_tf_blog_page;
        $posts = $header_element = $header_map = $slider = null;

        if(is_front_page())
        {
            $page_id = $post->ID;
            $ID = $post->ID;
            $header_element = tfuse_options('header_element');
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
            {
                if($page_id!=0 && tfuse_page_options('header_element','',$page_id)=='slider')
                $slider = tfuse_page_options('select_slider','',$page_id);
                $header_element = tfuse_page_options('header_element');
            }
            else{
                if ( 'slider' == $header_element )
                    $slider = tfuse_options('select_slider');
            }
        }
        elseif($is_tf_blog_page)
        {
             $ID = $post->ID;
            $header_element = tfuse_options('header_element_blog');
            if ( 'slider' == $header_element )
                $slider = tfuse_options('select_slider_blog');
        }
        elseif ( is_singular() )
        {
            $ID = $post->ID;
            $header_element = tfuse_page_options('header_element');
            if ( 'slider' == $header_element )
                $slider = tfuse_page_options('select_slider');
                
        }
        elseif ( is_category() )
        {
            $ID = get_query_var('cat');
            $header_element = tfuse_options('header_element', null, $ID);
            if ( 'slider' == $header_element )
                $slider = tfuse_options('select_slider', null, $ID);
                
        }

        if ( $header_element == 'map' )
        {
            get_template_part( 'header', 'map' );
            return;
        }
        elseif ( !$slider )
            return;

        $slider = $TFUSE->ext->slider->model->get_slider($slider);

        switch ($slider['type']):

            case 'custom':

                if ( is_array($slider['slides']) ) :
                    $slider_image_resize = ( isset($slider['general']['slider_image_resize']) && $slider['general']['slider_image_resize'] == 'true' ) ? true : false;
                    foreach ($slider['slides'] as $k => $slide) :
                        $image = new TF_GET_IMAGE();
                        $slider['slides'][$k]['slide_src'] = $image->width(948)->height(372)->src($slide['slide_src'])->resize($slider_image_resize)->get_src();   
                    endforeach;
                endif;

                break;

            case 'posts':
                $args = array( 'post__in' => explode(',',$slider['general']['posts_select']) );
                $slides_posts = array();
                $slides_posts = explode(',',$slider['general']['posts_select']);
                foreach($slides_posts as $slide_posts):
                    $posts[] = get_post($slide_posts);
                endforeach;
                $posts = array_reverse($posts);
                $args = apply_filters('tfuse_slider_posts_args', $args, $slider);
                $args = apply_filters('tfuse_slider_posts_args_'.$ID, $args, $slider);
                break;

            case 'tags':
                $args = array( 'tag__in' => explode(',',$slider['general']['tags_select']) );

                $args = apply_filters('tfuse_slider_tags_args', $args, $slider);
                $args = apply_filters('tfuse_slider_tags_args_'.$ID, $args, $slider);
                $posts = get_posts($args);
                break;

            case 'categories':
                $args = 'cat='.$slider['general']['categories_select'].
                        '&posts_per_page='.$slider['general']['sliders_posts_number'];

                $args = apply_filters('tfuse_slider_categories_args', $args, $slider);
                $args = apply_filters('tfuse_slider_categories_args_'.$ID, $args, $slider);
                $posts = get_posts($args);
                break;

        endswitch;

        if ( is_array($posts) ) :
            $slider['slides'] = tfuse_get_slides_from_posts($posts,$slider);
        endif;

        if ( !is_array($slider['slides']) ) return;

        include_once(locate_template( '/theme_config/extensions/slider/designs/'.$slider['design'].'/template.php' ));
    }

endif;
add_action('tfuse_header_content', 'tfuse_get_header_content');


if ( ! function_exists( 'tfuse_get_slides_from_posts' ) ):
/**
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override tfuse_slider_type() in a child theme, add your own tfuse_slider_type to your child theme's
 * functions.php file.
 */
    function tfuse_get_slides_from_posts( $posts=array(), $slider = array() )
    {
        global $post;
        
        $slides = array();
        $slider_image_resize = ( isset($slider['general']['slider_image_resize']) && $slider['general']['slider_image_resize'] == 'true' ) ? $slider['general']['slider_image_resize'] : false;
        
        
        foreach ($posts as $k => $post) : setup_postdata( $post );
		    setup_postdata( $post );
            $post->post_type;
            
            if ($post->post_type == 'post'){
                    $tfuse_image = $image = null;
                    $color = array('post_yellow' => __('Yellow', 'tfuse'), 'post_green' => __('Green', 'tfuse'),'post_purple' => 'Purple','post_red' => __('Red', 'tfuse'),'post_blue' => 'Blue');
                    $position = array('random' => __('Random', 'tfuse'),'left-mid' => 'Left-Middle', 'left-top' => 'Left-Top','left-bot' => 'Left-Bottom','center-mid' => 'Center-Middle','center-top' => 'Center-Top'
                                                ,'center-bot' => 'Center-Bottom','right-mid' => 'Right-Middle','right-top' => 'Right-Top','right-bot' => 'Right-Bottom');
                    $single_image = tfuse_page_options('thumbnail_image');
                    
                    if ( empty($single_image) ) continue;
                        $image = new TF_GET_IMAGE();
                        $tfuse_image = $image->width(948)->height(378)->src($single_image)->resize($slider_image_resize)->get_src();
                        
                        $title_position = $slider['general']['sliders_position'];
                            if($title_position == 'random')
                            {
                                $title_position = array_rand($position,1);
                            }
                        $title_color = $slider['general']['sliders_title_color'];
                            if($title_color == 'random')
                            {
                                $title_color = array_rand($color,1);
                            }
                        $cat_id = '';
                        $id = $post->ID;
                        $cat = get_the_category( $id );
                        $cat_id = $cat[0]->cat_ID; 
                        $slides[$k]['slide_cat_name'] = $categ_name = get_cat_name( $cat_id );
                        $slides[$k]['slide_title'] = $title = get_the_title();
                        $slides[$k]['slide_date'] = $dates = get_the_date( 'jS F Y' );
                        $slides[$k]['slide_comment'] = $comment = get_comments_number( $id );

                    if (mb_strlen($title, 'UTF-8') > 100)  $title = substr($title, 0 ,100) . '...';
                        $slides[$k]['slide_title'] = $title;
                        $slides[$k]['slide_src'] = $tfuse_image;
                        $slides[$k]['slide_url'] = get_permalink();
                        $slides[$k]['slide_title_color'] = $title_color;
                        $slides[$k]['slide_position'] = $title_position;
		}
        endforeach;

        return $slides;
    }
endif;
