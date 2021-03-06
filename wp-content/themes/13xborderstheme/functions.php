<?php
require_once(TEMPLATEPATH . '/admin/admin-functions.php');
require_once(TEMPLATEPATH . '/admin/admin-interface.php');
require_once(TEMPLATEPATH . '/admin/theme-settings.php');
// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

if (!isset($content_width)) {
    $content_width = 900;
}

if (function_exists('add_theme_support')) {
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /* add_theme_support('custom-background', array(
      'default-color' => 'FFF',
      'default-image' => get_template_directory_uri() . '/img/bg.jpg'
      )); */

    // Add Support for Custom Header - Uncomment below if you're going to use
    /* add_theme_support('custom-header', array(
      'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
      'header-text'			=> false,
      'default-text-color'		=> '000',
      'width'				=> 1000,
      'height'			=> 198,
      'random-default'		=> false,
      'wp-head-callback'		=> $wphead_cb,
      'admin-head-callback'		=> $adminhead_cb,
      'admin-preview-callback'	=> $adminpreview_cb
      )); */

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/* ------------------------------------*\
  Functions
  \*------------------------------------ */

// HTML5 Blank navigation
function html5blank_nav() {
    wp_nav_menu(
            array(
                'theme_location' => 'header-menu',
                'menu' => '',
                'container' => 'div',
                'container_class' => 'menu-{menu slug}-container',
                'container_id' => '',
                'menu_class' => 'menu',
                'menu_id' => '',
                'echo' => true,
                'fallback_cb' => 'wp_page_menu',
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'items_wrap' => '<ul id="main-nav" class="nav navbar-nav navbar-define">%3$s</ul>',
                'depth' => 0,
                'walker' => new wp_bootstrap_navwalker()
            )
    );
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts() {
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.1');
        wp_enqueue_script('bootstrap'); // Enqueue it!

        wp_register_script('menuHighlight', get_template_directory_uri() . '/js/jquery.menuHighlight.js', array('jquery'), '');
        wp_enqueue_script('menuHighlight'); // Enqueue it!

        wp_register_script('scrollTo', get_template_directory_uri() . '/js/jquery.scrollTo.min.js', array('jquery'), '1.4.9'); // Custom scripts
        wp_enqueue_script('scrollTo'); // Enqueue it!

        wp_register_script('localscroll', get_template_directory_uri() . '/js/jquery.localScroll.min.js', array('jquery', 'scrollTo'), '1.3.5'); // Custom scripts
        wp_enqueue_script('localscroll'); // Enqueue it!

        wp_register_script('script_main', get_template_directory_uri() . '/js/scripts.js', array('jquery'), ''); // Custom scripts
        wp_enqueue_script('script_main'); // Enqueue it!
    }
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts() {
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!

        wp_register_script('boostrapscript', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('boostrapscript'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function html5blank_styles() {

    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.1', 'all');
    wp_enqueue_style('bootstrap'); // Enqueue it!

    wp_register_style('bootstraprps', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), '3.3.1', 'all');
    wp_enqueue_style('bootstraprps'); // Enqueue it!

    wp_register_style('main-style', get_template_directory_uri() . '/style.css', array(), '', 'all');
    wp_enqueue_style('main-style'); // Enqueue it!
}

// Register HTML5 Blank Navigation
function register_html5_menu() {
    register_nav_menus(array(// Using array to specify more menus if needed
        'header-menu' => __('Header Menu', '13xborders_theme'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'html5blank'),
        'footer-menu' => __('Footer Menu', 'html5blank'),
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '') {
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var) {
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist) {
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes) {
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar')) {
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination() {
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) { // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length) {
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '') {
    global $post;
    if (function_exists($length_callback)) {
        //add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

function custom_excerpt_length( $length ) {
    return 50;
} 
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Custom View Article link to Post
function html5_blank_view_article($more) {
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar() {
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag) {
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions($html) {
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar($avatar_defaults) {
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments() {
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND ( get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('div' == $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
        <?php endif; ?>
        <div class="comment-author vcard">
            <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['180']); ?>
            <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
        </div>
        <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
            <br />
        <?php endif; ?>

        <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>">
                <?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'), '  ', '');
                ?>
        </div>

        <?php comment_text() ?>

        <div class="reply">
            <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
        <?php if ('div' != $args['style']) : ?>
        </div>
    <?php endif; ?>
    <?php
}

/* ------------------------------------*\
  Actions + Filters + ShortCodes
  \*------------------------------------ */

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
//add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination
// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether
// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.
add_action('init', 'cus_post_faq');

/* ------------------------------------*\
  Custom Post Types
  \*------------------------------------ */

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_html5() {
    register_taxonomy_for_object_type('category', 'html5-blank'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'html5-blank');
    register_post_type('html5-blank', // Register Custom Post Type
            array(
        'labels' => array(
            'name' => __('HTML5 Blank Custom Post', 'html5blank'), // Rename these to suit
            'singular_name' => __('HTML5 Blank Custom Post', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Add New HTML5 Blank Custom Post', 'html5blank'),
            'edit' => __('Edit', 'html5blank'),
            'edit_item' => __('Edit HTML5 Blank Custom Post', 'html5blank'),
            'new_item' => __('New HTML5 Blank Custom Post', 'html5blank'),
            'view' => __('View HTML5 Blank Custom Post', 'html5blank'),
            'view_item' => __('View HTML5 Blank Custom Post', 'html5blank'),
            'search_items' => __('Search HTML5 Blank Custom Post', 'html5blank'),
            'not_found' => __('No HTML5 Blank Custom Posts found', 'html5blank'),
            'not_found_in_trash' => __('No HTML5 Blank Custom Posts found in Trash', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}

/* ------------------------------------*\
  ShortCode Functions
  \*------------------------------------ */

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null) {
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) { // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
    return '<h2>' . $content . '</h2>';
}

/* ----------------------------------------------------------------------------------- */

/* 	Postype custom taxonomies.

  /*----------------------------------------------------------------------------------- */

add_action('init', 'xborders_posttype_init');

if (!function_exists('xborders_posttype_init')) :

    function xborders_posttype_init() {



        $xborders_labels = array(
            'name' => _x('OnePage Section', 'post type general name', 'inesta'),
            'singular_name' => _x('OnePage', 'post type singular name', 'inesta'),
            'add_new' => _x('Add New Section', 'Section', 'inesta'),
            'add_new_item' => __('Add New Section', 'inesta'),
            'edit_item' => __('Edit Section', 'inesta'),
            'new_item' => __('New Section', 'inesta'),
            'all_items' => __('All Sections', 'inesta'),
            'view_item' => __('View Section', 'inesta'),
            'search_items' => __('Search Section', 'inesta'),
            'not_found' => __('No Section found', 'inesta'),
            'not_found_in_trash' => __('No Sections found in Trash', 'inesta'),
            'parent_item_colon' => '',
            'menu_name' => __('OnePage Section', 'inesta')
        );

        $xborders_args = array(
            'labels' => $xborders_labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => false,
            'rewrite' => false,
            'capability_type' => 'page',
            'has_archive' => false,
            'hierarchical' => false,
            'exclude_from_search' => true,
            'menu_position' => 16,
            'menu_icon' => get_template_directory_uri() . '/img/one_page.png',
            'supports' => array('title', 'editor', 'revisions', 'page-attributes')
        );

        register_post_type('onepage', $xborders_args);
    }

endif;

add_shortcode('news', 'blog_news');

function blog_news() {
    ob_start();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-pull-2 col-md-push-2 text-center">
                <?php
                echo '<table class="table-responsive table table" id="blog-news">';
                $allpost = get_posts(array('posts_per_page' => 5,
                    'offset' => 0,
                    'orderby' => 'post_date',
                    'order' => 'DESC',
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'suppress_filters' => true));
                foreach ($allpost as $post):
                    setup_postdata($post);
$check_content = $post->post_content != "" ? true: false;
                    ?>
                    <tr>
                        <td>
<?php if($check_content=="true") {?>
<a href="<?php echo get_post_permalink($post->ID); ?>"><?php $timepublish =get_post_meta ( $post->ID, "rw_date", true ); echo ($timepublish == "")?get_the_date('Y/mm/dd'):$timepublish; ?></a>
<?php } else{?>
<?php $timepublish =get_post_meta ( $post->ID, "rw_date", true ); echo ($timepublish == "")?get_the_date('Y/mm/dd'):$timepublish; ?>
<?php }?>
</td>
                        <td class="text-left">
<?php if($check_content=="true") {?>
<a href="<?php echo get_post_permalink($post->ID); ?>"> <?php echo $post->post_title; ?></a>
<?php } else {echo $post->post_title;}?>
</td>
                    </tr>
                    <?php
                endforeach;
                echo '</table>';
                ?>
<a href="<?php echo get_category_link(3) ?>" class="text-center" style="text-decoration: underline; color: #072D71"><span class="text-size-14">もっと見る</span></a>
<div class="spacer-xs"></div>
            </div>
        </div>
    </div>
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode('contact', 'blog_contact');

function blog_contact() {
    $contact_desc = get_option('13xborders_contact_info');
    $contact_email = get_option('13xborders_contact_email');
    ob_start();
    ?>
        <div class="row">
            <div class="col-md-12">
                <div id="contact-desc" class="text-center"><?php echo $contact_desc ?></div>
                <?php if ($contact_email != ""): ?>
                    <div id="c-email-icon" class="text-center">
                    </div>
                    <div id="c-email" class="text-center"><a href="mailto:<?php echo $contact_email ?>"><?php echo $contact_email ?></a></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_action('pre_get_posts', 'custom_jetpack_post_type_reorder');

function custom_jetpack_post_type_reorder($query) {
    if (is_admin())
        return;
    if ('jetpack-portfolio' == $query->get('post_type')) {
        $query->set('orderby', 'menu_order, title');
        $query->set('order', 'ASC');
    }
}

//Post related
function xborders_post_related() {
    $orig_post = $post;
    global $post;
    $categories = get_the_category($post->ID);
    if ($categories) {
        $category_ids = array();
        foreach ($categories as $individual_category)
            $category_ids[] = $individual_category->term_id;
        $args = array(
            'category__in' => $category_ids,
            'post__not_in' => array($post->ID),
            'posts_per_page' => 5,
            'caller_get_posts' => 1,
            'orderby' => 'rand'
        );
        $my_query = new wp_query($args);
        if ($my_query->have_posts()) {
            echo '<div id="xborders_related">';
            echo '<span>Similar Post</span>';
            echo '<div id="thumbnail_posts" class="clearfix">';
            echo '<div class="container">';
            while ($my_query->have_posts()) {
                $my_query->the_post();
                ?>
                <div class="row">
                    <div class="col-md-2 col-sm-6 col-xs-12 text-left">
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
                            <span class="h-thumnail">                    
                                <?php the_post_thumbnail(array(60, 60), array('class' => 'img-responsive')); ?>
                            </span>
                        </a>
                    </div>
                    <div class="col-md-10 cok-sm-6 col-xs-12 blog-title text-left">
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
                            <span class="h-title">
                                <?php the_title(); ?>
                            </span>
                        </a>
                    </div>
                </div>
                <?php
            }
            echo '</div></div>';
        }
    }
    $post = $orig_post;
    wp_reset_query();
}

add_filter('wp_nav_menu_objects', 'single_page_nav_links');

function single_page_nav_links($items) {
    foreach ($items as $item) {
        if ('onepage' == $item->object) {
            $current_post = get_post($item->object_id);
            $menu_title = "#" . sanitize_title($current_post->post_title);
            $item->url = home_url('/') . $menu_title;
        } elseif ('custom' == $item->type) {
            if (1 === preg_match('/^#([^\/]+)$/', $item->url, $matches)) {
                $item->url = home_url('/') . $item->url;
            }
        }
    } return $items;
}

function top_nav() {
    wp_nav_menu(
            array(
                'theme_location' => 'top-menu',
                'menu' => '',
                'container' => 'div',
                'container_class' => 'menu-{menu slug}-container',
                'container_id' => '',
                'menu_class' => 'menu',
                'menu_id' => '',
                'echo' => true,
                'fallback_cb' => 'wp_page_menu',
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'items_wrap' => '<ul id="s-menu-list" class="nav navbar-nav navbar-right">%3$s</ul>',
                'depth' => 0,
                'walker' => ''
            )
    );
}

function footer_nav() {
    wp_nav_menu(
            array(
                'theme_location' => 'footer-menu',
                'menu' => '',
                'container' => 'div',
                'container_class' => 'menu-{menu slug}-container',
                'container_id' => '',
                'menu_class' => 'menu',
                'menu_id' => '',
                'echo' => true,
                'fallback_cb' => 'wp_page_menu',
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'items_wrap' => '<ul id="f-menu" class="nav navbar-nav navbar-center">%3$s</ul>',
                'depth' => 0,
                'walker' => ''
            )
    );
}

add_filter('nav_menu_link_attributes', function($atts, $item, $args) {
//    var_dump($item->ID);
    if ($args->has_children) {
    }
    // The ID of the target menu item
    $menu_target = 95;
    $menu_target2 = 205;
    $menu_target3 = 204;
    $menu_target4 = 226;
    $menu_target5 = 64;	

    // inspect $item
    if ($item->ID == $menu_target) {
        $atts['data-toggle'] = 'modal';
        $atts['data-target'] = '.show-form1';
    }
    if ($item->ID == $menu_target2) {
        $atts['data-toggle'] = 'modal';
        $atts['data-target'] = '.show-form2';
    }
    if ($item->ID == $menu_target3) {
        $atts['data-toggle'] = 'modal';
        $atts['data-target'] = '.show-form5';
    }
    if ($item->ID == $menu_target4) {
        $atts['data-toggle'] = 'modal';
        $atts['data-target'] = '.show-form4';
    }

    return $atts;

    return $atts;
}, 10, 3);

add_filter('wpcf7_form_class_attr', 'custom_form_class_attr');

function custom_form_class_attr($class) {
    $class .= ' form-horizontal';
    return $class;
}

function cus_post_faq() {
    register_post_type('faq', // Register Custom Post Type
            array(
        'labels' => array(
            'name' => __('FAQ', 'theme_gmo'), // Rename these to suit
            'singular_name' => __('Custom Post', 'theme_gmo'),
            'add_new' => __('Add New', 'theme_gmo'),
            'add_new_item' => __('Add New FAQ', 'theme_gmo'),
            'edit' => __('Edit', 'theme_gmo'),
            'edit_item' => __('Edit FAQ', 'theme_gmo'),
            'new_item' => __('New Post', 'theme_gmo'),
            'view' => __('View FAQ Post', 'theme_gmo'),
            'view_item' => __('View FAQ Post', 'theme_gmo'),
            'search_items' => __('Search FAQ Post', 'theme_gmo'),
            'not_found' => __('No found', 'html5blank'),
            'not_found_in_trash' => __('No found in Trash', 'theme_gmo')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => false,
            'rewrite' => false,
            'capability_type' => 'page',
            'exclude_from_search' => true,
        'supports' => array('title', 'editor', 'revisions', 'page-attributes'),
        'can_export' => true, // Allows export in Tools > Export        
    ));
}

add_shortcode('faq', 'func_faq');

function func_faq($args) {
    ob_start();
    ?>
        <?php
        $display = (!empty($args['d'])) ? $args['d'] : 5;
        echo '<table class="table-responsive table table text-left" id="blog-news">';
        $allpost = get_posts(array('posts_per_page' => $display,
            'offset' => 0,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_type' => 'faq',
            'post_status' => 'publish',
            'suppress_filters' => true));
        foreach ($allpost as $post):
            setup_postdata($post);
            ?>
            <tr>                
                <td><strong>Q:</strong> <a href="<?php echo get_post_permalink($post->ID); ?>"> <?php echo $post->post_title; ?></a></td>
            </tr>
            <?php
        endforeach;
        echo '</table>';
        ?>    
    
    <a href="<?php echo get_post_type_archive_link('faq') ?>" class="text-center" style="text-decoration: underline; color: #072D71"><span class="text-size-14">もっと見る</span></a>
<div class="spacer-xs"></div>
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_filter( 'rwmb_meta_boxes', 'Projectchangan_register_meta_boxes' );

function Projectchangan_register_meta_boxes( $meta_boxes )
{
    $prefix = 'rw_';

    $meta_boxes[] = array(
        'title'    => 'Publish',
        'pages'    => array( 'post' ),
        'fields' => array(
            array(
                'name' => 'Date time',
                'id'   => $prefix . 'date',
                'type' => 'text',
            ),
        )
    );

    return $meta_boxes;
}

function download_manage_post_type() {
 
        $label = array(
        'name' => 'Download',
        'singular_name' => 'Download',
'all_items' => __('All'),
    );
 
$args = array(
        'labels' => $label,
        'description' => 'Post type download manager',
        'supports' => array(
            'title',
		'thumbnail',
		'custom-fields'
        ),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5, 
            'menu_icon' => get_template_directory_uri() . '/img/icons/download.png',
        'can_export' => true,
        'has_archive' => true, 
        'exclude_from_search' => false,
        'publicly_queryable' => true,
    );
        register_post_type( 'download' , $args );
 
}
 
add_action( 'init', 'download_manage_post_type' );