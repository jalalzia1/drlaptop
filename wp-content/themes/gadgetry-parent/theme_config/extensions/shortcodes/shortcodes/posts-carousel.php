<?php //Post Carousel
function tfuse_posts_carousel($atts, $content = null) {
    extract(shortcode_atts(array(
		'category' => '','title' => '','items' => ''), $atts));
	if(!empty($category))
	{
            $posts=tfuse_shortcode_carousel_posts($category);
	}
	$uniq = rand(1,200);
	$out ='';
	if(!empty($posts)){
           $out .='
            <div class="minigallery_carousel">
            	<div class="minigallery_head">
	                <h3>'.__($title,'tfuse').'</h3>
	            	<a class="prev" id="minigallery'.$uniq.'_prev" href="#"><span>'.__('prev','tfuse').'</span></a>
	                <a class="next" id="minigallery'.$uniq.'_next" href="#"><span>'.__('next','tfuse').'</span></a>
                </div>
                <div class="carousel_content">
            	<ul id="minigallery'.$uniq.'">';
                    foreach ( $posts as $post ):
                        static $count = 0;
                            if($count == $items) break;
                            $count++;
                        $out .= '<li>';
                            $out .=$post['post_img'];
                            $out .='<a href="'.$post['post_link'].'" class="zoom">'.$post['post_title'].'</a>';
                        $out .='</li>';
                    endforeach;
            $out .='</ul>
                </div>   
            </div>';
            $out .= '<script>
			jQuery(document).ready(function($) {
				$("#minigallery'.$uniq.'").carouFredSel({
                                    next : "#minigallery'.$uniq.'_next",
                                    prev : "#minigallery'.$uniq.'_prev",
                                    auto: false,
                                    circular: false,
                                    infinite: true,	
                                    width: "100%",		
                                    scroll: {
                                        items : 1,
                                        wipe: true
                                    }			
				});
                            });
                        </script>';
            
	}
    return $out;
	return tfuse_posts_carousel_html($tfuse_shortcode_arr);
}

$atts = array(
    'name' => __('Posts Carousel', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 7,
    'options' => array(
        array(
            'name' => __('Title', 'tfuse'),
            'desc' => __('Gallery Title', 'tfuse'),
            'id' => 'tf_shc_posts_carousel_title',
            'value' => 'Newest galleries',
            'type' => 'text'
        ),
        array(
            'name' => __('Categories', 'tfuse'),
            'desc' => __('Specifies the categories to display some posts ex:cat_name1,cat_name1...', 'tfuse'),
            'id' => 'tf_shc_posts_carousel_category',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Items', 'tfuse'),
            'desc' => __('Specifies the number of posts in slide', 'tfuse'),
            'id' => 'tf_shc_posts_carousel_items',
            'value' => '5',
            'type' => 'text'
        )
       
    )
);
tf_add_shortcode('posts_carousel', 'tfuse_posts_carousel', $atts);
