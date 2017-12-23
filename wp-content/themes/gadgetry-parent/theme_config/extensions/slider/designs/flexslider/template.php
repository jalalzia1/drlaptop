<?php
/**
 * The template for displaying FlexSlider.
 * To override this template in a child theme, copy this file to your 
 * child theme's folder /theme_config/extensions/slider/designs/flexslider/
 * 
 * If you want to change style or javascript of this slider, copy files to your 
 * child theme's folder /theme_config/extensions/slider/designs/flexslider/static/
 * and change get_template_directory() with get_stylesheet_directory()
 */
$TFUSE->include->register_type('slider_css_folder', get_template_directory() . '/theme_config/extensions/slider/designs/'.$slider['design'].'/static/css');
$TFUSE->include->css('flexslider', 'slider_css_folder', 'tf_head');

$TFUSE->include->register_type('slider_js_folder', get_template_directory() . '/theme_config/extensions/slider/designs/'.$slider['design'].'/static/js');
$TFUSE->include->js('jquery.flexslider-min', 'slider_js_folder', 'tf_footer');
$TFUSE->include->js_enq('img_url', get_template_directory_uri());
$TFUSE->include->js('flexsliderOptions', 'slider_js_folder', 'tf_footer');
$interval = 7000;
if(isset($slider['general']['slider_interval']))
    $interval = $slider['general']['slider_interval'];
?>
 <!-- featured-posts -->
<div class="featured-posts featuredSlider">   
    <div class="featured-slider">
        <ul class="slides">
            <?php  
            if($slider['type'] == 'custom')
            {
                foreach ($slider['slides'] as $slide): ?>
                    <li>
                            <img src="<?php echo $slide['slide_src']?>" alt="" width="948" height="372"/>
                            <div class="flex-caption caption-<?php echo $slide['slide_position'];?>">                
                            <div class="post_title"><a href="<?php echo $slide['slide_url'];?>" style="background-color:<?php echo $slide['slide_title_color'];?>"><?php echo $slide['slide_title'];?></a></div>                 
                    </div>
                    </li>
                <?php endforeach;
            } else 
            { 
                 foreach ($slider['slides'] as $slide):?>
                    <li class="<?php echo $slide['slide_title_color'];?>">
                            <img src="<?php echo $slide['slide_src']?>" alt="" width="948" height="372"/>
                            <div class="flex-caption caption-<?php echo $slide['slide_position'];?>">                
                            <div class="post_tag"><span><?php echo $slide['slide_cat_name'];?></span></div>
                            <div class="post_title"><a href="<?php echo $slide['slide_url'];?>"><?php echo $slide['slide_title'];?></a></div>
                        <div class="post-meta-bot">
                                    <span class="post-date"><?php echo $slide['slide_date'];?></span><a href="<?php echo $slide['slide_url'];?>" class="link-comments"><?php echo $slide['slide_comment'];?></a>
                            </div>                    
                    </div>
                    </li>
                <?php endforeach;
            }?>
        </ul>
    </div>
    <script>
            jQuery(window).load(function() {
                jQuery('.featured-slider').flexslider({slideshowSpeed: <?php echo $interval; ?>});
            });
    </script>
    
</div>
<!--/ featured-posts -->
   