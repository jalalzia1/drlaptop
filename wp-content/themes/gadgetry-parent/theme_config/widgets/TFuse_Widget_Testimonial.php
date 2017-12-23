<?php
class TFuse_Widget_Testimonial extends WP_Widget {

    function __construct()
    {
        $widget_ops = array('classname' => '', 'description' => __("Display and rotate your testimonials","tfuse"));
        parent::__construct('testimonial', __('TFuse - Testimonial','tfuse'), $widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
		$testimonials_uniq = rand(1, 300);
        $title = apply_filters( 'widget_title',  empty($instance['title']) ? __('Testimonial','tfuse') : $instance['title'], $instance, $this->id_base);
        if (@$instance['random'])
            $order = '&order=ASC';
        else
            $order = '&orderby=rand';
        $slide = $nav = $single = '';
        query_posts('post_type=testimonials&posts_per_page=-1' . $order);
        $k = 0;
        if (have_posts()) {
        while (have_posts()) {
           
            $k++;
            the_post();
            $id = get_the_ID();
            $img = tfuse_page_options('img');

            if(!empty($img)) $img = '<img src="'.$img .'" width="58" height="58" alt="" class="alignleft">';
            $slide .= '
                <div class="slide">
                    <div class="quote-text">
                    ' . $img .get_the_excerpt() . '
                    </div><!--/ .quote-text -->
                    <div class="quote-author">
                        <span>' . get_the_title() . '</span>
                    </div><!--/ .quote-author -->
                </div><!--/ .slide -->
        ';
        } // End WHILE Loop
    } // End IF Statement
    wp_reset_query();

    if ($k > 1) {
        $nav = '<a href="#" class="prev" >' . __('Prev', 'tfuse') . '</a>
        <a href="#" class="next">' . __('Next', 'tfuse') . '</a>';
    }
    else
        $single = ' style="display: block"';

    $output = '
    <div id="testimonials'.$testimonials_uniq.'" class="widget-container slideshow slideQuotes">
         <h3 class="widget-title">'. $title . '</h3>
        <div class="slides_container"' . $single . '>
        ' . $slide . '
        </div><!--/ .slides_container -->
        ' . $nav . '
		 <div class="clear"></div>
    </div><!--/ .slideshow slideQuotes -->
    <script>
            jQuery(document).ready(function($) {
                    $("#testimonials'.$testimonials_uniq.'").slides({
                            hoverPause: true,
                            autoHeight: true,
                            pagination: true,
                            generatePagination: true,
                            effect: "fade",
                            fadeSpeed: 150});
            });		
    </script>  ';

    echo $output;

    }
    function update($new_instance, $old_instance)
    { $instance = $old_instance;
        $instance['random'] = isset($new_instance['random']);
        $instance['title'] = $new_instance['title'];
        return $instance;

    } // End function update

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'random' => '') );
        $title = $instance['title'];

        ?>

    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
    <p><input id="<?php echo $this->get_field_id('random'); ?>" name="<?php echo $this->get_field_name('random'); ?>" type="checkbox" <?php checked(isset($instance['random']) ? $instance['random'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('random'); ?>"><?php _e('Disable Random','tfuse'); ?></label></p>
         <?php
       }

}
register_widget('TFuse_Widget_Testimonial'); ?>
