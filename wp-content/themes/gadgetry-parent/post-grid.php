<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since  Gadgetry 1.0
 */ 
$color = tfuse_title_color();
$bg = tfuse_bg_color();
 global $more;
    $more = apply_filters('tfuse_more_tag',0);
?>
<div class="post-item ">
    <div class="post-image">
        <a href="<?php the_permalink(); ?>"><?php tfuse_media(); ?></a>
    </div>
    <div class="post_title">
            <div class="post_tag" <?php echo $color;?>><span><?php tfuse_show_cat_name();?></span></div>
            <h2><a href="<?php the_permalink(); ?>" <?php echo $bg;?>><?php the_title(); ?></a></h2>
    </div>
    <div class="post-descr">
        <p><?php if (tfuse_options('post_content') == 'content' ) the_content(''); else the_excerpt(); ?></p>
    </div>
    <div class="post-meta-bot">
			<?php if(!tfuse_options('date_time')):?>
				<span class="post-date"><?php echo get_the_date('jS F Y'); ?></span>
			<?php endif;?>
        <a href="<?php comments_link(); ?>" class="link-comments"><?php comments_number("0 ".__('Comments','tfuse'), "1 ".__('Comment','tfuse'), "% ".__('Comments','tfuse')); ?></a>
    </div>
</div>
