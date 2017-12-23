<?php get_header(); 
$post_type = isset($_GET['post_type']);?>
<?php $sidebar_position = tfuse_sidebar_position(); ?>
<!-- middle content -->
<?php if ($sidebar_position == 'full' || $sidebar_position == 'right') : ?>
         <div id="middle" class="cols2">
<?php endif;
    if ($sidebar_position == 'left') : ?>
         <div id="middle" class="cols2 sidebar_left">
<?php endif;
    if ($sidebar_position != 'full') : ?>
         <div class="content" role="main">
    <?php endif; ?>
        <?php 
            tfuse_shortcode_content('before');
            tfuse_hook();
        ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="title">
                    <?php tfuse_custom_title(); ?>
                        <div class="title-sub">
                            <?php echo tfuse_page_options('content_subtitle');?>
                        </div>
                    <?php if ( !tfuse_page_options('disable_post_meta') ) : ?>
                        <div class="post-meta-top">
                            <?php if ( !tfuse_page_options('disable_author') ) : ?>
                                <?php _e('Posted  by','tfuse')?>
                                    <a href="#" class="author"><?php the_author_posts_link(); ?></a>
                            <?php endif; ?>
							<?php if(!tfuse_options('date_time')):?>
								<?php if ( !tfuse_page_options('disable_published_date') ) : ?>
									<?php _e('on ','tfuse'); echo get_the_date( 'jS F Y' );?>
								<?php endif;?>
							<?php endif;?>
                            <?php if(!is_attachment() && $post_type != 'tfuse_gallery_group'):?>
                                    <?php tfuse_cat_names() ;
                            endif;?>
                            <?php if ( !tfuse_page_options('disable_coments') ) : ?>
                                <?php _e(' with ','tfuse')?>
                                <a href="<?php comments_link(); ?>" class="anchor"><?php comments_number("0 ".__('comments','tfuse'), "1 ".__('comment','tfuse'), "% ".__('comments','tfuse')); ?></a>
                            <?php endif;?>
                        </div>
                    <?php endif; ?>
                </div>	
            <?php endwhile; // end of the loop. ?>
            <?php  while ( have_posts() ) : the_post();?>
                    <article class="post-detail">  
                        <div class="entry">
                            <?php get_template_part('content','single');?>
                            <?php get_template_part('content','author');?>
                            <div class="clear"></div> 
                        </div><!--/ .entry -->
                    </article> <!--/ entry text -->
            <?php endwhile; // end of the loop. ?>
			<?php wp_link_pages(); ?>
            <?php if ( !tfuse_page_options('disable_coments') ) :  tfuse_comments();  endif; ?>
         <?php tfuse_shortcode_content('after'); ?>
    <?php if ($sidebar_position != 'full') : ?>
         </div>
    <?php endif; ?>
            <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
                <div class="sidebar">
                    <?php get_sidebar(); ?>
                </div><!--/ .sidebar -->
            <?php endif; ?>
    <div class="clear"></div>
</div><!--/ .middle -->

<?php get_footer(); ?>