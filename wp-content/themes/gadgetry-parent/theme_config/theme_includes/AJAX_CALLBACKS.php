<?php

if (!function_exists('tfuse_rewrite_worpress_reading_options')):

    /**
     *
     *
     * To override tfuse_rewrite_worpress_reading_options() in a child theme, add your own tfuse_rewrite_worpress_reading_options()
     * to your child theme's file.
     */

    add_action('tfuse_admin_save_options','tfuse_rewrite_worpress_reading_options', 10, 1);

    function tfuse_rewrite_worpress_reading_options ($options)
    {
        if($options[TF_THEME_PREFIX . '_homepage_category'] == 'page')
        {
            update_option('show_on_front', 'page');

            if(get_post_type(intval($options[TF_THEME_PREFIX . '_home_page'])) == 'page')
            {
                update_option('page_on_front', intval($options[TF_THEME_PREFIX . '_home_page']));
            }

            if(get_post_type(intval($options[TF_THEME_PREFIX . '_blog_page'])) == 'page')
            {
                update_option('page_for_posts', intval($options[TF_THEME_PREFIX . '_blog_page']));
            }
            else
            {
                update_option('page_for_posts', 0);
            }
        }
        else
        {
            update_option('show_on_front', 'posts');
            update_option('page_on_front', 0);
            update_option('page_for_posts', 0);
        }

    }
endif;

if( !function_exists('tf_move_comment_field_to_bottom') ):
    function tf_move_comment_field_to_bottom( $fields ) {
        $comment_field = $fields['comment'];
        unset( $fields['comment'] );
        $fields['comment'] = $comment_field;

        return $fields;
    }
endif;
add_filter( 'comment_form_fields', 'tf_move_comment_field_to_bottom' );

