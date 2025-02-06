<section class="clients py-5 bg-light" id="clients">
    <div class="container">
        <h2 class="text-center mb-4">Our Clients</h2>
        <p class="text-center mb-5">We are proud to work with industry leaders and innovative brands.</p>
        <div class="row text-center">
            <?php
            $clients = new WP_Query(array(
                'post_type' => 'client',
                'posts_per_page' => -1,
            ));

            if ($clients->have_posts()) :
                while ($clients->have_posts()) : $clients->the_post(); ?>
                    <div class="col-md-3 col-6 mb-4">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>" class="img-fluid">
                        <?php endif; ?>
                        <p class="mt-2"><?php the_title(); ?></p>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p class="text-center">No clients found.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
