<?php
class TFuse_Widget_Contact extends WP_Widget
{

    function __construct()
    {
        $widget_ops = array('classname' => 'widget_contact', 'description' => __( 'Add Contact in Sidebar','tfuse') );
        parent::__construct('contact', __('TFuse Contact Widgets','tfuse'), $widget_ops);
    }

    function widget( $args, $instance )
    {
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        $before_widget = '<div class="widget-container widget_contact">';
        $after_widget = '</div>';
        $before_title = '<h3 class="widget-title">';
        $after_title = '</h3>';
        echo'<!-- widget contacts -->';
        $tfuse_title = (!empty($title)) ? $before_title .tfuse_qtranslate($title) .$after_title : '';

        echo $before_widget;

        // echo widgets title
        echo $tfuse_title;
       echo '<div class="inner"> <div class="contact-address">';
       if ( $instance['name'] != '')
        {
                 echo'   <div class="name"><strong>' .tfuse_qtranslate($instance['name']).'</strong></div>';
        }
        if ( $instance['adress'] != '')
        {
                 echo'   <div class="address">' .tfuse_qtranslate($instance['adress']).'</div>';
        }
        
        if ( $instance['phone'] != '')
        {
            echo '<div class="phone"><em>'.__('Phone:','tfuse').'</em><span>'.tfuse_qtranslate($instance['phone']).'</span>'.
                '</div>';
        }
        if ( $instance['fax'] != '')
        {
            echo '<div class="fax"><em>'.__('Fax:','tfuse').'</em><span>'.tfuse_qtranslate($instance['fax']).'</span>'.
                '</div>';
        }
        if ( $instance['email_1'] != '')
        {
           echo '<div class="mail"><em>'.__('Email:','tfuse').'</em>
                    '.'<a href="mailto:'.$instance['email_1'].'">'.tfuse_qtranslate($instance['email_1']).'</a>'.'
                </div>';
        }
        echo '</div></div>';

        echo $after_widget;
        echo'<!--/ widget contacts -->';
    }

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $new_instance = wp_parse_args( (array) $new_instance, array( 'title'=>'', 'email_1' => '','name' => '','adress' => '','phone' => '', 'fax' => '') );

        $instance['title']      = $new_instance['title'];
        $instance['phone']      = $new_instance['phone'];
       $instance['fax']      = $new_instance['fax'];
        $instance['email_1']      = $new_instance['email_1'];
        $instance['name']      = $new_instance['name'];
        $instance['adress']      = $new_instance['adress'];

        return $instance;
    }

    function form( $instance )
    {
        $instance = wp_parse_args( (array) $instance, array( 'title'=>'', 'email_1' => '','name' => '','adress' => '','phone' => '','fax'=>'') );
        $title = $instance['title'];
?>
   
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label><br/>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
     <p>
        <label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Name:','tfuse'); ?></label><br/>
        <input class="widefat " id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php echo  esc_attr($instance['name']); ?>"  />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('adress'); ?>"><?php _e('Adress:','tfuse'); ?></label><br/>
        <input class="widefat " id="<?php echo $this->get_field_id('adress'); ?>" name="<?php echo $this->get_field_name('adress'); ?>" type="text" value="<?php echo esc_attr($instance['adress']); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:','tfuse'); ?></label><br/>
       <input class="widefat " id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($instance['phone']); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e('Fax:','tfuse'); ?></label><br/>
        <input class="widefat " id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo  esc_attr($instance['fax']); ?>"  />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('email_1'); ?>"><?php _e('Email:','tfuse'); ?></label><br/>
        <input class="widefat " id="<?php echo $this->get_field_id('email_1'); ?>" name="<?php echo $this->get_field_name('email_1'); ?>" type="text" value="<?php echo  esc_attr($instance['email_1']); ?>"  />
    </p>
    
    <?php
    }
}
register_widget('TFuse_Widget_Contact');
