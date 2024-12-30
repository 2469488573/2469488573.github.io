<?php 
/*
Template Name: 标签模板
*/
get_header(); 
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
        <div class="article-body">
         <ul class="tag-clouds">
		<?php $tags_list = get_tags('orderby=count&order=DESC');
		if ($tags_list) { 
			foreach($tags_list as $tag) {
				echo '<li><a class="tag-link" href="'.get_tag_link($tag).'">'. $tag->name .'</a><strong>x '. $tag->count .'</strong></li>'; 

			} 
		} 
		?>
	</ul>
		 </div>
		 <div class="clear"></div>
		 
		 	
		<div class="article-footer"></div>
      
    
    <?php endwhile; endif;?>
   
  </div>
  

</article>
<?php get_footer(); ?>