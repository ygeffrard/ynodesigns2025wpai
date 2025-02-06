<footer class="site-footer bg-dark text-white">
        <div class="container py-5">
            <div class="row">
                <!-- Locations -->
                <div class="col-md-4">
                    <h4>Locations</h4>
                    <ul class="list-unstyled">
                        <?php
                        $locations = explode(',', get_option('footer_locations', ''));
                        foreach ($locations as $location) {
                            echo '<li>' . esc_html(trim($location)) . '</li>';
                        }
                        ?>
                    </ul>
                </div>

                <!-- Certifications -->
                <div class="col-md-4">
                    <h4>Certifications</h4>
                    <p><?php echo esc_html(get_option('footer_certifications', 'Not configured yet.')); ?></p>
                </div>

                <!-- Contact Info -->
                <div class="col-md-4">
                    <h4>Contact Information</h4>
                    <p><?php echo wp_kses_post(get_option('footer_contact_info', 'Not configured yet.')); ?></p>
                </div>
            </div>
        </div>
        <div class="bg-secondary text-center py-3">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved.</p>
        </div>
        <?php wp_footer(); ?>
    </footer>
</body>
</html>