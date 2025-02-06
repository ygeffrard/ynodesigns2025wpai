<section class="reviews py-5" id="reviews">
    <div class="container">
        <h2 class="text-center mb-4">What Our Clients Say</h2>
        <div class="row">
            <?php
            $reviews = new WP_Query(array(
                'post_type' => 'review',
                'posts_per_page' => 3,
            ));

            if ($reviews->have_posts()) :
                while ($reviews->have_posts()) : $reviews->the_post(); ?>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <p class="card-text"><?php the_content(); ?></p>
                                <footer class="blockquote-footer"><?php the_title(); ?></footer>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p class="text-center">No reviews found.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
