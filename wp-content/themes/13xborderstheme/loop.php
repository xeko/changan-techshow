<?php if (have_posts()): while (have_posts()) : the_post(); ?>
<?php $thecontent = get_the_content();?>
	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<!-- post thumbnail -->
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
			</a>
		<?php endif; ?>
		<!-- /post thumbnail -->

		<!-- post title -->
        <h2 class="entry-title post-title">
<?php if (empty($thecontent)) {?>
<?php the_title(); ?>
<?php }else {?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
<?php }?>
		</h2>
		<!-- /post title -->

        <div class="post-meta">
            <!--<span class="meta-prep meta-prep-author posted">投稿日: </span>-->
            <time class="timestamp updated date"><?php //the_time('F j, Y'); ?></time>            
        </div>
        
		<?php //the_excerpt(); ?>

		<?php edit_post_link(); ?>

	</article>
	<!-- /article -->

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
