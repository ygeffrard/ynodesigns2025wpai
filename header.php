<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="site-header fixed-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg" data-bs-theme="dark">
                <div class="container-fluid px-0">
                    <!-- Logo -->
                    <a href="/" class="logo navbar-brand light-outline-color ms-3">
                        <img class="mx-auto d-block" src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="YNO Designs">
                    </a>
                    <!-- Mobile Toggle -->
                    <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- Menu -->
                    <div class="collapse navbar-collapse" id="navbarScroll">
                        <ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll">
                            <?php
                            // Fetch the primary menu
                            $menu_locations = get_nav_menu_locations();
                            $menu_id = $menu_locations['primary'] ?? null;

                            if ($menu_id) {
                                $menu_items = wp_get_nav_menu_items($menu_id);

                                // Process menu items
                                $menu_tree = [];
                                foreach ($menu_items as $item) {
                                    $menu_tree[$item->menu_item_parent][] = $item;
                                }

                                // Function to render menu recursively
                                function render_menu($items, $menu_tree) {
                                    foreach ($items as $item) {
                                        $has_children = isset($menu_tree[$item->ID]);

                                        // Render parent item
                                        echo '<li class="nav-item ' . ($has_children ? 'dropdown' : '') . '">';
                                        echo '<a class="nav-link ' . ($has_children ? 'dropdown-toggle' : '') . '" href="' . esc_url($item->url) . '" ' . ($has_children ? 'data-bs-toggle="dropdown" aria-expanded="false"' : '') . '>';
                                        echo esc_html($item->title);
                                        echo '</a>';

                                        // Render child items
                                        if ($has_children) {
                                            echo '<ul class="dropdown-menu">';
                                            render_menu($menu_tree[$item->ID], $menu_tree);
                                            echo '</ul>';
                                        }

                                        echo '</li>';
                                    }
                                }

                                // Render top-level items
                                if (isset($menu_tree[0])) {
                                    render_menu($menu_tree[0], $menu_tree);
                                }
                            } else {
                                echo '<li class="nav-item"><a class="nav-link" href="#">No menu assigned</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>