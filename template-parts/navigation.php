<nav class="navbar navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid px-0">
        <a href="<?php echo home_url(); ?>" class="logo navbar-brand">
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="YNO Designs" />
        </a>
        <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'main-menu',
                'menu_class' => 'navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll',
                'container' => false,
            ));
            ?>
        </div>
    </div>
</nav>
