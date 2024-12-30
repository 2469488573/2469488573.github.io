<?php get_header(); ?>
<article>
<div id="container" role="main">
  <div id="content">		
	
	<section id="primary">
	
     <?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'twentytwelve' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>

			<?php if ( tag_description() ) : // Show an optional tag description ?>
				<div class="archive-meta"><?php echo tag_description(); ?></div>
			<?php endif; ?>
			</header><!-- .archive-header -->
				   
      <?php while (have_posts()) : the_post(); ?>
	<article id="<?php echo $post->ID?>" class="post" itemtype="http://schema.org/Article" itemscope="itemscope" data-id="<?php echo $post->ID?>">
          <meta itemprop="inLanguage" content="zh-CN">
         
          <div class="post-entry">
		  <header class="entry-header">
            <h2 class="entry-title" itemprop="headline"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
              <?php the_title(); ?>
              </a></h2>
			   
              <div class="post-meta"><span class="author"><span class="dt">Author:</span><span itemprop="author"><a href="https://plus.google.com/100716597011672341308?rel=author" rel="author">
                <?php the_author(); ?>
                </a></span></span><span class="publish-date"> <span class="dt">Publish date:</span><span class="dd" itemprop="datePublished">
                <?php the_time('d,m,Y')?>
                </span></span><span class="section"> <span class="dt">Section:</span> <span class="dd" itemprop="articleSection">
                <?php the_category(', ') ?>
                </span> </span><span class="interaction-count"> <span class="dt">Interaction count:</span> <span class="dd parsed" itemprop="interactionCount">
                <?php custom_the_views($post->ID);?>
                </span> </span></div>
            </header>
            <div class="entry-content" itemprop="description"> <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 320,"……"); ?> </div>
			<footer class="entry-footer">
           <?php comments_popup_link('Leave A Reply', '1 Reply', '% Replies'); ?>
            </footer>
          </div>
        </article>
	  
      
      <?php endwhile; endif;?>
	  <div id="postnavigation"><?php par_pagenavi(6); ?></div>	
	  </section>
     
   
  </div></div>
  <!--#end content-->
  <?php get_sidebar(); ?>
</article>
<?php get_footer(); ?>
