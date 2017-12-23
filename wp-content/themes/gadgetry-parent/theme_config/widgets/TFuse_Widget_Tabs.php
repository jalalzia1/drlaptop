<?php
class TFuse_Widget_Tabs extends WP_Widget {

    function __construct()
    {
        $widget_ops = array('classname' => '', 'description' => __("Display tweets","tfuse"));
        parent::__construct('tabs', __('TFuse -Tabs','tfuse'), $widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);

        $items = apply_filters( 'widget_items', $instance['items'], $instance, $this->id_base);
            $popular_posts  = tfuse_shortcode_posts(array(
                                    'sort' => 'popular',
                                    'items' => $items,
                                    'image_post' => true,
                                    'image_width' => 58,
                                    'image_height' => 58,
                                    'image_class' => 'thumbnail',
                                    'date_format' => 'M j, Y',
                                    'date_post' => true
                                    ));

            $latest_posts = tfuse_shortcode_posts(array(
                                    'sort' => 'commented',
                                    'items' => $items,
                                    'image_post' => true,
                                    'image_width' => 58,
                                    'image_height' => 58,
                                    'image_class' => 'thumbnail',
                                    'date_format' => 'M j, Y',
                                    'date_post' => true,
                                ));
        $return_html = '';
        $numb = 1;
        $return_html .='<div class="tf_sidebar_tabs tabs_framed">
            <ul class="tabs">
                <li><a href="#tf_tabs_1">Recent Posts</a></li>
                <li><a href="#tf_tabs_2">Most Commented</a></li>
            </ul>';

        $return_html .= '<div id="tf_tabs_1" class="tabcontent">
                        <ul class="post_list recent_posts">';
                            foreach ($popular_posts as $post_val) {
                                $return_html .= '<li>';
                                $return_html .= '
                                            ' . ' <a href="' . $post_val['post_link'] . '" >' . $post_val['post_img'] . '</a>'. ' <a href="' . $post_val['post_link'] . '" >' . $post_val['post_title'] . '</a>
                                            ';
								if(!tfuse_options('date_time')):
								$return_html .=' <div class="date">' . $post_val['post_date_post'] . '</div>';
								endif;
                                $return_html .= '</li>';
                            }
        $return_html .='</ul>

            </div>

            <div id="tf_tabs_2" class="tabcontent">
                        <ul class="post_list popular_posts">';
                            foreach ($latest_posts as $post_val) {
                                $return_html .= '<li>';
                                $return_html .= '
                                            ' . ' <a href="' . $post_val['post_link'] . '" >' . $post_val['post_img'] . '</a> ';
                                $return_html .= '<a href="' . $post_val['post_link'] . '" >' . $post_val['post_title'] . '</a>
                                            ';
								if(!tfuse_options('date_time')):
								$return_html .=' <div class="date">' . $post_val['post_date_post'] . '</div>';
								endif;
                                $return_html .= '</li>';
                                $numb++;
                            }
        $return_html .= '</ul>

            </div>

        </div>';

        echo $return_html;
    }
    function update($new_instance, $old_instance)
    { $instance = $old_instance;
        $instance['items'] = $new_instance['items'];
        return $instance;

    } // End function update

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'items' => '') );

        $items = $instance['items'];

        ?>
         <p><label for="<?php echo $this->get_field_id('items'); ?>"><?php _e('Items:','tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></p>
        <?php
       }

}
register_widget('TFuse_Widget_Tabs'); ?>
