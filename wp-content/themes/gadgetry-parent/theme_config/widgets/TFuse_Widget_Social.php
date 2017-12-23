<?php
class TFuse_Widget_Social extends WP_Widget
{

	function __construct()
    {
		$widget_ops = array('classname' => 'widget_social', 'description' => __( 'Add Social Networks in Sidebar ','tfuse') );
        parent::__construct('social', __('TFuse Social Widgets','tfuse'), $widget_ops);
	}

	function widget( $args, $instance )
    {
		extract($args);

        $instance['position'] = empty( $instance['position'] ) ? '' : $instance['position'];
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

		$before_widget = ' <div class="sidebar_social">';
		$after_widget = '</div>';
		$before_title = '<h3>';
		$after_title = '</h3>';
        ?>
        <!-- widget social contacts -->
        <?php
        if ($instance['position'] == 'sidebar') :
            $tfuse_title = (!empty($title)) ? $before_title .tfuse_qtranslate($title) .$after_title : '';

                    echo $before_widget;

                    // echo widgets title
            echo $tfuse_title;
            echo '<div class="social_icons">';
                if ( $instance['facebook'] != '')
                {?>
                        <a href="<?php echo $instance['facebook']; ?>" class="social-fb"><span><?php __('Facebook','tfuse'); ?></span></a>
                <?php }
                if ( $instance['youtube'] != '')
                {?>
                        <a href="<?php echo $instance['youtube']; ?>" class="social-youtube"><span><?php __('Youtube','tfuse'); ?></span></a>
                <?php }
                if ( $instance['twitter'] != '')
                {?>
                        <a href="<?php echo $instance['twitter']; ?>" class="social-twitter"><span><?php __('Twitter','tfuse'); ?></span></a>
                <?php }
                if ( $instance['linkedin'] != '')
                {?>
                        <a href="<?php echo $instance['linkedin']; ?>" class="social-linkedin"><span><?php  __('LinkedIn','tfuse'); ?></span></a>
                <?php }
            echo '</div>';
                    echo $after_widget;
            ?>
            <!--/ widget social contacts -->
            <?php 
        endif;
        if ($instance['position'] == 'footer') : ?>
            <div class="footer_social">
               <?php if ( $instance['facebook'] != '')
                {?>
                    <a href="<?php echo $instance['facebook']; ?>" class="link-fb"><span><?php __('Facebook','tfuse'); ?></span></a>
                <?php }
                if ( $instance['twitter'] != '')
                {?>
                        <a href="<?php echo $instance['twitter']; ?>" class="link-twitter"><span><?php __('Twitter','tfuse'); ?></span></a>
                <?php } ?>                       
	    </div>
       <?php endif;
	}

	function update( $new_instance, $old_instance )
    {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array('youtube' => '','linkedin' => '','facebook' => '','facebook_id' => '', 'twitter' => '', 'twitter_id' => '','title' =>'') );
        $instance['title']      = $new_instance['title'];
        $instance['facebook']   = $new_instance['facebook'] ? $new_instance['facebook'] : '';
        $instance['facebook_id']   = $new_instance['facebook_id'] ? $new_instance['facebook_id'] : '';
        $instance['twitter']    = $new_instance['twitter'] ? $new_instance['twitter'] : '';
        $instance['twitter_id']    = $new_instance['twitter_id'] ? $new_instance['twitter_id'] : '';
        $instance['youtube']        = $new_instance['youtube'] ? $new_instance['youtube'] : '';
        $instance['linkedin']        = $new_instance['linkedin'] ? $new_instance['linkedin'] : '';
        if ( in_array( $new_instance['position'], array( 'sidebar', 'footer' ) ) ) 
		{
            $instance['position'] = $new_instance['position'];
        } 
		else 
		{
            $instance['position'] = 'sidebar';
        }
		return $instance;
	}

	function form( $instance )
    {
        $instance = wp_parse_args( (array) $instance, array( 'title'=>'', 'youtube' => '','linkedin' => '', 'facebook' => '','facebook_id' => '', 'twitter' => '','twitter_id' => '','position' =>'') );
        $title = $instance['title'];
        @$position = esc_attr( $instance['position'] );
?>
    <style type="text/css">
        .widget_social_name, .widget_social_link {
            width:185px;
        }
        .widget_social_link{
            margin-left: 11px;
        }
        .tfuse_wd_skype{
            width:161px!important;
        }
    </style>
    
    <p>
        <label for="<?php echo $this->get_field_id('position'); ?>"><?php _e( 'Position:' ,'tfuse'); ?></label>
        <select name="<?php echo $this->get_field_name('position'); ?>" id="<?php echo $this->get_field_id('position'); ?>" class="widefat">
            <option  value="sidebar"<?php selected( @$instance['position'], 'sidebar' ); ?>><?php _e('Sidebar,Footer','tfuse'); ?></option>
            <option  value="footer"<?php selected( @$instance['position'], 'footer' ); ?>><?php _e('Footer 2','tfuse'); ?></option>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:(Will not be appear in footer 2) ','tfuse'); ?></label><br/>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook:','tfuse'); ?></label><br/>
        <span><?php _e('Link:','tfuse'); ?></span> <input class="widefat widget_social_link" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($instance['facebook']); ?>" />
       
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter:','tfuse'); ?></label><br/>
        <span><?php _e('Link:','tfuse'); ?></span> <input class="widefat widget_social_link" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo  esc_attr($instance['twitter']); ?>"  />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('LinkedIn:(Will not be appear in footer 2)','tfuse'); ?></label><br/>
        <span><?php _e('Link:','tfuse'); ?></span> <input class="widefat widget_social_link" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo  esc_attr($instance['linkedin']); ?>"  />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('Youtube:(Will not be appear in footer 2)','tfuse'); ?></label><br/>
        <span><?php _e('Link:','tfuse'); ?></span> <input class="widefat widget_social_link tfuse_wd_skype" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo esc_attr($instance['youtube']); ?>"  />
    </p>
    
    <?php
	}
}

function TFuse_Unregister_WP_Widget_Social() {
	unregister_widget('WP_Widget_Social');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Social');

register_widget('TFuse_Widget_Social');
