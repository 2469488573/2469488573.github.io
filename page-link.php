<?php 
/*
Template Name: 友情链接
*/
get_header(); $linkcats = $wpdb->get_results("SELECT T1.name AS name FROM $wpdb->terms T1, $wpdb->term_taxonomy T2 WHERE T1.term_id = T2.term_id AND T2.taxonomy = 'link_category'");
?>



	<article>
  <div id="floater">
  <div id="up"></div>
  <?php if ( comments_open() ) : ?>
  <div id="go2comment"></div>
  <?php endif ;?>
  <div id="down"></div>
  </div>
  <div id="single-content">  
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
      
	  <div class="article-header">
        <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
          <?php the_title(); ?>
          </a></h2>
		   <div class="post-meta">By <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php the_author(); ?></a></div>
        </div>
        <!--.postMeta-->
        <?php if($linkcats) : foreach($linkcats as $linkcat) : ?> <!-- 开始输出links-->
				<div id="linkcaption"><h4><?php echo $linkcat->name; ?></h4></div> <!-- 输出分类-->
					<div class="link-content"> <!--开始ul-->
						<ul>
						<?php $bookmarks = get_bookmarks('orderby=date&category_name=' . $linkcat->name);if ( !empty($bookmarks) ) {foreach ($bookmarks as $bookmark) {echo '<li><a href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" ><img width="16px";height="16px"; src="' . $bookmark->link_url . '/favicon.ico" onerror="javascript:this.src=\'wp-content/themes/Minimize/images/link-default.png\'" />' . $bookmark->link_name . '</a></li>';}} ?>
						</ul>
					<div class="fixed"></div>
				</div><!-- end link-content -->
				
			<?php endforeach; endif; ?>	
					
					
		 <div class="clear"></div>
		 
		 
		<div class="article-footer"></div>
      
    
    <?php endwhile; endif;?>
   
  </div>
  

</article>
<?php get_footer(); ?>