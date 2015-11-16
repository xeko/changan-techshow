<?php get_header(); ?>

<div class="container-fluid">
    <!-- section -->
    <div class="row">
        <div class="col-md-8 col-md-pull-2 col-md-push-2">
            <div id="content">
                <span class="breadcrumb spacer-xs"><?php single_cat_title(); ?></span>

                <?php get_template_part('loop'); ?>

                <?php get_template_part('pagination'); ?>

            </div>
        </div>
    </div>
    <!-- /section -->
</div>

<?php get_footer(); ?>
