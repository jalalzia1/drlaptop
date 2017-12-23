<?php get_header(); ?>
<?php
    $sidebar_position = tfuse_sidebar_position(); 
    $topbar =  isset($_GET['navibar']) ? $_GET['navibar'] : "";
?>
<div id="middle" class="cols2">
    <?php if ($sidebar_position != 'full') : ?>
         <div class="content" role="main">
    <?php endif;?>
            <h1><?php _e('404 Error', 'tfuse') ?></h1>
            <div class="entry">
                <p><?php _e('The page you were looking for doesn&rsquo;t seem to exist', 'tfuse') ?>.</p>
                <div class="clear"></div> 
            </div><!--/ .entry -->
           <?php if (have_posts()) 
            { $count = 0;
                    tfuse_show_list_before();
                        if($topbar == 'most_commented')
                        {   
                            tfuse_most_commented($count,$sidebar_position);
                        }
                        elseif($topbar == 'most_viewed')
                        {   
                            tfuse_most_viewed($count,$sidebar_position);
                        }
                        elseif($topbar == 'all')
                        {   
                            tfuse_all($count,$sidebar_position);
                        }
                        else
                        {
                            while (have_posts()) : the_post(); $count++;
                                    tfuse_get_template();
                                    tfuse_separator($count,$sidebar_position);
                            endwhile;
                        }
                    echo '<div class="clear"></div></div>';
                } 
                else 
                { ?>
                    <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
        <?php }

            tfuse_pagination(); ?>
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