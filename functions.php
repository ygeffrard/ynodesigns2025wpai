<?php
// Theme setup
function yno_designs_theme_setup() {
    // Add support for dynamic <title> tag
    add_theme_support('title-tag');

    // Add support for post thumbnails
    add_theme_support('post-thumbnails');

    // Register primary menu
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'yno-designs'),
    ));
}
add_action('after_setup_theme', 'yno_designs_theme_setup');

// Enqueue styles and scripts
function yno_enqueue_assets() {
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '5.3.0');
    wp_enqueue_style('aos-css', get_template_directory_uri() . '/css/aos.css', array(), '2.3.4');
    wp_enqueue_style('theme-style', get_stylesheet_uri(), array('bootstrap-css', 'aos-css'));

    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'), '5.3.0', true);
    wp_enqueue_script('aos-js', get_template_directory_uri() . '/js/aos.js', array(), '2.3.4', true);
    wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/js/custom.js', array('jquery', 'aos-js'), null, true);
}
add_action('wp_enqueue_scripts', 'yno_enqueue_assets');

// Disable Emoji scripts
function yno_disable_emoji_scripts() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('init', 'yno_disable_emoji_scripts');

// Move jQuery to the footer
function move_jquery_to_footer() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', includes_url('/js/jquery/jquery.min.js'), false, null, true);
        wp_enqueue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'move_jquery_to_footer');

// Add Custom Post Type for Case Studies
// Register Custom Post Type for Case Studies
function yno_register_case_studies_cpt() {
    $args = array(
        'labels'             => array(
            'name'          => __('Case Studies', 'yno-designs'),
            'singular_name' => __('Case Study', 'yno-designs'),
            'add_new'       => __('Add New Case Study', 'yno-designs'),
            'edit_item'     => __('Edit Case Study', 'yno-designs'),
            'all_items'     => __('All Case Studies', 'yno-designs'),
        ),
        'public'             => true,
        'has_archive'        => true,
        'show_in_rest'       => false, // Enables Gutenberg editor
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
        'rewrite'            => array('slug' => 'case-studies'),
    );

    register_post_type('case_study', $args);
}
add_action('init', 'yno_register_case_studies_cpt');

// Add Custom Post Type for Clients
function yno_register_clients_cpt() {
    $args = array(
        'labels'             => array(
            'name'          => __('Clients', 'yno-designs'),
            'singular_name' => __('Client', 'yno-designs'),
        ),
        'public'             => true,
        'has_archive'        => false,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-businessman',
        'supports'           => array('title', 'thumbnail'),
        'rewrite'            => array('slug' => 'clients'),
    );

    register_post_type('client', $args);
}
add_action('init', 'yno_register_clients_cpt');

// Add Custom Post Type for Reviews
function yno_register_reviews_cpt() {
    $args = array(
        'labels'             => array(
            'name'          => __('Reviews', 'yno-designs'),
            'singular_name' => __('Review', 'yno-designs'),
        ),
        'public'             => true,
        'has_archive'        => false,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-star-filled',
        'supports'           => array('title', 'editor', 'thumbnail'),
        'rewrite'            => array('slug' => 'reviews'),
    );

    register_post_type('review', $args);
}
add_action('init', 'yno_register_reviews_cpt');

// Add meta box for homepage sections
function yno_add_homepage_meta_box() {
    add_meta_box(
        'homepage_sections',
        'Homepage Sections',
        'yno_homepage_meta_box_cb',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'yno_add_homepage_meta_box');

// Callback function for meta box
function yno_homepage_meta_box_cb($post) {
    // Available sections
    $sections = ['hero', 'checklist', 'case-studies', 'team', 'contact', 'clients', 'reviews'];

    // Get saved settings
    $saved_order = get_post_meta($post->ID, '_homepage_sections_order', true);
    $saved_visibility = get_post_meta($post->ID, '_homepage_sections_visibility', true);

    // Default values
    $saved_order = $saved_order ?: $sections;
    $saved_visibility = $saved_visibility ?: array_fill_keys($sections, true);

    echo '<p>Drag and drop sections to reorder them. Use the checkboxes to toggle visibility.</p>';
    echo '<ul id="section-sortable" style="list-style: none; padding: 0;">';

    foreach ($saved_order as $section) {
        $visible = !empty($saved_visibility[$section]);
        echo '<li style="margin-bottom: 10px; padding: 5px; background: #f8f9fa; border: 1px solid #ddd; cursor: move;">';
        echo '<input type="checkbox" name="homepage_sections_visibility[' . $section . ']" value="1" ' . checked($visible, true, false) . '> ';
        echo ucfirst(str_replace('-', ' ', $section));
        echo '<input type="hidden" name="homepage_sections_order[]" value="' . $section . '">';
        echo '</li>';
    }

    echo '</ul>';

    // Add inline JavaScript for drag-and-drop functionality
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            jQuery('#section-sortable').sortable();
        });
    </script>
    <?php
}

// Save meta box data
function yno_save_homepage_meta_data($post_id) {
    if (isset($_POST['homepage_sections_order'])) {
        update_post_meta($post_id, '_homepage_sections_order', $_POST['homepage_sections_order']);
    }
    if (isset($_POST['homepage_sections_visibility'])) {
        update_post_meta($post_id, '_homepage_sections_visibility', $_POST['homepage_sections_visibility']);
    }
}
add_action('save_post', 'yno_save_homepage_meta_data');
?>
