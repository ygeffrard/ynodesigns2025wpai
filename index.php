<?php get_header(); ?>

<main class="site-main">
    <div class="container py-5">
        <h1 class="mb-4"><?php bloginfo('name'); ?> Blog</h1>

        <?php if (have_posts()) : ?>
            <div class="row">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="col-md-4 mb-4">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('card h-100'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="card-img-top">
                                    <?php the_post_thumbnail('medium', ['class' => 'img-fluid']); ?>
                                </a>
                            <?php endif; ?>

                            <div class="card-body">
                                <h3 class="card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <p class="card-text"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            </div>

                            <div class="card-footer text-end">
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
                            </div>
                        </article>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => __('&laquo; Previous', 'yno-designs'),
                    'next_text' => __('Next &raquo;', 'yno-designs'),
                ));
                ?>
            </div>
        <?php else : ?>
            <p><?php _e('No posts found.', 'yno-designs'); ?></p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>