<?php
/*

  Template Name: One Page Template

 */


get_header();
?>
<div id="top-home">
    <div class="row">
        <div class="col-md-12">
            <div class="top-feature">
                <div class="text-white text-size-36 b text-space-4 text-shadow">
                    <?php
                    echo get_option('13xborders_sample_text_area');
                    ?>
                </div>                        
            </div>                        
        </div>
    </div>
</div>
<?php $the_query_onepage = new WP_Query('post_type=onepage&posts_per_page=50'); ?>

<?php if ($the_query_onepage->have_posts()) : ?>

    <?php while ($the_query_onepage->have_posts()) : $the_query_onepage->the_post(); ?>
        <div id="<?php echo sanitize_title(get_the_title()); ?>" class="section-main swipe-menu">
            <h3 class="text-uppercase text-center title_blog"><label></label><span><?php the_title() ?></span><label></label></h3>
                    <?php the_content() ?>	                                

        </div>

    <?php
    endwhile;
    wp_reset_query();
    ?>

<?php else : ?> 

    <?php get_template_part('no-results', 'index'); ?>

<?php endif; ?> 

<?php get_footer(); ?>