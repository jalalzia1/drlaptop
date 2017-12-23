<?php
$template_directory = get_template_directory_uri();
wp_register_script('maps.google.com', '//maps.google.com/maps/api/js?sensor=false', array('jquery'), '', true);
wp_register_script('jquery.gmap', $template_directory . '/js/jquery.gmap.min.js', array('jquery', 'maps.google.com'), '', true);
wp_print_scripts('maps.google.com');
wp_print_scripts('jquery.gmap');

global $is_tf_blog_page;

if ( $is_tf_blog_page )
{
    //if is blog page
    $tmp_conf['post_id'] = $post->ID;
    $tmp_conf ['show_all_markers'] = false;
    $coords = explode(':', tfuse_options('page_map_blog'));
    if((!$coords[0]) || (!$coords[1]))
    {
        $tmp_conf ['show_all_markers'] = true;
    }
    else
    {
        $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
        $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);

        $tmp_conf['post_coords']['html']    = '<strong>'.__('We','tfuse').'</strong><span>'.__('are','tfuse').'</span>'.__('here','tfuse');
    }
}
elseif (is_front_page())
{
    //if is front_page
    if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
    {
        $coords = explode(':', tfuse_page_options('page_map'));
    }
    else{
        $coords = explode(':', tfuse_options('page_map'));
    }

    $tmp_conf['post_id'] = $post->ID;
    $tmp_conf ['show_all_markers'] = false;

    if((!$coords[0]) || (!$coords[1]))
    {
        $tmp_conf ['show_all_markers'] = true;
    }
    else
    {
        $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
        $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);

        $tmp_conf['post_coords']['html']    = '<strong>'.__('We','tfuse').'</strong><span>'.__('are','tfuse').'</span>'.__('here','tfuse');
    }
}
elseif (is_category())
{
    //if is front_page
    $ID = get_query_var('cat'); 
    $tmp_conf ['show_all_markers'] = false;
    $coords = explode(':', tfuse_options('page_map',null,$ID));
    if((!$coords[0]) || (!$coords[1]))
    {
        $tmp_conf ['show_all_markers'] = true;
    }
    else
    {
        $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
        $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);

        $tmp_conf['post_coords']['html']    = '<strong>'.__('We','tfuse').'</strong><span>'.__('are','tfuse').'</span>'.__('here','tfuse');
    }
}
elseif ((is_page() || is_single()))
{
    //if is page
    $tmp_conf['post_id'] = $post->ID;
    $tmp_conf ['show_all_markers'] = false;
    $coords = explode(':', tfuse_page_options('page_map'));
    if((!$coords[0]) || (!$coords[1]))
    {
        $tmp_conf ['show_all_markers'] = true;
    }
    else
    {
        $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
        $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);

        $tmp_conf['post_coords']['html']    = '<strong>'.__('We','tfuse').'</strong><span>'.__('are','tfuse').'</span>'.__('here','tfuse');
    }
}

?>
<div class="contact-header-map">
	
    <div class="header_map" id="header_map"></div>
    
	<script>
		jQuery(window).ready(function () {
		jQuery("#header_map").gMap({
                        scrollwheel: false,
			markers: [{
			latitude: <?php echo $tmp_conf['post_coords']['lat']; ?>,
			longitude: <?php echo  $tmp_conf['post_coords']['lng'];?>,
			html:"<?php echo $tmp_conf['post_coords']['html'];?>",
			popup: false}],
			zoom: 14
			});
		});
	</script> 
    
</div>