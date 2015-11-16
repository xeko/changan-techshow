<?php get_header(); ?>

<div id="blog_content">
<div class="container-fluid">
    <!-- section -->
    <div class="row">
        <div class="col-md-8 col-md-pull-2 col-md-push-2">		
	
            <?php if (have_posts()): while (have_posts()) : the_post(); ?>

                    <div id="content" <?php post_class(); ?>>

                        <?php the_content(); ?>

                        <div class="spacer-xs"></div>
                        <?php edit_post_link(); ?>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <!-- article -->
                <article>

                    <h2><?php _e('Sorry, nothing to display.', 'html5blank'); ?></h2>

                </article>
                <!-- /article -->

            <?php endif; ?>
        </div>
    </div>
</div>
</div>

<?php get_footer(); ?>