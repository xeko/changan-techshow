<?php get_header(); ?>

<div class="container-fluid">
    <!-- section -->
    <div class="row">
        <div class="col-md-8 col-md-pull-2 col-md-push-2">
            <div id="content">
		<div　class="modid"><a class="btnlink" href="javascript:javascript:history.go(-1)">&lt;&nbsp;戻る</a></div
                <span class="breadcrumb spacer-xs"><?php single_cat_title(); ?></span>
                <table class="table table-hover">
    <thead>
      <tr>
        <th width="5%">#</th>
        <th>ファイル</th>
      </tr>
    </thead>
    <tbody>
                <?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;	
                $args = array( 'post_type' => 'download', 'paged'=>$paged);		
                 $loop = new WP_Query( $args );
                 $i=0;
                 while ( $loop->have_posts() ) : $loop->the_post();
                    $i++;
                    $url_download = get_post_meta( get_the_ID(),'url_download',true);
                    $icon_download = get_post_meta( get_the_ID(),'icon_download',true);
                    echo '<tr><td>'.$i.'</td><td><img src="'.$icon_download.'" />   <a href="'.$url_download.'">'.get_the_title().'</a></td></tr>';
                 endwhile;
                ?>
     <tr><td colspan="2" style="text-align: center"><?php get_template_part('pagination'); ?></td></tr>           
</tbody>
  </table>
            </div>
        </div>
    </div>
    <!-- /section -->
</div>

<?php get_footer(); ?>