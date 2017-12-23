<?php
if ( ! isset( $content_width ) ) $content_width = 900;

if (!function_exists('tfuse_browser_body_class')):

/* This Function Add the classes of body_class()  Function
 * To override tfuse_browser_body_class() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
*/

    add_filter('body_class', 'tfuse_browser_body_class');

    function tfuse_browser_body_class() {

        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

        if ($is_lynx)
            $classes[] = 'lynx';
        elseif ($is_gecko)
            $classes[] = 'gecko';
        elseif ($is_opera)
            $classes[] = 'opera';
        elseif ($is_NS4)
            $classes[] = 'ns4';
        elseif ($is_safari)
            $classes[] = 'safari';
        elseif ($is_chrome)
            $classes[] = 'chrome';
        elseif ($is_IE) {
            $browser = $_SERVER['HTTP_USER_AGENT'];
            $browser = substr("$browser", 25, 8);
            if ($browser == "MSIE 7.0")
                $classes[] = 'ie7';
            elseif ($browser == "MSIE 6.0")
                $classes[] = 'ie6';
            elseif ($browser == "MSIE 8.0")
                $classes[] = 'ie8';
            else
                $classes[] = 'ie';
        }
        else
            $classes[] = 'unknown';

        if ($is_iphone)
            $classes[] = 'iphone';

        return $classes;
    } // End function tfuse_browser_body_class()
endif;


if (!function_exists('tfuse_class')) :
/* This Function Add the classes for middle container
 * To override tfuse_class() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
*/

    function tfuse_class($param, $return = false) {
        $tfuse_class = '';
        $sidebar_position = tfuse_sidebar_position();
        if ($param == 'middle') {
            if (is_page_template('template-contact.php')) {
                if ($sidebar_position == 'left')
                    $tfuse_class = ' class="middle sidebarLeft nobg"';
                elseif ($sidebar_position == 'right')
                    $tfuse_class = ' class="middle sidebarRight nobg"';
                else
                    $tfuse_class = ' class="middle"';
            }
            else {
                if ($sidebar_position == 'left')
                    $tfuse_class = ' class="middle sidebarLeft"';
                elseif ($sidebar_position == 'right')
                    $tfuse_class = ' class="middle sidebarRight"';
                else
                    $tfuse_class = ' class="middle"';
            }
        }
        elseif ($param == 'content') {
            $tfuse_class = ( isset($sidebar_position) && $sidebar_position != 'full' ) ? ' class="grid_8 content"' : ' class="content"';
        }

        if ($return)
            return $tfuse_class;
        else
            echo $tfuse_class;
    }
endif;


if (!function_exists('tfuse_sidebar_position')):
/* This Function Set sidebar position
 * To override tfuse_sidebar_position() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
*/
    function tfuse_sidebar_position() {
        global $TFUSE;

        $sidebar_position = $TFUSE->ext->sidebars->current_position;
        if ( empty($sidebar_position) ) $sidebar_position = 'full';

        return $sidebar_position;
    }

// End function tfuse_sidebar_position()
endif;


if (!function_exists('tfuse_count_post_visits')) :
/**
 * tfuse_count_post_visits.
 * 
 * To override tfuse_count_post_visits() in a child theme, add your own tfuse_count_post_visits() 
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_count_post_visits()
    {
        if ( !is_single() ) return;

        global $post;

        $views = get_post_meta($post->ID, TF_THEME_PREFIX . '_post_viewed', true);
        $views = intval($views);
        tf_update_post_meta( $post->ID, TF_THEME_PREFIX . '_post_viewed', ++$views);
    }
	add_action('wp_head', 'tfuse_count_post_visits');

// End function tfuse_count_post_visits()
endif;


if (!function_exists('tfuse_custom_title')):

    function tfuse_custom_title() {
        global $post;
        $tfuse_title_type = tfuse_page_options('page_title');

        if ($tfuse_title_type == 'hide_title')
            $title = '';
        elseif ($tfuse_title_type == 'custom_title')
            $title = tfuse_page_options('custom_title');
        else
            $title = get_the_title();

        echo ( $title ) ? '<h1>' . $title . '</h1>' : '';
    }

endif;

if (!function_exists('tfuse_archive_custom_title')):
/**
 *  Set the name of post archive.
 *
 * To override tfuse_archive_custom_title() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_archive_custom_title()
    {
        $cat_ID = 0;
        if ( is_category() )
        {
            $cat_ID = get_query_var('cat');
            $title = single_term_title( '', false );
        }
        elseif ( is_tax() )
        {
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $cat_ID = $term->term_id;
            $title = single_term_title( $term->name , false );
        }
        elseif ( is_post_type_archive() )
        {
            $title = post_type_archive_title('',false);
        }

        $tfuse_title_type = tfuse_options('page_title',null,$cat_ID);

        if ($tfuse_title_type == 'hide_title')
            $title = '';
        elseif ($tfuse_title_type == 'custom_title')
            $title = tfuse_options('custom_title',null,$cat_ID);

        echo !empty($title) ? '<h1>' . $title . '</h1>' : '';
    }

endif;



if (!function_exists('tfuse_user_profile')) :
/**
 * Retrieve the requested data of the author of the current post.
 *  
 * @param array $fields first_name,last_name,email,url,aim,yim,jabber,facebook,twitter etc.
 * @return null|array The author's spefified fields from the current author's DB object.
 */
    function tfuse_user_profile( $fields = array() )
    {
        $tfuse_meta = null;

        // Get stnadard user contact info
        $standard_meta = array(
            'first_name' => get_the_author_meta('first_name'),
            'last_name' => get_the_author_meta('last_name'),
            'email'     => get_the_author_meta('email'),
            'url'       => get_the_author_meta('url'),
            'aim'       => get_the_author_meta('aim'),
            'yim'       => get_the_author_meta('yim'),
            'jabber'    => get_the_author_meta('jabber')
        );

        // Get extended user info if exists
        $custom_meta = (array) get_the_author_meta('theme_fuse_extends_user_options');

        $_meta = array_merge($standard_meta,$custom_meta);

        foreach ($_meta as $key => $item) {
            if ( !empty($item) && in_array($key, $fields) ) $tfuse_meta[$key] = $item;
        }

        return apply_filters('tfuse_user_profile', $tfuse_meta, $fields);
    }

endif;


if (!function_exists('tfuse_action_comments')) :
/**
 *  This function disable post commetns.
 *
 * To override tfuse_action_comments() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_action_comments() {
        global $post;
        if (!tfuse_page_options('disable_comments'))
            comments_template( '', true );
    }

    add_action('tfuse_comments', 'tfuse_action_comments');
endif;


if (!function_exists('tfuse_get_comments')):
/**
 *  Get post comments for a specific post.
 *
 * To override tfuse_get_comments() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_get_comments($return = TRUE, $post_ID) {
        $num_comments = get_comments_number($post_ID);

        if (comments_open($post_ID)) {
            if ($num_comments == 0) {
                $comments = __('No Comments','tfuse');
            } elseif ($num_comments > 1) {
                $comments = $num_comments . __(' Comments','tfuse');
            } else {
                $comments = __('1 Comment','tfuse');
            }
            $write_comments = '<a class="link-comments" href="' . get_comments_link() . '">' . $comments . '</a>';
        } else {
            $write_comments = __('Comments are off','tfuse');
        }
        if ($return)
            return $write_comments;
        else
            echo $write_comments;
    }

endif;


function tfuse_pagination( $args = array(), $query = '' ) {
    global $wp_rewrite, $wp_query;

        if ( $query ) {

            $wp_query = $query;

        } // End IF Statement


        /* If there's not more than one page, return nothing. */
        if ( 1 >= $wp_query->max_num_pages )
            return false;

        /* Get the current page. */
        $current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );

        /* Get the max number of pages. */
        $max_num_pages = intval( $wp_query->max_num_pages );

        /* Set up some default arguments for the paginate_links() function. */
        $defaults = array(
            'base' => esc_url(add_query_arg( 'paged', '%#%' )),
            'format' => '',
            'total' => $max_num_pages,
            'current' => $current,
            'prev_next' => false,
            'show_all' => false,
            'end_size' => 2,
            'mid_size' => 1,
            'add_fragment' => '',
            'type' => 'plain',
            'before' => '',
            'after' => '',
            'echo' => true,
        );

        /* Add the $base argument to the array if the user is using permalinks. */
        if( $wp_rewrite->using_permalinks() )
            $defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );

        /* If we're on a search results page, we need to change this up a bit. */
        if ( is_search() ) {
            $search_permastruct = $wp_rewrite->get_search_permastruct();
            if ( !empty( $search_permastruct ) )
                $defaults['base'] = user_trailingslashit( trailingslashit( get_search_link() ) . 'page/%#%' );
        }

        /* Merge the arguments input with the defaults. */
        $args = wp_parse_args( $args, $defaults );

        /* Don't allow the user to set this to an array. */
        if ( 'array' == $args['type'] )
            $args['type'] = 'plain';

        /* Get the paginated links. */
        $page_links = paginate_links( $args );

        /* Remove 'page/1' from the entire output since it's not needed. */
        $page_links = str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_links );

        /* Wrap the paginated links with the $before and $after elements. */
        $page_links = $args['before'] . $page_links . $args['after'];

        /* Return the paginated links for use in themes. */
        if ( $args['echo'] )
        {
            ?>
        <!-- pagination -->
            <br />
            <div class="tf_pagination">
                <div class="inner">
                    <div class="page_prev"><span><?php echo $prev_posts = get_previous_posts_link(__('Previous', 'tfuse')); ?></span></div>		
                    <div class="page_next"><span><?php echo $next_posts = get_next_posts_link(__('Next', 'tfuse')); ?></span></div>
                    <?php echo $page_links; ?>
                </div>
            </div>
        

            <?php
        }
        else
            return $page_links;

} 


