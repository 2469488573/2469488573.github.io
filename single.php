<?php get_header(); ?>

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
		<div class="entry-content">
         <?php the_content(); ?>
		 </div>
    

		 </div>
		 <footer><?php if ( get_the_tags() ) { the_tags('<ul class="article-tags"><li>', '</li><li>', '</ul>'); } else{ echo "None";  } ?></footer>
		 <?php wp_link_pages('before=<div class="link-page">Pages:&after=</div>'); ?>
		 <div id="share">
<span id="share-title">分享到:</span>
<a id="share-weibo" href="#"></a>
<a id="share-tx" href="#"></a>
<a id="share-qq" href="#"></a>
<a id="share-douban" href="#"></a>
<a id="share-renren" href="#"></a>
</div>
		 <div class="clear"></div>
		 	<?php comments_template( '', true ); ?>
		<div class="article-footer"></div>
      
   </article>
    <?php endwhile; endif;?>
   
  </div>
  

</article>
<?php get_footer(); ?>
