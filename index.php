<?php get_header(); ?>

<article>
<nav id="left-menu">
      <?php wp_nav_menu( array( 'theme_location' => 'header-menu','menu_id'=>'nav','container'=>'ul')); ?>
</nav>	  
  <div id="content">  
  
			<?php if (  $wp_query->max_num_pages > 1 ) : ?>
							<nav id="pagenavi"><?php pagenavi(); ?></nav>
			<?php endif; ?>
		
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php if( has_post_format( 'status' )) { // 单张图片样式?> 
			<div class="status">
			
			<div class="status-right"><div class="avatarbg"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php echo get_avatar( get_the_author_email(), 40 ); ?></a></div></div><div class="statuscontent"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 250,"……"); ?></div>
			<div class="statustime"><?php echo past_date(); ?></div>
			</div><div class="article-footer"></div>
			<?php } else{ // 普通的?>
<article id="<?php echo $post->ID?>" class="post-home" itemtype="http://schema.org/Article" itemscope="itemscope" data-id="<?php echo $post->ID?>">
       <meta itemprop="inLanguage" content="zh-CN">
	  <header class="article-header">
        <h2 class="entry-title" itemprop="headline"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
          <?php the_title(); ?>
          </a></h2>
        <div class="post-meta"><span class="author"><span class="dt">Author:</span><span itemprop="author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php the_author(); ?></a></span></span><span class="publish-date">
<span class="dt">Publish date:</span><span class="dd" itemprop="datePublished"><?php the_time('d,m,Y')?></span></span><span class="section">
<span class="dt">Section:</span>
<span class="dd" itemprop="articleSection">
<?php the_category(', ') ?>
</span>
</span><span class="interaction-count">
<span class="dt">Interaction count:</span>
<span class="dd parsed" itemprop="interactionCount"><?php custom_the_views($post->ID);?></span>
</span></div></header>
        <!--.postMeta-->
        <div class="article-body">
		<div class="entry">
		<div class="thum"><?php post_thumbnail( 140,100 ); ?></div>
         <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 350,"……"); ?>
		 </div>
		  <a href="<?php the_permalink() ?>" title="Read more on<?php the_title(); ?>" rel="bookmark" class="more-link">Read On</a>
        </div>
		<div class="article-footer"></div> 
</article>
<?php } // 文章样式结束 Oh yeah~ ?>
    <?php endwhile; endif;?>
	
			<?php if (  $wp_query->max_num_pages > 1 ) : ?>
							<nav id="pagenavi"><?php pagenavi(); ?></nav>
			<?php endif; ?>
		
      
  </div>
 
</article>
<?php get_footer(); ?>