if (!function_exists('tfuse_shortcode_content')) :
/**
 *  Get post comments for a specific post.
 *
 * To override tfuse_shortcode_content() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_shortcode_content($position = '', $return = false)
    {
        $page_shortcodes = '';
        global $is_tf_front_page,$is_tf_blog_page,$post;
        
        $position = ( $position == 'before' ) ? 'content_top' : 'content_bottom';

        if((is_front_page() || $is_tf_front_page) && !$is_tf_blog_page)
        {  
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page'){
                $page_id = $post->ID;
                $page_shortcodes = tfuse_page_options($position,'',$page_id);
            }
            else
            $page_shortcodes = tfuse_options($position);
        }
        elseif($is_tf_blog_page)
        { 
           $position ='blog_'.$position;
            $page_shortcodes = tfuse_options($position);
        }
        elseif (is_singular()) {
            global $post;
            $page_shortcodes = tfuse_page_options($position);
        } elseif (is_category()) {
            $cat_ID = get_query_var('cat');
            $page_shortcodes = tfuse_options($position, '', $cat_ID);
        } elseif (is_tax()) {
            $taxonomy = get_query_var('taxonomy');
            $term = get_term_by('slug', get_query_var('term'), $taxonomy);
            $cat_ID = $term->term_id;
            $page_shortcodes = tfuse_options($position, '', $cat_ID);
        }

        $page_shortcodes = tfuse_qtranslate($page_shortcodes);

        $page_shortcodes = apply_filters('themefuse_shortcodes', $page_shortcodes);

        if ($return)
            return $page_shortcodes; else
            echo $page_shortcodes;
    }

// End function tfuse_shortcode_content()
endif;


if (!function_exists('tfuse_category_on_front_page')) :
/**
 * Dsiplay homepage category
 *
 * To override tfuse_category_on_front_page() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_category_on_front_page()
    {
        if ( !is_front_page() ) return;

        global $is_tf_front_page,$homepage_categ;
        $is_tf_front_page = false;

        $homepage_category = tfuse_options('homepage_category');
        $homepage_category = explode(",",$homepage_category);
        foreach($homepage_category as $homepage)
        {
            $homepage_categ = $homepage;
        }

        if($homepage_categ == 'specific')
        {
            $is_tf_front_page = true;
            $archive = 'archive-content.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;           
            
            $specific = tfuse_options('categories_select_categ');

            $ids = explode(",",$specific);
            $posts = array(); 
            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                        'cat' => $specific,
                        'orderby' => 'date',
                        'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
                        
            return;
        }
        elseif($homepage_categ == 'page')
        {
            global $front_page;
            $is_tf_front_page = true;
            $front_page = true;
            $archive = 'page.php';
            $page_id = tfuse_options('home_page');

            $args=array(
                'page_id' => $page_id,
                'post_type' => 'page',
                'post_status' => 'publish',
                'posts_per_page' => 1,
                'ignore_sticky_posts'=> 1
            );
            query_posts($args);
            include_once(locate_template($archive));
            wp_reset_query();
            return;
        }
        elseif($homepage_categ == 'all')
        {
            $archive = 'archive-content.php';

            $is_tf_front_page = true;
            wp_reset_postdata();
            include_once(locate_template($archive));
            return;
        }
 
    }

// End function tfuse_category_on_front_page()
endif;

if (!function_exists('tfuse_category_on_blog_page')) :
    /**
     * Dsiplay blogpage category
     *
     * To override tfuse_category_on_blog_page() in a child theme, add your own tfuse_count_post_visits()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

    function tfuse_category_on_blog_page()
    {
        global $is_tf_blog_page;
        $blogpage_categ ='';
        if ( !$is_tf_blog_page ) return;
        $is_tf_blog_page = false;

        $blogpage_category = tfuse_options('blogpage_category');
        $blogpage_category = explode(",",$blogpage_category);
        foreach($blogpage_category as $blogpage)
        {
            $blogpage_categ = $blogpage;
        }
        if($blogpage_categ == 'specific')
        {
            $is_tf_blog_page = true;
            $archive = 'archive-content.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $specific = tfuse_options('categories_select_categ_blog');

            $ids = explode(",",$specific);
            $posts = array();
            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                'cat' => $specific,
                'orderby' => 'date',
                'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
            return;
        }
        else
        {
            $is_tf_blog_page = true;
            $archive = 'archive-content.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $categories = get_categories();

            $ids = array();
            foreach($categories as $cats){
                $ids[] = $cats -> term_id;
            }
            $posts = array(); 

            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                'orderby' => 'date',
                'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
            return;
        }
    }
// End function tfuse_category_on_blog_page()
endif;

add_filter('get_archives_link','wid_link',99);
if (!function_exists('wid_link')) :
    function wid_link($url) {
        $url = str_replace( '</a>&nbsp;', '&nbsp;', $url );
        $url = str_replace( '</li>', '</a></li>', $url );
        return $url;
    }
endif;

add_filter('wp_list_bookmarks','wid_link1',99);
if (!function_exists('wid_link1')) :
    function wid_link1($url) {
        $url = str_replace( '</a>', '', $url );
        $url = str_replace( '</li>', '</a></li>', $url );
        return $url;
    }
endif;
    
add_filter('wp_list_categories','wid_link2',99);
if (!function_exists('wid_link2')) :
    function wid_link2($url) {
        $url = str_replace( '</a>', '', $url );
        $url = str_replace( '</li>', '</a></li>', $url );
        return $url;
    }
endif;
    
if (!function_exists('tfuse_action_footer')) :

/**
 * Dsiplay footer content
 *
 * To override tfuse_category_on_front_page() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_action_footer() {
        if ( !tfuse_options('enable_footer_shortcodes') ) {
            ?>
            <div class="f_col f_col_1">
                <?php dynamic_sidebar('footer-1'); ?>
            </div>

            <div class="f_col f_col_2">
                <?php dynamic_sidebar('footer-2'); ?>
            </div>

            <div class="f_col f_col_3">
                <?php dynamic_sidebar('footer-3'); ?>
            </div>

            <div class="f_col f_col_4">
                <?php dynamic_sidebar('footer-4'); ?>
                <div class="copyright">
                    <?php echo tfuse_options('footer_copyright');?>
                </div>
            </div>
            <?php
        } else {
            $footer_shortcodes = tfuse_options('footer_shortcodes');
            echo $page_shortcodes = apply_filters('themefuse_shortcodes', $footer_shortcodes);
        }
    }

    add_action('tfuse_footer', 'tfuse_action_footer');
endif;

//Excerpt

function new_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

if (!function_exists('tfuse_group_title')) :
    function tfuse_group_title(){
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
        $ID = $term->term_id;
        $title = tfuse_options('group_title',null,$ID);
        echo $title;
    }
endif;

if (!function_exists('tfuse_get_tags')) :
    /**
     * To override tfuse_get_tags in a child theme, add your own tfuse_shorten_string()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

function tfuse_get_tags()
{
    global $post;
	$post = &get_post($post->ID);
	$post_type = $post->post_type;
	$taxonomies = get_object_taxonomies($post_type);
	$tags = wp_get_post_terms($post->ID,$taxonomies[1]);
	for($i=0;$i<count($tags);$i++)
        {
            $tags_link = get_term_link( $tags[$i]->slug ,$taxonomies[1]);
            if ($i != 0) echo ',';
            echo '<a href="'.$tags_link.'">';
                    echo $tags[$i]->name;
            echo '</a>';
        }
}
endif;

if (!function_exists('tfuse_header_single')) :
    /**
     * To override tfuse_header_single in a child theme, add your own tfuse_header_single
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

function tfuse_header_single()
{  
    global $is_tf_blog_page;
    if(is_front_page() || $is_tf_blog_page)
    {
        if(tfuse_options('header_element') == 'without')
        {
            echo 'single';
        }
    }
    elseif(is_page() || is_single())
    {
        if(tfuse_page_options('header_element') == 'without')
        {
            echo 'single';
        }
    }
}
endif;
if (!function_exists('tfuse_cat_names')) :	
    function tfuse_cat_names() 
    {	
        global $post;
        $cat_name = get_the_category();
        $post = get_post($post->ID);
        $post_type = $post->post_type;
        $taxonomies = get_object_taxonomies($post_type);
        if($taxonomies[0] == 'category') { 
            $cat_link = get_category_link($cat_name[0]->cat_ID);
            $cat_names = $cat_name[0]->cat_name;
        }

        if($taxonomies[0] == 'category') { ?>
            in <a href="<?php echo $cat_link; ?>">
            <?php echo $cat_names;
        }?>
        </a>
    <?php
    }
endif;

//show cat_name
if (!function_exists('tfuse_show_cat_name')) :	
    function tfuse_show_cat_name() {
        global $is_tf_front_page,$is_tf_blog_page;
        $cat_name = get_the_category();
            if($is_tf_blog_page)
            {
                echo $cat_name[0]->cat_name;
            }
            elseif($is_tf_front_page)
            { 
                 echo $cat_name[0]->cat_name;
            }
            elseif (is_category()) 
            {
                echo $cat_name[0]->cat_name; 
            }
    }
endif;

//show postlist_view
if (!function_exists('tfuse_postlist_view')) :	
    function tfuse_postlist_view() {
        global $is_tf_blog_page;
        global $TFUSE;
        $expire=time()+60*60*24*30;
	$view = $TFUSE->request->isset_GET('view') ? $TFUSE->request->GET('view') : "grid";
	if ($view=='list') setcookie("themes_view", "list", $expire); 
	elseif ($view=='grid') setcookie("themes_view", "grid", $expire);
        $cat_ID = get_query_var('cat');
	$topbar =  $TFUSE->request->isset_GET('navibar') ? $TFUSE->request->GET('navibar') : "";
        
        $permalink = get_permalink();
        $str = "?";
        $pos = strpos($permalink,$str);
        $str = substr($permalink,$pos,strlen($str));
            if(!$TFUSE->request->isset_COOKIE("themes_view")) $TFUSE->request->COOKIE("themes_view", 'grid');
	
            if ($topbar == 'all')
            {
                if ( ($TFUSE->request->COOKIE("themes_view")=='list' && $view!='grid' ) || $view == 'list' ) { ?>
                <a href="?navibar=all&view=list"  class="link_view_list active"><?php _e('List View', 'tfuse') ?></a>  
                <a href="?navibar=all&view=grid"  class="link_view_grid"><?php _e('Grid View', 'tfuse') ?></a> 
                <?php } else { ?>
                <a href="?navibar=all&view=list"  class="link_view_list"><?php _e('List View', 'tfuse') ?></a>
                <a href="?navibar=all&view=grid"  class="link_view_grid active"><?php _e('Grid View', 'tfuse') ?></a> 
                <?php }  
            }
            elseif ($topbar == 'most_commented')
            { 
                if ( ($TFUSE->request->COOKIE("themes_view")=='list' && $view!='grid' ) || $view == 'list' ) { ?>
                <a href="?navibar=most_commented&view=list"  class="link_view_list active"><?php _e('List View', 'tfuse') ?></a>  
                <a href="?navibar=most_commented&view=grid"  class="link_view_grid"><?php _e('Grid View', 'tfuse') ?></a> 
                <?php } else { ?>
                <a href="?navibar=most_commented&view=list"  class="link_view_list"><?php _e('List View', 'tfuse') ?></a>
                <a href="?navibar=most_commented&view=grid"  class="link_view_grid active"><?php _e('Grid View', 'tfuse') ?></a> 
                <?php }  
            }
            elseif ($topbar == 'most_viewed')
            {
                if ( ($TFUSE->request->COOKIE("themes_view")=='list' && $view!='grid' ) || $view == 'list' ) { ?>
                <a href="?navibar=most_viewed&view=list"  class="link_view_list active"><?php _e('List View', 'tfuse') ?></a>  
                <a href="?navibar=most_viewed&view=grid"  class="link_view_grid"><?php _e('Grid View', 'tfuse') ?></a> 
                <?php } else { ?>
                    <a href="?navibar=most_viewed&view=list"  class="link_view_list"><?php _e('List View', 'tfuse') ?></a>
                <a href="?navibar=most_viewed&view=grid"  class="link_view_grid active"><?php _e('Grid View', 'tfuse') ?></a> 
                <?php }  
            }
            else
            {
                
                if( $str == '?')
                {
                    if(is_search() || is_author() || (is_archive() && !is_category()) || is_404() || is_tag() || is_front_page())
                    {
                        if ( ($TFUSE->request->COOKIE("themes_view")=='list' && $view!='grid' ) || $view == 'list' ) { ?>
                        <a href="<?php echo get_category_link( $cat_ID )?>?view=list"  class="link_view_list active"><?php _e('List View', 'tfuse') ?></a> 
                        <a href="<?php echo get_category_link( $cat_ID )?>?view=grid"  class="link_view_grid"><?php _e('Grid View', 'tfuse') ?></a> 
                        <?php } else { ?>
                        <a href="<?php echo get_category_link( $cat_ID )?>?view=list"  class="link_view_list"><?php _e('List View', 'tfuse') ?></a>
                        <a href="<?php echo get_category_link( $cat_ID )?>?view=grid"  class="link_view_grid active"><?php _e('Grid View', 'tfuse') ?></a> 
                        <?php } 
                    }
                    elseif(is_page() || $is_tf_blog_page)
                    {
                        $page_id = $link = '';
                        $page_id = tfuse_options('blog_page');
                        $link = get_page_link($page_id);
                        if($is_tf_blog_page)
                        {
                            if ( ($TFUSE->request->COOKIE("themes_view")=='list' && $view!='grid' ) || $view == 'list' ) { ?>
                        <a href="<?php echo $link?>&view=list"  class="link_view_list active"><?php _e('List View', 'tfuse') ?></a> 
                        <a href="<?php echo $link?>&view=grid"  class="link_view_grid"><?php _e('Grid View', 'tfuse') ?></a> 
                        <?php } else { ?>
                        <a href="<?php echo $link?>&view=list"  class="link_view_list"><?php _e('List View', 'tfuse') ?></a>
                        <a href="<?php echo $link?>&view=grid"  class="link_view_grid active"><?php _e('Grid View', 'tfuse') ?></a> 
                        <?php } 
                        }
                    }
                    else
                    {
                        if ( ($TFUSE->request->COOKIE("themes_view")=='list' && $view!='grid' ) || $view == 'list' ) { ?>
                        <a href="<?php echo get_category_link( $cat_ID )?>&view=list"  class="link_view_list active"><?php _e('List View', 'tfuse') ?></a> 
                        <a href="<?php echo get_category_link( $cat_ID )?>&view=grid"  class="link_view_grid"><?php _e('Grid View', 'tfuse') ?></a> 
                        <?php } else { ?>
                        <a href="<?php echo get_category_link( $cat_ID )?>&view=list"  class="link_view_list"><?php _e('List View', 'tfuse') ?></a>
                        <a href="<?php echo get_category_link( $cat_ID )?>&view=grid"  class="link_view_grid active"><?php _e('Grid View', 'tfuse') ?></a> 
                        <?php } 
                    }
                }
                else
                {
                    if ( ($TFUSE->request->COOKIE("themes_view")=='list' && $view!='grid' ) || $view == 'list' ) { ?>
                    <a href="<?php echo get_category_link( $cat_ID )?>?view=list"  class="link_view_list active"><?php _e('List View', 'tfuse') ?></a> 
                    <a href="<?php echo get_category_link( $cat_ID )?>?view=grid"  class="link_view_grid"><?php _e('Grid View', 'tfuse') ?></a> 
                    <?php } else { ?>
                    <a href="<?php echo get_category_link( $cat_ID )?>?view=list"  class="link_view_list"><?php _e('List View', 'tfuse') ?></a>
                    <a href="<?php echo get_category_link( $cat_ID )?>?view=grid"  class="link_view_grid active"><?php _e('Grid View', 'tfuse') ?></a> 
                    <?php } 
                }
            }
    }
endif;

//show tags before
if (!function_exists('tfuse_show_list_before')) :	
    function tfuse_show_list_before() {
        global $TFUSE;
        $view =  $TFUSE->request->isset_GET('view') ? $TFUSE->request->GET('view') : "grid";
        $topbar =  $TFUSE->request->isset_GET('navibar') ? $TFUSE->request->GET('navibar') : "";
        if(($TFUSE->request->COOKIE("themes_view")=='grid' && $view!='list' ) || $view == 'grid' )
        {
            echo '<div class="postlist layout-grid">';
        }
        elseif(($TFUSE->request->COOKIE("themes_view")=='list' && $view!='grid' ) || $view == 'list' )
        {
            if($topbar == 'most_commented' || $topbar == 'most_viewed' || $topbar == 'all')
            {   
                echo '<div class="postlist">';
            }
            else
            {
                echo '<div class="postlist">';
            }
        }
    }
endif;

//show tags before
if (!function_exists('tfuse_get_template')) :	
    function tfuse_get_template() {
        global $TFUSE;
        $view =  $TFUSE->request->isset_GET('view') ? $TFUSE->request->GET('view') : "grid";
        $topbar =  $TFUSE->request->isset_GET('navibar') ? $TFUSE->request->GET('navibar') : "";
        if(($TFUSE->request->COOKIE("themes_view")=='grid' && $view!='list' ) || $view == 'grid' )
        {
            get_template_part('post', 'grid');
        } 
        else
        {
            if($topbar == 'most_commented' || $topbar == 'most_viewed' || $topbar == 'all')
            {   
                get_template_part('post', 'list');
            }
            else
            {
                get_template_part('post', 'list');
            }
        }
    }
endif;

//show tags before
if (!function_exists('tfuse_get_cat_link')) :	
    function tfuse_get_cat_link() {
        $cat_name = get_the_category();
        $category_id = get_cat_ID( $cat_name[0]->cat_name );
        $cat_link = get_category_link( $category_id );
        echo $cat_link;
    }
endif;

//select the id of category
if (!function_exists('tfuse_data')) :
function tfuse_data() {
	$ID = get_query_var('cat');
	if(is_category())
	{
		$ID = $ID;
	}
    return $ID;
}
endif;

//image position
if (!function_exists('tfuse_img_pos')) :
function tfuse_img_pos() { 
    $pos = tfuse_page_options('thumbnail_position');
    if($pos == 'alignright')
        $pos = 'image-right';
    return $pos;
}
endif;

//title color
if (!function_exists('tfuse_title_color')) :
function tfuse_title_color() { 
    global $is_tf_front_page,$is_tf_blog_page,$post;
    $cat_id = get_query_var('cat');
    if($is_tf_blog_page)
    {
        $color = tfuse_options('title_color_blog');
        if(empty($color))
        {
            $ex_categ = wp_get_post_categories($post->ID);
            foreach($ex_categ as $categ):
                $color = tfuse_options('title_color_cat',null, $categ);
            endforeach;
        }
        else
        {
            $color = tfuse_options('title_color_blog');
        }
    }
    elseif(is_front_page() || $is_tf_front_page)
    {
        $color = tfuse_options('title_color'); 
        if(empty($color))
        {
            $ex_categ = wp_get_post_categories($post->ID);
            foreach($ex_categ as $categ):
                $color = tfuse_options('title_color_cat',null, $categ);
            endforeach;
        }
        else
        {
            $color = tfuse_options('title_color'); 
        }
    }
    else
    {
        $color = tfuse_options('title_color_cat',null, $cat_id);
    }
        if(!empty($color))
        {
            $color = 'style="color:'.$color.';"';
        }

    return $color;
}
endif;

if (!function_exists('tfuse_bg_color')) :
function tfuse_bg_color() { 
    global $is_tf_front_page,$is_tf_blog_page,$post;
    $cat_id = get_query_var('cat');
    if($is_tf_blog_page)
    {
        $color = tfuse_options('title_color_blog');
        if(empty($color))
        {
            $ex_categ = wp_get_post_categories($post->ID);
            foreach($ex_categ as $categ):
                $color = tfuse_options('title_color_cat',null, $categ);
            endforeach;
        }
        else
        {
            $color = tfuse_options('title_color_blog');
        }
    }
    elseif(is_front_page() || $is_tf_front_page)
    {
        $color = tfuse_options('title_color');
        if(empty($color))
        {
            $ex_categ = wp_get_post_categories($post->ID);
            foreach($ex_categ as $categ):
                $color = tfuse_options('title_color_cat',null, $categ);
            endforeach;
        }
        else
        {
            $color = tfuse_options('title_color'); 
        }
    }
    else
    {
        $color = tfuse_options('title_color_cat',null, $cat_id);
    }
        if(!empty($color))
        {
            $color = 'style="background-color:'.$color.';"';
        }

    return $color;
}
endif;

//div clear for grid
if (!function_exists('tfuse_separator')) :
function tfuse_separator($count,$sidebar_position) {
    global $TFUSE;
    $view =  $TFUSE->request->isset_GET('view') ? $TFUSE->request->GET('view') : "grid";
    if(($TFUSE->request->COOKIE("themes_view")=='grid' && $view!='list' ) || $view == 'grid' )
    {
        if($sidebar_position == 'right' || $sidebar_position == 'left')
        {
            if($count % 2 == 0)
                echo '<div class="clear"></div>';
        }
        elseif($sidebar_position == 'full')
        {
            if($count % 3 == 0)
                echo '<div class="clear"></div>';
        }
    } 
}
endif;

//navibar	
if (!function_exists('tfuse_navibar')) :

function tfuse_navibar() {
    global $TFUSE;
    $topbar =  $TFUSE->request->isset_GET('navibar') ? $TFUSE->request->GET('navibar') : "";
        if($topbar == 'all')
        {
            echo '<a href="?navibar=all" class="active">'.__('All', 'tfuse').'</a>';
        }
        else
        {
            echo '<a href="?navibar=all" >'.__('All', 'tfuse').'</a>';
        }
        if($topbar == 'most_viewed')
        {
            echo '<a href="?navibar=most_viewed" class="active">'.__('Most viewed', 'tfuse').'</a>';
        }
        else
        {
            echo '<a href="?navibar=most_viewed" >'.__('Most viewed', 'tfuse').'</a>';
        }
        if($topbar == 'most_commented')
        {
            echo '<a href="?navibar=most_commented" class="active">'.__('Most commented', 'tfuse').'</a>';
        }
        else
        {
            echo '<a href="?navibar=most_commented" >'.__('Most commented', 'tfuse').'</a>';
        }
}
endif;

//get cat_slug
if (!function_exists('tfuse_get_cat_slug')) :
    function tfuse_get_cat_slug() {
            $categories = get_categories();
            foreach($categories as $cat){
                    $cat_slug[] = $cat->slug ;
            }		
            $string = implode (',', $cat_slug);
            return $string;
    }
endif;

//most commented
if (!function_exists('tfuse_most_commented')) :
    function tfuse_most_commented($count,$sidebar_position) {
    $count = $count;
    $sidebar_position = $sidebar_position;
    $paged = get_query_var('paged');
        $the_query = new WP_Query(array( 'paged'=> $paged,'orderby' => 'comment_count' ));

        while ( $the_query->have_posts() ) : $the_query->the_post();  $count++;
                tfuse_get_template();
                tfuse_separator($count,$sidebar_position);
        endwhile;
    }
endif;

//most viewed
if (!function_exists('tfuse_most_viewed')) :
    function tfuse_most_viewed($count,$sidebar_position) {
    $count = $count;
    $sidebar_position = $sidebar_position;
    $paged = get_query_var('paged');

        $the_query = new WP_Query(array( 'paged'=> $paged,'orderby' => 'meta_value', 'meta_key' => TF_THEME_PREFIX.'_post_viewed', 'order '=>'DESC' ));

        while ( $the_query->have_posts() ) : $the_query->the_post();  $count++;
                tfuse_get_template();
                tfuse_separator($count,$sidebar_position);
        endwhile;

    }
endif;

//all posts
if (!function_exists('tfuse_all')) :
    function tfuse_all($count,$sidebar_position) {
    $count = $count;
    $sidebar_position = $sidebar_position;
    $string = tfuse_get_cat_slug();
    $paged = get_query_var('paged');
        $the_query = new WP_Query(array( 'paged'=> $paged,'orderby' => 'date','category_name' => $string ));
        while ( $the_query->have_posts() ) : $the_query->the_post();  $count++;
                tfuse_get_template();
                tfuse_separator($count,$sidebar_position);
        endwhile;
    }
endif;

//display logo
if (!function_exists('tfuse_type_logo')) :
    function tfuse_type_logo() { 
        if(tfuse_options('choose_logo') == 'text') 
        {  ?> 
               <a href="<?php echo home_url(); ?>"><strong><?php echo tfuse_options('logo_text'); ?></strong></a>
                <div class="logo-sub"><?php echo tfuse_options('logo_text_subtitle'); ?></div>
       <?php }
        elseif(tfuse_options('choose_logo') == 'custom')
        { ?>
            <a href="<?php echo home_url(); ?>"><div class="logo-img"><img src="<?php echo tfuse_logo(); ?>" alt="<?php bloginfo('name'); ?>"  border="0" /></div></a>
       <?php }
	   else 
	   { ?>
			<a href="<?php echo home_url(); ?>"><strong><?php echo tfuse_options('logo_text','Gadgetry'); ?></strong></a>
			<div class="logo-sub"><?php echo tfuse_options('logo_text_subtitle','Just another Themefuse Theme'); ?></div>
   <?php }
    }
endif;

//change site style
if (!function_exists('tfuse_site_style')) :
    function tfuse_site_style() {
        global $TFUSE;
        if ($TFUSE->request->isset_GET('color'))$color_scheme = $TFUSE->request->GET('color');
        else $color_scheme = tfuse_options('theme_stylesheet');
        if($color_scheme=='brown')
        {
            echo '<style>
                .header, .navibar, footer {background-color:#362200}
                .bar_style2 {background-color:#362200}
                footer ul li, footer .widget-container ul li, footer ul>li:first-child, footer .widget_recent_comments li, footer .widget_popular_posts li, footer .widget_recent_entries li,
                footer .widget_twitter .tweet_item, .link_view_grid.active, .link_view_list.active, .link_view_grid.active:hover, .link_view_list.active:hover,
                .dropdown .menu-level-0:hover a, .dropdown .menu-level-0.current-menu-item a, .dropdown .menu-level-0.current-menu-ancestor a {border-color:#513506 !important;}
                .title h1 {color:#8f5a00}
                </style>';
        }
        elseif($color_scheme=='green')
        {
            echo '<style>
                .header, .navibar, footer {background-color:#0f3001}
                .bar_style2 {background-color:#0f3001}
                footer ul li, footer .widget-container ul li, footer ul>li:first-child, footer .widget_recent_comments li, footer .widget_popular_posts li, footer .widget_recent_entries li,
                footer .widget_twitter .tweet_item, .link_view_grid.active, .link_view_list.active, .link_view_grid.active:hover, .link_view_list.active:hover,
                .dropdown .menu-level-0:hover a, .dropdown .menu-level-0.current-menu-item a, .dropdown .menu-level-0.current-menu-ancestor a {border-color:#21510c !important;}
                .title h1 {color:#268000}
                </style>';
        }
        elseif($color_scheme=='purple')
        {
            echo '<style>
                .header, .navibar, footer {background-color:#6d005c}
                .bar_style2 {background-color:#6d005c}
                footer ul li, footer .widget-container ul li, footer ul>li:first-child, footer .widget_recent_comments li, footer .widget_popular_posts li, footer .widget_recent_entries li,
                footer .widget_twitter .tweet_item, .link_view_grid.active, .link_view_list.active, .link_view_grid.active:hover, .link_view_list.active:hover,
                .dropdown .menu-level-0:hover a, .dropdown .menu-level-0.current-menu-item a, .dropdown .menu-level-0.current-menu-ancestor a {border-color:#ffffff;}
                .title h1 {color:#000}
                </style>';
        }
        elseif($color_scheme=='custom')
        {
            $bg_color = tfuse_options('bg_color');
            $navibar = tfuse_options('navibar_color');
            $border_color = tfuse_options('color_active');
            $color_title = tfuse_options('color_title');
            echo '<style>';
            if(!empty($bg_color))
            {
                echo '.header, footer {background-color:'.$bg_color.'}';
            }
                if($navibar == 'same')
                {
                    echo '.navibar {background-color:'.$bg_color.'}';
                }
                elseif($navibar == 'style2')
                {
                    echo ' .navibar {background-color: #44A6CB;}';
                }
                elseif($navibar == 'custom')
                {
                    echo ' .navibar {background-color: '.tfuse_options('custom_color_navibar').';}';
                }
            if(!empty($border_color))
            {
                echo 'footer ul li, footer .widget-container ul li, footer ul>li:first-child, footer .widget_recent_comments li, footer .widget_popular_posts li, footer .widget_recent_entries li,
                footer .widget_twitter .tweet_item, .link_view_grid.active, .link_view_list.active, .link_view_grid.active:hover, .link_view_list.active:hover,
                .dropdown .menu-level-0:hover a, .dropdown .menu-level-0.current-menu-item a, .dropdown .menu-level-0.current-menu-ancestor a,
                .dropdown .menu-item:hover a, .dropdown .menu-item.current-menu-item a, .dropdown .menu-item.current-menu-ancestor a{border-color:'.$border_color.' !important;}';
            }
            if(!empty($color_title))
            {
                echo '.title h1 {color:'.$color_title.'}';
            }
            echo '</style>';
        }
        else
        {
            return;
        }
    }
endif;

//change bg
if (!function_exists('tfuse_change_bg')) :
    function tfuse_change_bg() {
        global $TFUSE;
        if ($TFUSE->request->isset_GET('color'))$color_scheme = $TFUSE->request->GET('color');
        else $color_scheme = tfuse_options('theme_stylesheet');
		$template_directory = get_template_directory_uri();
            if($color_scheme=='brown')
            {
                echo 'style="background-image:url('.$template_directory.'/images/bg/bg_image_6.jpg)"';
            }
            elseif($color_scheme=='green')
            {
                echo 'style="background-image:url('.$template_directory.'/images/bg/bg_image_6.png)"';
            }
            elseif($color_scheme=='purple')
            {
                echo 'style="background-image:url('.$template_directory.'/images/bg/bg_image_9.png);"';
            }
            elseif($color_scheme=='custom')
            {
                $bg_img = tfuse_options('bg_site');
                if(!empty($bg_img))
                    echo 'style="background-image:url('.$bg_img.'); background-repeat:'.tfuse_options('bg_repeat').';"';
            }
            else
            {
                return;
            }
    }
endif;

//navibar color
if (!function_exists('tfuse_navibar_color')) :
    function tfuse_navibar_color() {
        global $is_tf_blog_page;
        $ID = get_query_var('cat');
        if(is_front_page())
        {
            $col = tfuse_options('custom_color_navibar_cat');
        }
        elseif($is_tf_blog_page)
        {
            $col = tfuse_options('custom_color_navibar_cat_blog');
        }
        else
        {
            $col = tfuse_options('custom_color_navibar_cat_categ',null,$ID);
        }
            if(!empty($col))
            {
                echo 'style="background-color:'.$col.' !important"}';
            }
        
    }
endif;

//Advertising

//Top Ad
if (!function_exists('tfuse_top_adds')) :
    function tfuse_top_adds() {
        global $post,$is_tf_blog_page;
        $ID = '';
        if($is_tf_blog_page)
        {  
            if(tfuse_options('blog_top_ad_space') == 'true')
            { 
                if(tfuse_options('blog_top_ad_space')=='true'&&!tfuse_options('blog_top_ad_image')&&!tfuse_options('blog_top_ad_adsense')){
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('blog_top_ad_adsense')&&!tfuse_options('blog_top_ad_image')||tfuse_options('blog_top_ad_adsense')&&tfuse_options('blog_top_ad_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('blog_top_ad_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('blog_top_ad_image')&&!tfuse_options('blog_top_ad_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('blog_top_ad_url').'"  target="_blank"><img src="'.tfuse_options('blog_top_ad_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('blog_top_ad_space') && !tfuse_options('top_ads_space'))
            { 
                if(!tfuse_options('blog_top_ads_space')&&!tfuse_options('blog_top_ads_image')&&!tfuse_options('blog_top_ads_adsense'))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('blog_top_ads_adsense')&&!tfuse_options('blog_top_ads_image')||tfuse_options('blog_top_ads_adsense')&& tfuse_options('blog_top_ads_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('blog_top_ads_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('blog_top_ads_image')&&!tfuse_options('blog_top_ads_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('blog_top_ads_url').'"  target="_blank"><img src="'.tfuse_options('blog_top_ads_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_front_page())
        {  
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page'){
                $page_id = $post->ID;
                if(tfuse_page_options('top_ad_space','',$page_id) == 'true')
                {
                    if(tfuse_page_options('top_ad_space','',$page_id)=='true'&&!tfuse_page_options('top_ad_image','',$page_id)&&!tfuse_page_options('top_ad_adsense','',$page_id)){
                        echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                    }
                    elseif(tfuse_page_options('top_ad_adsense','',$page_id)&&!tfuse_page_options('top_ad_image','',$page_id)||tfuse_page_options('top_ad_adsense','',$page_id)&&tfuse_page_options('top_ad_image','',$page_id))
                    {
                        echo  '<!-- adv before head -->'.tfuse_page_options('top_ad_adsense').' <!-- adv before head -->';
                    }
                    elseif(tfuse_page_options('top_ad_image','',$page_id)&&!tfuse_page_options('top_ad_adsense','',$page_id))
                    {
                        echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_page_options('top_ad_url','',$page_id).'"  target="_blank"><img src="'.tfuse_page_options('top_ad_image','',$page_id).'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                    }
                    else
                    {
                        echo '';
                    }
                }
            }
            elseif(tfuse_options('home_top_ad_space') == 'true')
            {
                if(tfuse_options('home_top_ad_space')=='true'&&!tfuse_options('home_top_ad_image')&&!tfuse_options('home_top_ad_adsense')){
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('home_top_ad_adsense')&&!tfuse_options('home_top_ad_image')||tfuse_options('home_top_ad_adsense')&&tfuse_options('home_top_ad_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('home_top_ad_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('home_top_ad_image')&&!tfuse_options('home_top_ad_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('home_top_ad_url').'"  target="_blank"><img src="'.tfuse_options('home_top_ad_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('home_top_ad_space') && !tfuse_options('top_ads_space'))
            {
                if(!tfuse_options('top_ads_space')&&!tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_adsense')&&!tfuse_options('top_ads_image')||tfuse_options('top_ads_adsense')&&tfuse_options('top_ads_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ads_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ads_url').'"  target="_blank"><img src="'.tfuse_options('top_ads_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_page())
        {
            if(tfuse_page_options('top_ad_space') == 'true')
            {
                if(tfuse_page_options('top_ad_space')=='true'&&!tfuse_page_options('top_ad_image')&&!tfuse_page_options('top_ad_adsense')){
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_page_options('top_ad_adsense')&&!tfuse_page_options('top_ad_image')||tfuse_page_options('top_ad_adsense')&&tfuse_page_options('top_ad_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_page_options('top_ad_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_page_options('top_ad_image')&&!tfuse_page_options('top_ad_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_page_options('top_ad_url').'"  target="_blank"><img src="'.tfuse_page_options('top_ad_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_page_options('top_ad_space') && !tfuse_options('top_ads_space'))
            {
                if(!tfuse_options('top_ads_space')&&!tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_adsense')&&!tfuse_options('top_ads_image')||tfuse_options('top_ads_adsense')&&tfuse_options('top_ads_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ads_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ads_url').'"  target="_blank"><img src="'.tfuse_options('top_ads_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_single() && !is_page())
        { 
            $cat_name = get_the_category();
            $post = get_post($post->ID);
            $cat_id = $cat_name[0]->cat_ID;
            $ID = $post->ID;
            if(!tfuse_page_options('content_ads_post'))
            {  
                if(tfuse_page_options('top_ad_space') == 'true')
                {
                    if(tfuse_page_options('top_ad_space')=='true'&&!tfuse_page_options('top_ad_image')&&!tfuse_page_options('top_ad_adsense')){
                        echo '
                            <!-- adv before head -->
                                <div class="adv_head">
                                    <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                                </div>
                            <!-- adv before head -->';
                    }
                    elseif(tfuse_page_options('top_ad_adsense')&&!tfuse_page_options('top_ad_image')||tfuse_page_options('top_ad_adsense')&&tfuse_page_options('top_ad_image'))
                    {
                        echo  '<!-- adv before head -->'.tfuse_page_options('top_ad_adsense').' <!-- adv before head -->';
                    }
                    elseif(tfuse_page_options('top_ad_image')&&!tfuse_page_options('top_ad_adsense'))
                    {
                        echo  '
                        <!-- adv before head -->
                        <div class="adv_head">
                            <div class="adv_728"><a href="'.tfuse_page_options('top_ad_url').'"  target="_blank"><img src="'.tfuse_page_options('top_ad_image').'" width="728" height="90" alt="advert"></a></div>
                        </div>
                        <!-- adv before head -->
                        ';
                    }
                    else
                    {
                        echo '';
                    }
                }
            }
            elseif(tfuse_page_options('content_ads_post') && tfuse_options('top_ad_space',null,$cat_id))
            { 
                if(tfuse_options('top_ad_space',null,$cat_id)=='true'&&!tfuse_options('top_ad_image',null,$cat_id)&&!tfuse_options('top_ad_adsense',null,$cat_id))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ad_adsense',null,$cat_id)&&!tfuse_options('top_ad_image',null,$cat_id)||tfuse_options('top_ad_adsense',null,$cat_id)&&tfuse_options('top_ad_image',null,$cat_id))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ad_adsense',null,$cat_id).' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ad_image',null,$cat_id)&&!tfuse_options('top_ad_adsense',null,$cat_id))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ad_url',null,$cat_id).'"  target="_blank"><img src="'.tfuse_options('top_ad_image',null,$cat_id).'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('top_ad_space',null,$cat_id) && !tfuse_options('top_ads_space'))
            { 
                if(!tfuse_options('top_ads_space')&&!tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_adsense')&&!tfuse_options('top_ads_image')||tfuse_options('top_ads_adsense')&&tfuse_options('top_ads_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ads_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ads_url').'"  target="_blank"><img src="'.tfuse_options('top_ads_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_category())
        {
            $cat_id = get_query_var('cat');
            if(tfuse_options('top_ad_space',null,$cat_id))
            {
                if(tfuse_options('top_ad_space',null,$cat_id)=='true'&&!tfuse_options('top_ad_image',null,$cat_id)&&!tfuse_options('top_ad_adsense',null,$cat_id))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ad_adsense',null,$cat_id)&&!tfuse_options('top_ad_image',null,$cat_id)||tfuse_options('top_ad_adsense',null,$cat_id)&&tfuse_options('top_ad_image',null,$cat_id))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ad_adsense',null,$cat_id).' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ad_image',null,$cat_id)&&!tfuse_options('top_ad_adsense',null,$cat_id))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ad_url',null,$cat_id).'"  target="_blank"><img src="'.tfuse_options('top_ad_image',null,$cat_id).'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('top_ad_space',null,$cat_id) && !tfuse_options('top_ads_space'))
            {
                if(!tfuse_options('top_ads_space')&&!tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_adsense')&&!tfuse_options('top_ads_image')||tfuse_options('top_ads_adsense')&&tfuse_options('top_ads_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ads_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ads_url').'"  target="_blank"><img src="'.tfuse_options('top_ads_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
    }
endif;

//ads for category
if (!function_exists('tfuse_category_ads')) :
    function tfuse_category_ads() {
        global $post,$is_tf_blog_page;
        if($is_tf_blog_page)
        {
            if(tfuse_options('blog_bfcontent_ads_space'))
            {
                if(tfuse_options('blog_bfcontent_number') == 'one' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!tfuse_options('blog_bfcontent_ads_adsense1')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif(tfuse_options('blog_bfcontent_ads_adsense1'))
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.tfuse_options('blog_bfcontent_ads_adsense1').'</div>
                        </div>';
                    }
                    elseif($adds1)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('blog_bfcontent_number') == 'two' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    $adds2 = tfuse_options('blog_bfcontent_ads_image2');
                    $adsense1 = tfuse_options('blog_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('blog_bfcontent_ads_adsense2');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('blog_bfcontent_number') == 'three' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    $adds2 = tfuse_options('blog_bfcontent_ads_image2');
                    $adds3 = tfuse_options('blog_bfcontent_ads_image3');
                    $adsense1 = tfuse_options('blog_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('blog_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('blog_bfcontent_ads_adsense3');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('blog_bfcontent_number') == 'four' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    $adds2 = tfuse_options('blog_bfcontent_ads_image2');
                    $adds3 = tfuse_options('blog_bfcontent_ads_image3');
                    $adds4 = tfuse_options('blog_bfcontent_ads_image4');
                    $adsense1 = tfuse_options('blog_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('blog_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('blog_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('blog_bfcontent_ads_adsense4');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4')&&!tfuse_page_options('bfcontent_ads_adsense4')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('blog_bfcontent_number') == 'five' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    $adds2 = tfuse_options('blog_bfcontent_ads_image2');
                    $adds3 = tfuse_options('blog_bfcontent_ads_image3');
                    $adds4 = tfuse_options('blog_bfcontent_ads_image4');
                    $adds5 = tfuse_options('blog_bfcontent_ads_image5');
                    $adsense1 = tfuse_options('blog_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('blog_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('blog_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('blog_bfcontent_ads_adsense4');
                    $adsense5 = tfuse_options('blog_bfcontent_ads_adsense5');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('blog_bfcontent_number') == 'six' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    $adds2 = tfuse_options('blog_bfcontent_ads_image2');
                    $adds3 = tfuse_options('blog_bfcontent_ads_image3');
                    $adds4 = tfuse_options('blog_bfcontent_ads_image4');
                    $adds5 = tfuse_options('blog_bfcontent_ads_image5');
                    $adds6 = tfuse_options('blog_bfcontent_ads_image6');
                    $adsense1 = tfuse_options('blog_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('blog_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('blog_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('blog_bfcontent_ads_adsense4');
                    $adsense5 = tfuse_options('blog_bfcontent_ads_adsense5');
                    $adsense6 = tfuse_options('blog_bfcontent_ads_adsense6');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('blog_bfcontent_number') == 'seven' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    $adds2 = tfuse_options('blog_bfcontent_ads_image2');
                    $adds3 = tfuse_options('blog_bfcontent_ads_image3');
                    $adds4 = tfuse_options('blog_bfcontent_ads_image4');
                    $adds5 = tfuse_options('blog_bfcontent_ads_image5');
                    $adds6 = tfuse_options('blog_bfcontent_ads_image6');
                    $adds7 = tfuse_options('blog_bfcontent_ads_image7');
                    $adsense1 = tfuse_options('blog_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('blog_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('blog_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('blog_bfcontent_ads_adsense4');
                    $adsense5 = tfuse_options('blog_bfcontent_ads_adsense5');
                    $adsense6 = tfuse_options('blog_bfcontent_ads_adsense6');
                    $adsense7 = tfuse_options('blog_bfcontent_ads_adsense7');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        <div class="adv_125">'.$adsense7.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url7').'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
            }
            elseif(!tfuse_options('blog_bfcontent_ads_space') && !tfuse_options('bfc_ads_space'))
            {
                tfuse_bfc_ads_admin();
            }
        }
        elseif(is_front_page())
        {
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page'){
                $page_id = $post->ID;
                if(tfuse_page_options('bfcontent_ads_space','',$page_id))
                {
                    if(tfuse_page_options('bfcontent_number','',$page_id) == 'one' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!tfuse_page_options('bfcontent_ads_adsense1','',$page_id)){
                            echo  '
                                    <!-- adv before content -->
                                            <div class="adv_before_content">
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            </div>
                                    <!--/ adv before content -->';
                        }
                        elseif(tfuse_page_options('bfcontent_ads_adsense1'))
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.tfuse_page_options('bfcontent_ads_adsense1','',$page_id).'</div>
                            </div>';
                        }
                        elseif($adds1)
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                    elseif(tfuse_page_options('bfcontent_number','',$page_id) == 'two' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        $adds2 = tfuse_page_options('bfcontent_ads_image2','',$page_id);
                        $adsense1 = tfuse_page_options('bfcontent_ads_adsense1','',$page_id);
                        $adsense2 = tfuse_page_options('bfcontent_ads_adsense2','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                            echo  '
                                    <!-- adv before content -->
                                            <div class="adv_before_content">
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            </div>
                                    <!--/ adv before content -->';
                        }
                        elseif($adsense1 || $adsense2)
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.$adsense1.'</div>
                            <div class="adv_125">'.$adsense2.'</div>
                            </div>';
                        }
                        elseif($adds1 || $adds2 )
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2','',$page_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                    elseif(tfuse_page_options('bfcontent_number','',$page_id) == 'three' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        $adds2 = tfuse_page_options('bfcontent_ads_image2','',$page_id);
                        $adds3 = tfuse_page_options('bfcontent_ads_image3','',$page_id);
                        $adsense1 = tfuse_page_options('bfcontent_ads_adsense1','',$page_id);
                        $adsense2 = tfuse_page_options('bfcontent_ads_adsense2','',$page_id);
                        $adsense3 = tfuse_page_options('bfcontent_ads_adsense3','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                            echo  '
                                    <!-- adv before content -->
                                            <div class="adv_before_content">
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            </div>
                                    <!--/ adv before content -->';
                        }
                        elseif($adsense1 || $adsense2 || $adsense3 )
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.$adsense1.'</div>
                            <div class="adv_125">'.$adsense2.'</div>
                            <div class="adv_125">'.$adsense3.'</div>
                            </div>';
                        }
                        elseif($adds1 || $adds2 || $adds3 )
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2','',$page_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3','',$page_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                    elseif(tfuse_page_options('bfcontent_number','',$page_id) == 'four' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        $adds2 = tfuse_page_options('bfcontent_ads_image2','',$page_id);
                        $adds3 = tfuse_page_options('bfcontent_ads_image3','',$page_id);
                        $adds4 = tfuse_page_options('bfcontent_ads_image4','',$page_id);
                        $adsense1 = tfuse_page_options('bfcontent_ads_adsense1','',$page_id);
                        $adsense2 = tfuse_page_options('bfcontent_ads_adsense2','',$page_id);
                        $adsense3 = tfuse_page_options('bfcontent_ads_adsense3','',$page_id);
                        $adsense4 = tfuse_page_options('bfcontent_ads_adsense4','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4','',$page_id)&&!tfuse_page_options('bfcontent_ads_adsense4','',$page_id)){
                            echo  '
                                    <!-- adv before content -->
                                            <div class="adv_before_content">
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            </div>
                                    <!--/ adv before content -->';
                        }
                        elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.$adsense1.'</div>
                            <div class="adv_125">'.$adsense2.'</div>
                            <div class="adv_125">'.$adsense3.'</div>
                            <div class="adv_125">'.$adsense4.'</div>
                            </div>';
                        }
                        elseif($adds1 || $adds2 || $adds3 || $adds4)
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2','',$page_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3','',$page_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4','',$page_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                    elseif(tfuse_page_options('bfcontent_number','',$page_id) == 'five' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        $adds2 = tfuse_page_options('bfcontent_ads_image2','',$page_id);
                        $adds3 = tfuse_page_options('bfcontent_ads_image3','',$page_id);
                        $adds4 = tfuse_page_options('bfcontent_ads_image4','',$page_id);
                        $adds5 = tfuse_page_options('bfcontent_ads_image5','',$page_id);
                        $adsense1 = tfuse_page_options('bfcontent_ads_adsense1','',$page_id);
                        $adsense2 = tfuse_page_options('bfcontent_ads_adsense2','',$page_id);
                        $adsense3 = tfuse_page_options('bfcontent_ads_adsense3','',$page_id);
                        $adsense4 = tfuse_page_options('bfcontent_ads_adsense4','',$page_id);
                        $adsense5 = tfuse_page_options('bfcontent_ads_adsense5','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                            echo  '
                                    <!-- adv before content -->
                                            <div class="adv_before_content">
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            </div>
                                    <!--/ adv before content -->';
                        }
                        elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.$adsense1.'</div>
                            <div class="adv_125">'.$adsense2.'</div>
                            <div class="adv_125">'.$adsense3.'</div>
                            <div class="adv_125">'.$adsense4.'</div>
                            <div class="adv_125">'.$adsense5.'</div>
                            </div>';
                        }
                        elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2','',$page_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3','',$page_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4','',$page_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5','',$page_id).'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                    elseif(tfuse_page_options('bfcontent_number','',$page_id) == 'six' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        $adds2 = tfuse_page_options('bfcontent_ads_image2','',$page_id);
                        $adds3 = tfuse_page_options('bfcontent_ads_image3','',$page_id);
                        $adds4 = tfuse_page_options('bfcontent_ads_image4','',$page_id);
                        $adds5 = tfuse_page_options('bfcontent_ads_image5','',$page_id);
                        $adds6 = tfuse_page_options('bfcontent_ads_image6','',$page_id);
                        $adsense1 = tfuse_page_options('bfcontent_ads_adsense1','',$page_id);
                        $adsense2 = tfuse_page_options('bfcontent_ads_adsense2','',$page_id);
                        $adsense3 = tfuse_page_options('bfcontent_ads_adsense3','',$page_id);
                        $adsense4 = tfuse_page_options('bfcontent_ads_adsense4','',$page_id);
                        $adsense5 = tfuse_page_options('bfcontent_ads_adsense5','',$page_id);
                        $adsense6 = tfuse_page_options('bfcontent_ads_adsense6','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                            echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                        }
                        elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.$adsense1.'</div>
                            <div class="adv_125">'.$adsense2.'</div>
                            <div class="adv_125">'.$adsense3.'</div>
                            <div class="adv_125">'.$adsense4.'</div>
                            <div class="adv_125">'.$adsense5.'</div>
                            <div class="adv_125">'.$adsense6.'</div>
                            </div>';
                        }
                        elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2','',$page_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3','',$page_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4','',$page_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5','',$page_id).'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6','',$page_id).'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                    elseif(tfuse_page_options('bfcontent_number','',$page_id) == 'seven' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        $adds2 = tfuse_page_options('bfcontent_ads_image2','',$page_id);
                        $adds3 = tfuse_page_options('bfcontent_ads_image3','',$page_id);
                        $adds4 = tfuse_page_options('bfcontent_ads_image4','',$page_id);
                        $adds5 = tfuse_page_options('bfcontent_ads_image5','',$page_id);
                        $adds6 = tfuse_page_options('bfcontent_ads_image6','',$page_id);
                        $adds7 = tfuse_page_options('bfcontent_ads_image7','',$page_id);
                        $adsense1 = tfuse_page_options('bfcontent_ads_adsense1','',$page_id);
                        $adsense2 = tfuse_page_options('bfcontent_ads_adsense2','',$page_id);
                        $adsense3 = tfuse_page_options('bfcontent_ads_adsense3','',$page_id);
                        $adsense4 = tfuse_page_options('bfcontent_ads_adsense4','',$page_id);
                        $adsense5 = tfuse_page_options('bfcontent_ads_adsense5','',$page_id);
                        $adsense6 = tfuse_page_options('bfcontent_ads_adsense6','',$page_id);
                        $adsense7 = tfuse_page_options('bfcontent_ads_adsense7','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                            echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                        }
                        elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.$adsense1.'</div>
                            <div class="adv_125">'.$adsense2.'</div>
                            <div class="adv_125">'.$adsense3.'</div>
                            <div class="adv_125">'.$adsense4.'</div>
                            <div class="adv_125">'.$adsense5.'</div>
                            <div class="adv_125">'.$adsense6.'</div>
                            <div class="adv_125">'.$adsense7.'</div>
                            </div>';
                        }
                        elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2','',$page_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3','',$page_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4','',$page_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5','',$page_id).'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6','',$page_id).'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url7','',$page_id).'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                }
            }
            elseif(tfuse_options('home_bfcontent_ads_space'))
            {
                if(tfuse_options('home_bfcontent_number') == 'one' )
                {
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!tfuse_options('home_bfcontent_ads_adsense1')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif(tfuse_options('home_bfcontent_ads_adsense1'))
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.tfuse_options('home_bfcontent_ads_adsense1').'</div>
                        </div>';
                    }
                    elseif($adds1)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('home_bfcontent_number') == 'two' )
                {
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    $adds2 = tfuse_options('home_bfcontent_ads_image2');
                    $adsense1 = tfuse_options('home_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('home_bfcontent_ads_adsense2');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('home_bfcontent_number') == 'three' )
                {
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    $adds2 = tfuse_options('home_bfcontent_ads_image2');
                    $adds3 = tfuse_options('home_bfcontent_ads_image3');
                    $adsense1 = tfuse_options('home_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('home_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('home_bfcontent_ads_adsense3');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('home_bfcontent_number') == 'four' )
                {   
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    $adds2 = tfuse_options('home_bfcontent_ads_image2');
                    $adds3 = tfuse_options('home_bfcontent_ads_image3');
                    $adds4 = tfuse_options('home_bfcontent_ads_image4');
                    $adsense1 = tfuse_options('home_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('home_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('home_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('home_bfcontent_ads_adsense4');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4')&&!tfuse_page_options('bfcontent_ads_adsense4')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('home_bfcontent_number') == 'five' )
                {
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    $adds2 = tfuse_options('home_bfcontent_ads_image2');
                    $adds3 = tfuse_options('home_bfcontent_ads_image3');
                    $adds4 = tfuse_options('home_bfcontent_ads_image4');
                    $adds5 = tfuse_options('home_bfcontent_ads_image5');
                    $adsense1 = tfuse_options('home_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('home_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('home_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('home_bfcontent_ads_adsense4');
                    $adsense5 = tfuse_options('home_bfcontent_ads_adsense5');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('home_bfcontent_number') == 'six' )
                {
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    $adds2 = tfuse_options('home_bfcontent_ads_image2');
                    $adds3 = tfuse_options('home_bfcontent_ads_image3');
                    $adds4 = tfuse_options('home_bfcontent_ads_image4');
                    $adds5 = tfuse_options('home_bfcontent_ads_image5');
                    $adds6 = tfuse_options('home_bfcontent_ads_image6');
                    $adsense1 = tfuse_options('home_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('home_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('home_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('home_bfcontent_ads_adsense4');
                    $adsense5 = tfuse_options('home_bfcontent_ads_adsense5');
                    $adsense6 = tfuse_options('home_bfcontent_ads_adsense6');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('home_bfcontent_number') == 'seven' )
                {
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    $adds2 = tfuse_options('home_bfcontent_ads_image2');
                    $adds3 = tfuse_options('home_bfcontent_ads_image3');
                    $adds4 = tfuse_options('home_bfcontent_ads_image4');
                    $adds5 = tfuse_options('home_bfcontent_ads_image5');
                    $adds6 = tfuse_options('home_bfcontent_ads_image6');
                    $adds7 = tfuse_options('home_bfcontent_ads_image7');
                    $adsense1 = tfuse_options('home_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('home_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('home_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('home_bfcontent_ads_adsense4');
                    $adsense5 = tfuse_options('home_bfcontent_ads_adsense5');
                    $adsense6 = tfuse_options('home_bfcontent_ads_adsense6');
                    $adsense7 = tfuse_options('home_bfcontent_ads_adsense7');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        <div class="adv_125">'.$adsense7.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url7').'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
            }
            elseif(!tfuse_options('home_bfcontent_ads_space') && !tfuse_options('bfc_ads_space'))
            {
                tfuse_bfc_ads_admin();
            }
        }
        elseif(is_page())
        {
            if(tfuse_page_options('bfcontent_ads_space'))
            {
                if(tfuse_page_options('bfcontent_number') == 'one' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!tfuse_page_options('bfcontent_ads_adsense1')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif(tfuse_page_options('bfcontent_ads_adsense1'))
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.tfuse_page_options('bfcontent_ads_adsense1').'</div>
                        </div>';
                    }
                    elseif($adds1)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'two' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'three' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'four' )
                {   
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adds4 = tfuse_page_options('bfcontent_ads_image4');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4')&&!tfuse_page_options('bfcontent_ads_adsense4')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'five' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adds4 = tfuse_page_options('bfcontent_ads_image4');
                    $adds5 = tfuse_page_options('bfcontent_ads_image5');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                    $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'six' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adds4 = tfuse_page_options('bfcontent_ads_image4');
                    $adds5 = tfuse_page_options('bfcontent_ads_image5');
                    $adds6 = tfuse_page_options('bfcontent_ads_image6');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                    $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
                    $adsense6 = tfuse_page_options('bfcontent_ads_adsense6');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'seven' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adds4 = tfuse_page_options('bfcontent_ads_image4');
                    $adds5 = tfuse_page_options('bfcontent_ads_image5');
                    $adds6 = tfuse_page_options('bfcontent_ads_image6');
                    $adds7 = tfuse_page_options('bfcontent_ads_image7');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                    $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
                    $adsense6 = tfuse_page_options('bfcontent_ads_adsense6');
                    $adsense7 = tfuse_page_options('bfcontent_ads_adsense7');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        <div class="adv_125">'.$adsense7.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url7').'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
            }
            elseif(!tfuse_page_options('bfcontent_ads_space') && !tfuse_options('bfc_ads_space'))
            {
                tfuse_bfc_ads_admin();
            }
        }
        elseif(is_single() && !is_page())
        {
            $cat_name = get_the_category();
            $post = get_post($post->ID);
            $post_type = $post->post_type;
            $taxonomies = get_object_taxonomies($post_type);
            if($taxonomies[0] == 'category') { 
                $cat_id = $cat_name[0]->cat_ID;
            }

            if(!tfuse_page_options('content_ads_post'))
            { 
                tfuse_bfc_ads_post();
            }
            elseif(tfuse_page_options('content_ads_post') && tfuse_options('bfcontent_ads_space',null,$cat_id))
            {
                tfuse_bfc_ads_cat($cat_id);
            }
            elseif(!tfuse_options('bfcontent_ads_space',null,$cat_id) && !tfuse_options('bfc_ads_space'))
            { 
                tfuse_bfc_ads_admin();
            }
        }
        elseif(is_category())
        {
            $cat_id = get_query_var('cat');
            if(tfuse_options('bfcontent_ads_space',null,$cat_id))
            {
                tfuse_bfc_ads_cat($cat_id);
            }
            elseif(!tfuse_options('bfcontent_ads_space',null,$cat_id) && !tfuse_options('bfc_ads_space'))
            { 
                tfuse_bfc_ads_admin();
            }
        }
    }
endif;

//468x60 ad
if (!function_exists('tfuse_hook')) :
    function tfuse_hook() {
        $id = 0;
        global $post,$is_tf_front_page,$is_tf_blog_page;
        $ID = '';
        if($is_tf_blog_page)
        {
            if (tfuse_options('blog_hook_space')=='true')
            {
                if(tfuse_options('blog_hook_space')&&!tfuse_options('blog_hook_image')&&!tfuse_options('blog_hook_adsense')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('blog_hook_adsense')&&!tfuse_options('blog_hook_image')||tfuse_options('blog_hook_adsense')&&tfuse_options('blog_hook_image'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('blog_hook_adsense').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('blog_hook_image')&&!tfuse_options('blog_hook_adsense'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('blog_hook_url').'"  target="_blank"><img src="'.tfuse_options('blog_hook_image').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('blog_hook_space') && !tfuse_options('content_ads_space'))
            {
                if(!tfuse_options('content_ads_space')&&!tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense_admin')&&!tfuse_options('hook_image_admin')||tfuse_options('hook_adsense_admin')&&tfuse_options('hook_image_admin'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense_admin').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url_admin').'"  target="_blank"><img src="'.tfuse_options('hook_image_admin').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif($is_tf_front_page)
        {
             if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page'){
                $page_id = $post->ID;
                if(tfuse_page_options('hook_space','',$page_id)&&!tfuse_page_options('hook_image','',$page_id)&&!tfuse_page_options('hook_adsense','',$page_id)){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_page_options('hook_adsense','',$page_id)&&!tfuse_page_options('hook_image','',$page_id)||tfuse_page_options('hook_adsense','',$page_id)&&tfuse_page_options('hook_image','',$page_id))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_page_options('hook_adsense','',$page_id).'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_page_options('hook_image','',$page_id)&&!tfuse_page_options('hook_adsense','',$page_id))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_page_options('hook_url','',$page_id).'"  target="_blank"><img src="'.tfuse_page_options('hook_image','',$page_id).'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif (tfuse_options('home_hook_space')=='true')
            {
                if(tfuse_options('home_hook_space')&&!tfuse_options('home_hook_image')&&!tfuse_options('home_hook_adsense')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('home_hook_adsense')&&!tfuse_options('home_hook_image')||tfuse_options('home_hook_adsense')&&tfuse_options('home_hook_image'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('home_hook_adsense').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('home_hook_image')&&!tfuse_options('home_hook_adsense'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('home_hook_url').'"  target="_blank"><img src="'.tfuse_options('home_hook_image').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('home_hook_space') && !tfuse_options('content_ads_space'))
            {
                if(!tfuse_options('content_ads_space')&&!tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense_admin')&&!tfuse_options('hook_image_admin')||tfuse_options('hook_adsense_admin')&&tfuse_options('hook_image_admin'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense_admin').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url_admin').'"  target="_blank"><img src="'.tfuse_options('hook_image_admin').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_page())
        {
            if (tfuse_page_options('hook_space')=='true')
            {
                if(tfuse_page_options('hook_space')&&!tfuse_page_options('hook_image')&&!tfuse_page_options('hook_adsense')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_page_options('hook_adsense')&&!tfuse_page_options('hook_image')||tfuse_page_options('hook_adsense')&&tfuse_page_options('hook_image'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_page_options('hook_adsense').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_page_options('hook_image')&&!tfuse_page_options('hook_adsense'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_page_options('hook_url').'"  target="_blank"><img src="'.tfuse_page_options('hook_image').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_page_options('hook_space') && !tfuse_options('content_ads_space'))
            {
                if(!tfuse_options('content_ads_space')&&!tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense_admin')&&!tfuse_options('hook_image_admin')||tfuse_options('hook_adsense_admin')&&tfuse_options('hook_image_admin'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense_admin').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url_admin').'"  target="_blank"><img src="'.tfuse_options('hook_image_admin').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_single() && !is_page())
        {
            $cat_name = get_the_category();
            $post = get_post($post->ID);
            $cat_id = $cat_name[0]->cat_ID;
            $ID = $post->ID;
            if(!tfuse_page_options('content_ads_post'))
            {  
                if (tfuse_page_options('hook_space')=='true')
                {
                    if(tfuse_page_options('hook_space')&&!tfuse_page_options('hook_image')&&!tfuse_page_options('hook_adsense')){
                        echo '
                            <!-- adv: 468x60 center -->
                            <div class="adv_content">
                                            <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                    </div>
                            <!--/ adv: 468x60 center -->';
                    }
                    elseif(tfuse_page_options('hook_adsense')&&!tfuse_page_options('hook_image')||tfuse_page_options('hook_adsense')&&tfuse_page_options('hook_image'))
                    {
                        echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_page_options('hook_adsense').'</div></div><!--/ adv: 468x60 center -->';
                    }
                    elseif(tfuse_page_options('hook_image')&&!tfuse_page_options('hook_adsense'))
                    {
                        echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                <div class="adv_468"><a href="'.tfuse_page_options('hook_url').'"  target="_blank"><img src="'.tfuse_page_options('hook_image').'" width="460" height="60" alt="advert"></a></div>
                        </div>
                        <!--/ adv: 468x60 center -->
                        ';
                    }
                    else
                    {
                        echo '';
                    }
                }
            }
            elseif(tfuse_page_options('content_ads_post') && tfuse_options('hook_space',null,$cat_id))
            {  
                if(tfuse_options('hook_space',null,$cat_id)&&!tfuse_options('hook_image',null,$cat_id)&&!tfuse_options('hook_adsense',null,$cat_id)){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense',null,$cat_id)&&!tfuse_options('hook_image',null,$cat_id)||tfuse_options('hook_adsense',null,$cat_id)&&tfuse_options('hook_image',null,$cat_id))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense',null,$cat_id).'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image',null,$cat_id)&&!tfuse_options('hook_adsense',null,$cat_id))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url',null,$cat_id).'"  target="_blank"><img src="'.tfuse_options('hook_image',null,$cat_id).'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('hook_space',null,$cat_id) && !tfuse_options('content_ads_space'))
            {  
                if(!tfuse_options('content_ads_space')&&!tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense_admin')&&!tfuse_options('hook_image_admin')||tfuse_options('hook_adsense_admin')&&tfuse_options('hook_image_admin'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense_admin').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url_admin').'"  target="_blank"><img src="'.tfuse_options('hook_image_admin').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_category())
        {
            $id = get_query_var('cat');
            if (tfuse_options('hook_space',null,$id))
            {
                if(tfuse_options('hook_space',null,$id)&&!tfuse_options('hook_image',null,$id)&&!tfuse_options('hook_adsense',null,$id)){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense',null,$id)&&!tfuse_options('hook_image',null,$id)||tfuse_options('hook_adsense',null,$id)&&tfuse_options('hook_image',null,$id))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense',null,$id).'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image',null,$id)&&!tfuse_options('hook_adsense',null,$id))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url',null,$id).'"  target="_blank"><img src="'.tfuse_options('hook_image',null,$id).'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('hook_space',null,$id) && !tfuse_options('content_ads_space'))
            {
                if(!tfuse_options('content_ads_space')&&!tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense_admin')&&!tfuse_options('hook_image_admin')||tfuse_options('hook_adsense_admin')&&tfuse_options('hook_image_admin'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense_admin').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url_admin').'"  target="_blank"><img src="'.tfuse_options('hook_image_admin').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
    }
endif;

//before content 125x125 ads from frame
if (!function_exists('tfuse_bfc_ads_admin')) :
function tfuse_bfc_ads_admin()
{
    if(!tfuse_options('bfc_ads_space'))
    {
        if(tfuse_options('bfcontent_number') == 'one' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1');
            if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!tfuse_options('bfcontent_ads_adsense1')){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif(tfuse_options('bfcontent_ads_adsense1'))
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.tfuse_options('bfcontent_ads_adsense1').'</div>
                </div>';
            }
            elseif($adds1)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number') == 'two' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1');
            $adds2 = tfuse_options('bfcontent_ads_image2');
            $adsense1 = tfuse_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_options('bfcontent_ads_adsense2');
            if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 )
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number') == 'three' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1');
            $adds2 = tfuse_options('bfcontent_ads_image2');
            $adds3 = tfuse_options('bfcontent_ads_image3');
            $adsense1 = tfuse_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_options('bfcontent_ads_adsense3');
            if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 )
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 )
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number') == 'four' )
        {   
            $adds1 = tfuse_options('bfcontent_ads_image1');
            $adds2 = tfuse_options('bfcontent_ads_image2');
            $adds3 = tfuse_options('bfcontent_ads_image3');
            $adds4 = tfuse_options('bfcontent_ads_image4');
            $adsense1 = tfuse_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_options('bfcontent_ads_adsense3');
            $adsense4 = tfuse_options('bfcontent_ads_adsense4');
            if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4')&&!tfuse_page_options('bfcontent_ads_adsense4')){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number') == 'five' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1');
            $adds2 = tfuse_options('bfcontent_ads_image2');
            $adds3 = tfuse_options('bfcontent_ads_image3');
            $adds4 = tfuse_options('bfcontent_ads_image4');
            $adds5 = tfuse_options('bfcontent_ads_image5');
            $adsense1 = tfuse_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_options('bfcontent_ads_adsense3');
            $adsense4 = tfuse_options('bfcontent_ads_adsense4');
            $adsense5 = tfuse_options('bfcontent_ads_adsense5');
            if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number') == 'six' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1');
            $adds2 = tfuse_options('bfcontent_ads_image2');
            $adds3 = tfuse_options('bfcontent_ads_image3');
            $adds4 = tfuse_options('bfcontent_ads_image4');
            $adds5 = tfuse_options('bfcontent_ads_image5');
            $adds6 = tfuse_options('bfcontent_ads_image6');
            $adsense1 = tfuse_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_options('bfcontent_ads_adsense3');
            $adsense4 = tfuse_options('bfcontent_ads_adsense4');
            $adsense5 = tfuse_options('bfcontent_ads_adsense5');
            $adsense6 = tfuse_options('bfcontent_ads_adsense6');
            if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                echo  '
                    <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                            </div>
                    <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                <div class="adv_125">'.$adsense6.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number') == 'seven' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1');
            $adds2 = tfuse_options('bfcontent_ads_image2');
            $adds3 = tfuse_options('bfcontent_ads_image3');
            $adds4 = tfuse_options('bfcontent_ads_image4');
            $adds5 = tfuse_options('bfcontent_ads_image5');
            $adds6 = tfuse_options('bfcontent_ads_image6');
            $adds7 = tfuse_options('bfcontent_ads_image7');
            $adsense1 = tfuse_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_options('bfcontent_ads_adsense3');
            $adsense4 = tfuse_options('bfcontent_ads_adsense4');
            $adsense5 = tfuse_options('bfcontent_ads_adsense5');
            $adsense6 = tfuse_options('bfcontent_ads_adsense6');
            $adsense7 = tfuse_options('bfcontent_ads_adsense7');
            if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                echo  '
                    <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                            </div>
                    <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                <div class="adv_125">'.$adsense6.'</div>
                <div class="adv_125">'.$adsense7.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url7').'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
    }
}
endif;

//before content 125x125 ads from category
if (!function_exists('tfuse_bfc_ads_cat')) :
function tfuse_bfc_ads_cat($cat_id)
{
    if(tfuse_options('bfcontent_ads_space',null,$cat_id))
    {
        if(tfuse_options('bfcontent_number',null,$cat_id) == 'one' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
            if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!tfuse_options('bfcontent_ads_adsense1',null,$cat_id)){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif(tfuse_options('bfcontent_ads_adsense1',null,$cat_id))
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.tfuse_options('bfcontent_ads_adsense1',null,$cat_id).'</div>
                </div>';
            }
            elseif($adds1)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number',null,$cat_id) == 'two' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
            $adds2 = tfuse_options('bfcontent_ads_image2',null,$cat_id);
            $adsense1 = tfuse_options('bfcontent_ads_adsense1',null,$cat_id);
            $adsense2 = tfuse_options('bfcontent_ads_adsense2',null,$cat_id);
            if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 )
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2',null,$cat_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number',null,$cat_id) == 'three' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
            $adds2 = tfuse_options('bfcontent_ads_image2',null,$cat_id);
            $adds3 = tfuse_options('bfcontent_ads_image3',null,$cat_id);
            $adsense1 = tfuse_options('bfcontent_ads_adsense1',null,$cat_id);
            $adsense2 = tfuse_options('bfcontent_ads_adsense2',null,$cat_id);
            $adsense3 = tfuse_options('bfcontent_ads_adsense3',null,$cat_id);
            if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 )
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 )
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2',null,$cat_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3',null,$cat_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number',null,$cat_id) == 'four' )
        {   
            $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
            $adds2 = tfuse_options('bfcontent_ads_image2',null,$cat_id);
            $adds3 = tfuse_options('bfcontent_ads_image3',null,$cat_id);
            $adds4 = tfuse_options('bfcontent_ads_image4',null,$cat_id);
            $adsense1 = tfuse_options('bfcontent_ads_adsense1',null,$cat_id);
            $adsense2 = tfuse_options('bfcontent_ads_adsense2',null,$cat_id);
            $adsense3 = tfuse_options('bfcontent_ads_adsense3',null,$cat_id);
            $adsense4 = tfuse_options('bfcontent_ads_adsense4',null,$cat_id);
            if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4')&&!tfuse_page_options('bfcontent_ads_adsense4')){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2',null,$cat_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3',null,$cat_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4',null,$cat_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number',null,$cat_id) == 'five' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
            $adds2 = tfuse_options('bfcontent_ads_image2',null,$cat_id);
            $adds3 = tfuse_options('bfcontent_ads_image3',null,$cat_id);
            $adds4 = tfuse_options('bfcontent_ads_image4',null,$cat_id);
            $adds5 = tfuse_options('bfcontent_ads_image5',null,$cat_id);
            $adsense1 = tfuse_options('bfcontent_ads_adsense1',null,$cat_id);
            $adsense2 = tfuse_options('bfcontent_ads_adsense2',null,$cat_id);
            $adsense3 = tfuse_options('bfcontent_ads_adsense3',null,$cat_id);
            $adsense4 = tfuse_options('bfcontent_ads_adsense4',null,$cat_id);
            $adsense5 = tfuse_options('bfcontent_ads_adsense5',null,$cat_id);
            if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2',null,$cat_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3',null,$cat_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4',null,$cat_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url5',null,$cat_id).'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number',null,$cat_id) == 'six' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
            $adds2 = tfuse_options('bfcontent_ads_image2',null,$cat_id);
            $adds3 = tfuse_options('bfcontent_ads_image3',null,$cat_id);
            $adds4 = tfuse_options('bfcontent_ads_image4',null,$cat_id);
            $adds5 = tfuse_options('bfcontent_ads_image5',null,$cat_id);
            $adds6 = tfuse_options('bfcontent_ads_image6',null,$cat_id);
            $adsense1 = tfuse_options('bfcontent_ads_adsense1',null,$cat_id);
            $adsense2 = tfuse_options('bfcontent_ads_adsense2',null,$cat_id);
            $adsense3 = tfuse_options('bfcontent_ads_adsense3',null,$cat_id);
            $adsense4 = tfuse_options('bfcontent_ads_adsense4',null,$cat_id);
            $adsense5 = tfuse_options('bfcontent_ads_adsense5',null,$cat_id);
            $adsense6 = tfuse_options('bfcontent_ads_adsense6',null,$cat_id);
            if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                echo  '
                    <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                            </div>
                    <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                <div class="adv_125">'.$adsense6.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2',null,$cat_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3',null,$cat_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4',null,$cat_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url5',null,$cat_id).'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url6',null,$cat_id).'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_options('bfcontent_number',null,$cat_id) == 'seven' )
        {
            $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
            $adds2 = tfuse_options('bfcontent_ads_image2',null,$cat_id);
            $adds3 = tfuse_options('bfcontent_ads_image3',null,$cat_id);
            $adds4 = tfuse_options('bfcontent_ads_image4',null,$cat_id);
            $adds5 = tfuse_options('bfcontent_ads_image5',null,$cat_id);
            $adds6 = tfuse_options('bfcontent_ads_image6',null,$cat_id);
            $adds7 = tfuse_options('bfcontent_ads_image7',null,$cat_id);
            $adsense1 = tfuse_options('bfcontent_ads_adsense1',null,$cat_id);
            $adsense2 = tfuse_options('bfcontent_ads_adsense2',null,$cat_id);
            $adsense3 = tfuse_options('bfcontent_ads_adsense3',null,$cat_id);
            $adsense4 = tfuse_options('bfcontent_ads_adsense4',null,$cat_id);
            $adsense5 = tfuse_options('bfcontent_ads_adsense5',null,$cat_id);
            $adsense6 = tfuse_options('bfcontent_ads_adsense6',null,$cat_id);
            $adsense7 = tfuse_options('bfcontent_ads_adsense7',null,$cat_id);
            if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                echo  '
                    <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                            </div>
                    <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                <div class="adv_125">'.$adsense6.'</div>
                <div class="adv_125">'.$adsense7.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2',null,$cat_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3',null,$cat_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4',null,$cat_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url5',null,$cat_id).'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url6',null,$cat_id).'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url7',null,$cat_id).'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
    }
}
endif;

//before content 125x125 ads in post
if (!function_exists('tfuse_bfc_ads_post')) :
function tfuse_bfc_ads_post()
{
    if(tfuse_page_options('bfcontent_ads_space'))
    {
        if(tfuse_page_options('bfcontent_number') == 'one' )
        {
            $adds1 = tfuse_page_options('bfcontent_ads_image1');
            if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!tfuse_page_options('bfcontent_ads_adsense1')){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif(tfuse_page_options('bfcontent_ads_adsense1'))
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.tfuse_page_options('bfcontent_ads_adsense1').'</div>
                </div>';
            }
            elseif($adds1)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_page_options('bfcontent_number') == 'two' )
        {
            $adds1 = tfuse_page_options('bfcontent_ads_image1');
            $adds2 = tfuse_page_options('bfcontent_ads_image2');
            $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
            if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 )
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_page_options('bfcontent_number') == 'three' )
        {
            $adds1 = tfuse_page_options('bfcontent_ads_image1');
            $adds2 = tfuse_page_options('bfcontent_ads_image2');
            $adds3 = tfuse_page_options('bfcontent_ads_image3');
            $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
            if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 )
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 )
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_page_options('bfcontent_number') == 'four' )
        {   
            $adds1 = tfuse_page_options('bfcontent_ads_image1');
            $adds2 = tfuse_page_options('bfcontent_ads_image2');
            $adds3 = tfuse_page_options('bfcontent_ads_image3');
            $adds4 = tfuse_page_options('bfcontent_ads_image4');
            $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
            $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
            if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4')&&!tfuse_page_options('bfcontent_ads_adsense4')){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_page_options('bfcontent_number') == 'five' )
        {
            $adds1 = tfuse_page_options('bfcontent_ads_image1');
            $adds2 = tfuse_page_options('bfcontent_ads_image2');
            $adds3 = tfuse_page_options('bfcontent_ads_image3');
            $adds4 = tfuse_page_options('bfcontent_ads_image4');
            $adds5 = tfuse_page_options('bfcontent_ads_image5');
            $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
            $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
            $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
            if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_page_options('bfcontent_number') == 'six' )
        {
            $adds1 = tfuse_page_options('bfcontent_ads_image1');
            $adds2 = tfuse_page_options('bfcontent_ads_image2');
            $adds3 = tfuse_page_options('bfcontent_ads_image3');
            $adds4 = tfuse_page_options('bfcontent_ads_image4');
            $adds5 = tfuse_page_options('bfcontent_ads_image5');
            $adds6 = tfuse_page_options('bfcontent_ads_image6');
            $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
            $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
            $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
            $adsense6 = tfuse_page_options('bfcontent_ads_adsense6');
            if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                echo  '
                    <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                            </div>
                    <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                <div class="adv_125">'.$adsense6.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
        elseif(tfuse_page_options('bfcontent_number') == 'seven' )
        {
            $adds1 = tfuse_page_options('bfcontent_ads_image1');
            $adds2 = tfuse_page_options('bfcontent_ads_image2');
            $adds3 = tfuse_page_options('bfcontent_ads_image3');
            $adds4 = tfuse_page_options('bfcontent_ads_image4');
            $adds5 = tfuse_page_options('bfcontent_ads_image5');
            $adds6 = tfuse_page_options('bfcontent_ads_image6');
            $adds7 = tfuse_page_options('bfcontent_ads_image7');
            $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
            $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
            $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
            $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
            $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
            $adsense6 = tfuse_page_options('bfcontent_ads_adsense6');
            $adsense7 = tfuse_page_options('bfcontent_ads_adsense7');
            if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                echo  '
                    <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                            </div>
                    <!--/ adv before content -->';
            }
            elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
            {
                echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                <div class="adv_125">'.$adsense6.'</div>
                <div class="adv_125">'.$adsense7.'</div>
                </div>';
            }
            elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
            {
                echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url7').'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
            }
            else
            {
                echo '';
            }
        }
    }
}
endif;

//display navibar
if (!function_exists('tfuse_show_navibar')) :
    function tfuse_show_navibar() {
    global $is_tf_blog_page;
        if(!is_single() && !is_page() && tfuse_options('homepage_category') != 'page')
            get_template_part('header','navibar');
        if(is_page() || $is_tf_blog_page)
            get_template_part('header','navibar');
    }
endif;

if ( !function_exists('tfuse_img_content')):

    function tfuse_img_content(){ 
        $content = $link = '';
		$args = array(
			'numberposts'     => -1,
		); 
        $posts_array = get_posts( $args );
        $option_name = 'thumbnail_image';
		foreach($posts_array as $post):
			$featured = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID));  
			if(tfuse_page_options('thumbnail_image',false,$post->ID)) continue;
			
			if(!empty($featured))
			{
				$value = $featured[0];
				tfuse_set_page_option($option_name, $value, $post->ID);
				tfuse_set_page_option('disable_image', true , $post->ID); 
			}
			else
			{
				$args = array(
				 'post_type' => 'attachment',
				 'numberposts' => -1,
				 'post_parent' => $post->ID
				); 
				$attachments = get_posts($args);
				if ($attachments) {
				 foreach ($attachments as $attachment) { 
								$value = $attachment->guid; 
								tfuse_set_page_option($option_name, $value, $post->ID);
								tfuse_set_page_option('disable_image', true , $post->ID); 
							 }
				}
				else
				{
					$content = $post->post_content;
						if(!empty($content))
						{   
							preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $content,$matches);
							if(!empty($matches))
							{
								$link = $matches[1]; 
								tfuse_set_page_option($option_name, $link , $post->ID);
								tfuse_set_page_option('disable_image', true , $post->ID);
							}
						}
				}
			}
                        
		endforeach;
			tfuse_set_option('enable_content_img',false, $cat_id = NULL);
    }
endif;

if ( tfuse_options('enable_content_img'))
{ 
    add_action('tfuse_head','tfuse_img_content');
}
//for image in rss
if(!function_exists('tfuse_feedFilter')) :

    function tfuse_feedFilter($query) {
        if ($query->is_feed) {
            add_filter('the_content', 'tfuse_feedContentFilter');
        }
        return $query;
    }
    add_filter('pre_get_posts','tfuse_feedFilter');

    function tfuse_feedContentFilter($content) {
        $thumb = tfuse_page_options('single_image');
        $image = '';
        if($thumb) {
            $image = '<a href="'.get_permalink().'"><img align="left" src="'. $thumb .'" width="200px" height="150px" /></a>';
            echo $image;
        }
        $content = $image . $content;
        return $content;
    }

endif;

if( !function_exists('tfuse_set_blog_page') ):
    function tfuse_set_blog_page(){
        global $wp_query, $is_tf_blog_page;
        $id_post = 0;
        $blog_page_id = tfuse_options('blog_page','');
        if(isset($wp_query->queried_object) && isset($wp_query->queried_object->ID)) {
            $id_post = $wp_query->queried_object->ID;
        }
        elseif(isset($wp_query->query['page_id'])) {
            $id_post = $wp_query->query['page_id'];
        }

        if(function_exists('icl_object_id')){
            $id_post = icl_object_id($id_post, 'page', false, 'en');
        }

        if($blog_page_id != 0 && $id_post == $blog_page_id) {
            $is_tf_blog_page = true;
        }
    }
    add_action('wp_head','tfuse_set_blog_page');
endif;

if(!function_exists('tfuse_update_reservation_forms'))
{
	function tfuse_update_reservation_forms()
	{
		$forms = get_terms( 'reservations', array(
			'orderby'    => 'count',
			'hide_empty' => 0
		) );

		$args = array(
			'0' =>  'text',
			'1' =>  'textarea',
			'2' =>  'radio',
			'3' =>  'checkbox',
			'4' =>  'select',
			'5' =>  'email',
			'6' =>  'captcha',
			'7' =>  'date_in',
			'8' =>  'date_out',
			'9' =>  'res_email',
		);

		foreach($forms as $form)
		{
			$check_option = get_option( 'tfuse_update_reservation_forms', 'none' );
			if($check_option == 'set')
			{
				return;
			}
			$description = unserialize($form->description);
			if(isset($description['version']) AND $description['version'] == '1.1')
				continue;

			foreach($description['input'] as $key => $input)
			{
				if(isset($args[$input['type']]))
					$input['type'] = $args[$input['type']];
				$description['input'][$key]['type'] = $input['type'];
			}
			$description['version'] = '1.1';
			wp_update_term($form->term_id, 'reservations', array('description' => serialize($description)));
			add_option('tfuse_update_reservation_forms', 'set');
		}
	}
	add_action('wp_head', 'tfuse_update_reservation_forms');
}