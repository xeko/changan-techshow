<?php get_header(); ?>

<!-- section -->
<section id="blog_content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-8 col-md-pull-2 col-md-push-2">
                <div id="content">
                    <?php if (have_posts()): while (have_posts()) : the_post(); ?>

                            <!-- article -->
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div　class="modid"><a class="btnlink" href="javascript:javascript:history.go(-1)">&lt;&nbsp;戻る</a></div
                                <!-- post title -->
                                <h1 class="entry-title"><?php the_title(); ?></h1>
                                <!-- /post title -->

                                <!-- post details -->
                                <span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
                                <!-- /post details -->

                                <?php the_content(); // Dynamic Content ?>

                                <?php the_tags(__('Tags: ', 'html5blank'), ', ', '<br>'); // Separated by commas with a line break at the end ?>

                                <?php edit_post_link(); // Always handy to have Edit Post Links available ?>

                            </article>
                            <!-- /article -->

                        <?php endwhile; ?>

                    <?php else: ?>

                        <!-- article -->
                        <article>

                            <h1><?php _e('Sorry, nothing to display.', 'html5blank'); ?></h1>

                        </article>
                        <!-- /article -->

                    <?php endif; ?>
                </div><!--End .content-->
            </div>
        </div>
    </div>
</section>
<!-- /section #blog_content-->

<?php
get_footer();