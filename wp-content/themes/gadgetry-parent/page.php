<?php 
global $is_tf_blog_page;
get_header();
if ($is_tf_blog_page) die(); 
?>
<?php $sidebar_position = tfuse_sidebar_position(); ?>
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
            <?php  while ( have_posts() ) : the_post();?>
                <div class="title">
                    <h1><?php tfuse_custom_title(); ?></h1>
                </div>
                    <article class="post-detail">  
                        <div class="entry">
                            <?php the_content(); ?>
                            <div class="clear"></div> 
                        </div><!--/ .entry -->
                    </article> <!--/ entry text -->
            <?php endwhile; // end of the loop. ?>
            <?php tfuse_comments(); ?>
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

<?php get_footer();?>